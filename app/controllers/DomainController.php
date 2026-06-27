<?php
declare(strict_types=1);

class DomainController extends Controller
{
    private array $priceConfig;

    public function __construct()
    {
        $this->priceConfig = require CONFIG_PATH . '/domain-prices.php';
    }

    public function index(): void
    {
        $this->view('domain/check', [
            'title' => 'Kiểm tra tên miền - MistySoft',
            'description' => 'Kiểm tra tính khả dụng của tên miền và nhận báo giá đăng ký tên miền tại MistySoft.',
            'suggested_tlds' => $this->priceConfig['suggested_tlds'],
        ]);
    }

    public function check(): void
    {
        header('Content-Type: application/json; charset=utf-8');

        $domain = $_GET['domain'] ?? '';
        
        if (empty($domain)) {
            http_response_code(400);
            echo json_encode(['error' => 'Vui lòng nhập tên miền']);
            exit;
        }

        // Validate domain format
        if (!$this->isValidDomain($domain)) {
            http_response_code(400);
            echo json_encode(['error' => 'Tên miền không hợp lệ']);
            exit;
        }

        // Normalize domain
        $domain = strtolower(trim($domain));
        $domain = preg_replace('/^https?:\/\//', '', $domain);
        $domain = preg_replace('/^www\./', '', $domain);
        $domain = rtrim($domain, '/');

        // Extract TLD
        $tld = $this->extractTLD($domain);
        
        if (!$tld) {
            http_response_code(400);
            echo json_encode(['error' => 'Không thể xác định đuôi tên miền']);
            exit;
        }

        // Check availability via API
        $availability = $this->checkAvailability($domain);

        if ($availability === null) {
            http_response_code(500);
            echo json_encode(['error' => 'Không thể kiểm tra tên miền. Vui lòng thử lại sau.']);
            exit;
        }

        // Calculate price
        $priceInfo = $this->calculatePrice($tld);

        // Get suggestions
        $suggestions = $this->getSuggestions($domain);

        echo json_encode([
            'domain' => $domain,
            'tld' => $tld,
            'available' => $availability,
            'price' => $priceInfo,
            'suggestions' => $suggestions,
        ], JSON_UNESCAPED_UNICODE);
        exit;
    }

    private function isValidDomain(string $domain): bool
    {
        // Basic domain validation
        $pattern = '/^(?:[a-z0-9](?:[a-z0-9-]{0,61}[a-z0-9])?\.)+[a-z0-9][a-z0-9-]{0,61}[a-z0-9]$/i';
        return preg_match($pattern, $domain) === 1;
    }

    private function extractTLD(string $domain): ?string
    {
        // Extract TLD from domain
        $parts = explode('.', $domain);
        if (count($parts) < 2) {
            return null;
        }

        // Handle multi-level TLDs like .com.vn
        $tld = '.' . end($parts);
        
        // Check if it's a multi-level TLD
        if (count($parts) >= 3) {
            $possibleTld = '.' . $parts[count($parts) - 2] . $tld;
            if (isset($this->priceConfig['base_prices'][$possibleTld])) {
                return $possibleTld;
            }
        }

        return $tld;
    }

    private function checkAvailability(string $domain): ?bool
    {
        // DNS check is unreliable due to wildcard DNS on shared hosting
        // Use WHOIS lookup instead - if registrar exists, domain is registered
        $config = $this->priceConfig['api']['whoisjson'];
        $apiKey = $config['api_key'];
        
        if (empty($apiKey)) {
            error_log('No API key, falling back to DNS check (unreliable)');
            return $this->checkDNS($domain);
        }
        
        return $this->checkWhoisLookup($domain);
    }

    private function checkWhoisLookup(string $domain): ?bool
    {
        $config = $this->priceConfig['api']['whoisjson'];
        $apiKey = $config['api_key'];
        
        // Use WHOIS lookup endpoint instead of domain-availability
        $url = $config['base_url'] . '/whois?domain=' . urlencode($domain);
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Authorization: TOKEN=' . $apiKey,
        ]);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
        
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $error = curl_error($ch);
        curl_close($ch);

        if ($error) {
            error_log('WhoisJSON cURL error: ' . $error);
            return null;
        }

        if ($httpCode !== 200) {
            error_log('WhoisJSON HTTP error: ' . $httpCode . ' - Response: ' . $response);
            return null;
        }

        $data = json_decode($response, true);
        
        if (json_last_error() !== JSON_ERROR_NONE) {
            error_log('WhoisJSON JSON decode error: ' . json_last_error_msg());
            return null;
        }
        
        // WHOIS lookup: check multiple indicators
        // WhoisJSON returns different field names for different TLDs
        $registrar = $data['registrar'] ?? null;
        $createdDate = $data['created_date'] ?? $data['created'] ?? null;
        $status = $data['status'] ?? null;
        $nameservers = $data['nameservers'] ?? $data['nameserver'] ?? null;
        $registered = $data['registered'] ?? null;
        $contacts = $data['contacts'] ?? null;
        
        // Check if this is TLD data (not domain data) - HIGHEST PRIORITY
        // TLD data has very old created date (e.g., 1994-04-14 for .vn)
        // But also check if domain has actual IP resolution (not wildcard DNS)
        $isTLDData = false;
        if (!empty($createdDate) && strpos($createdDate, '1994') === 0) {
            // Check if domain has actual IP resolution
            $ip = gethostbyname($domain);
            $wildcardIP = '185.27.134.24'; // InfinityFree wildcard DNS
            if ($ip && $ip !== $domain && $ip !== $wildcardIP) {
                // Has real IP, not TLD data
                $isTLDData = false;
                error_log("Domain $domain has created 1994 but real IP $ip - treating as registered domain");
            } else {
                $isTLDData = true;
            }
        }
        
        // Check if contacts only contain registry info (VNNIC for .vn)
        // Only check if contacts exist AND contain VNNIC/registry info
        // Empty contacts should NOT be considered registry-only
        $isRegistryOnly = false;
        if (!empty($contacts) && is_array($contacts)) {
            $hasVNNIC = false;
            $hasRealOwner = false;
            $hasAnyContact = false;
            
            foreach ($contacts as $contactType => $contactList) {
                if (is_array($contactList) && !empty($contactList)) {
                    $hasAnyContact = true;
                    foreach ($contactList as $contact) {
                        if (!empty($contact['organization'])) {
                            $org = strtolower($contact['organization']);
                            if (strpos($org, 'vnnic') !== false || strpos($org, 'registry') !== false) {
                                $hasVNNIC = true;
                            }
                            if (strpos($org, 'vnnic') === false && strpos($org, 'registry') === false) {
                                $hasRealOwner = true;
                            }
                        }
                    }
                }
            }
            
            // Only consider registry-only if there are contacts AND they are all VNNIC/registry
            if ($hasAnyContact && $hasVNNIC && !$hasRealOwner) {
                $isRegistryOnly = true;
            }
        }
        
        // If this is TLD data or registry-only data, domain might be available
        // Ignore registered flag for TLD data
        if ($isTLDData || $isRegistryOnly) {
            error_log("WHOIS data appears to be TLD/registry data for $domain, treating as available");
            return true;
        }
        
        // Check registrar (highest priority for actual domain data)
        // If registrar has actual name/id, domain is definitely registered
        $hasRegistrar = false;
        if (is_array($registrar)) {
            // Check if registrar has actual name (not all null)
            $hasRegistrar = !empty($registrar['name']) || !empty($registrar['id']);
        } else {
            $hasRegistrar = !empty($registrar);
        }
        
        if ($hasRegistrar) {
            return false; // Domain is taken
        }
        
        // Check if explicitly marked as registered (only for non-TLD data)
        if ($registered === true || $registered === 'true') {
            return false; // Domain is taken
        }
        
        // Check created date (any format, but not TLD date)
        $hasCreatedDate = !empty($createdDate) && !$isTLDData;
        
        // Check status (can be string or array)
        // For .vn domains, ACTIVE status might be TLD status, not domain status
        $hasStatus = false;
        if (is_array($status)) {
            $registeredStatuses = ['registered', 'active', 'clientTransferProhibited', 'clientDeleteProhibited'];
            foreach ($status as $s) {
                if (in_array(strtolower($s), $registeredStatuses)) {
                    $hasStatus = true;
                    break;
                }
            }
        } elseif (is_string($status)) {
            $registeredStatuses = ['registered', 'active', 'clientTransferProhibited', 'clientDeleteProhibited'];
            $hasStatus = in_array(strtolower($status), $registeredStatuses);
        }
        
        // Check nameservers (can be string or array)
        $hasNameservers = false;
        if (is_array($nameservers)) {
            $hasNameservers = !empty($nameservers);
        } elseif (is_string($nameservers)) {
            $hasNameservers = !empty($nameservers);
        }
        
        // If any indicator shows registered, domain is taken
        if ($hasCreatedDate || $hasStatus || $hasNameservers) {
            return false; // Domain is taken
        }
        
        // No indicators, might be available
        return true;
    }

    private function checkWhoisFreaks(string $domain): ?bool
    {
        $config = $this->priceConfig['api']['whoisfreaks'];
        $apiKey = $config['api_key'];
        
        if (empty($apiKey)) {
            return $this->checkDNS($domain);
        }

        $url = $config['base_url'] . '/domain-availability?domainName=' . urlencode($domain) . '&apiKey=' . $apiKey;
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($httpCode !== 200) {
            return null;
        }

        $data = json_decode($response, true);
        
        // WhoisFreaks response structure
        return $data['available'] ?? null;
    }

    private function checkDNS(string $domain): ?bool
    {
        // Improved DNS check for better accuracy
        // Check multiple record types
        $hasA = checkdnsrr($domain, 'A');
        $hasAAAA = checkdnsrr($domain, 'AAAA');
        $hasMX = checkdnsrr($domain, 'MX');
        $hasNS = checkdnsrr($domain, 'NS');
        $hasSOA = checkdnsrr($domain, 'SOA');
        
        // NS record is the most reliable indicator of a registered domain
        if ($hasNS) {
            return false; // Domain is taken
        }
        
        // SOA record also indicates a registered domain
        if ($hasSOA) {
            return false; // Domain is taken
        }
        
        // MX record indicates email service, domain is likely registered
        if ($hasMX) {
            return false; // Domain is taken
        }
        
        // A or AAAA records indicate the domain is in use
        // But could be wildcard DNS, so check if it resolves to a real IP
        if ($hasA || $hasAAAA) {
            $ip = gethostbyname($domain);
            if ($ip && $ip !== $domain) {
                // Resolves to a real IP, domain is likely registered
                return false;
            }
            // No real IP resolution, might be wildcard DNS
            error_log("Domain $domain has DNS record but no real IP - treating as available (possible wildcard DNS)");
            return true;
        }
        
        // No DNS records found, domain is likely available
        return true;
    }

    private function calculatePrice(string $tld): array
    {
        $basePrices = $this->priceConfig['base_prices'];
        $markupPercent = $this->priceConfig['markup_percent'];
        $defaultMarkup = $this->priceConfig['default_markup'];

        $basePrice = $basePrices[$tld] ?? null;
        
        if ($basePrice === null) {
            return [
                'available' => false,
                'base_price' => 0,
                'selling_price' => 0,
                'markup' => 0,
            ];
        }

        $markup = $markupPercent[$tld] ?? $defaultMarkup;
        $sellingPrice = (int) round($basePrice * (1 + $markup));

        return [
            'available' => true,
            'base_price' => $basePrice,
            'selling_price' => $sellingPrice,
            'markup' => $markup,
        ];
    }

    private function getSuggestions(string $domain): array
    {
        $suggestedTlds = $this->priceConfig['suggested_tlds'];
        $baseName = $this->extractBaseName($domain);
        
        $suggestions = [];
        
        foreach ($suggestedTlds as $tld) {
            $suggestedDomain = $baseName . $tld;
            $priceInfo = $this->calculatePrice($tld);
            
            if ($priceInfo['available']) {
                $suggestions[] = [
                    'domain' => $suggestedDomain,
                    'tld' => $tld,
                    'price' => $priceInfo,
                ];
            }
        }

        // Limit to 10 suggestions
        return array_slice($suggestions, 0, 10);
    }

    private function extractBaseName(string $domain): string
    {
        $parts = explode('.', $domain);
        if (count($parts) >= 2) {
            // Remove TLD
            array_pop($parts);
            if (count($parts) >= 2 && in_array(end($parts), ['com', 'net', 'org', 'vn'])) {
                // Handle multi-level TLDs like .com.vn
                array_pop($parts);
            }
            return implode('.', $parts);
        }
        return $domain;
    }
}
