[![WhoisJson API : 1000 free requests per month](https://whoisjson.com/assets/img/banner.svg "Whois API in JSON")](https://whoisjson.com/)* [Products](https://whoisjson.com/documentation#)

* [Solutions](https://whoisjson.com/documentation#)
* [Resources](https://whoisjson.com/documentation#)
* [Pricing](https://whoisjson.com/pricing)
* [Contact](https://whoisjson.com/contact-us)
* 

**API Documentation**# WHOIS API Documentation with cURL, Python & JavaScript Examples

Everything you need to integrate WHOIS, DNS, SSL, and domain availability data into your applications. One API key, six endpoints, structured JSON or XML responses — and an MCP server for Claude, Cursor, and Windsurf.

**Getting Started**## Quick Start Guide

Get your first API response in under two minutes. All you need is a free account and a single HTTP request.

1

**Create a free account**[Sign up](https://whoisjson.com/login) — your API key is generated instantly.

2

**Add your token to the Authorization header**`Authorization: TOKEN=YOUR_API_KEY`

3

**Query any endpoint**Base URL: `https://whoisjson.com/api/v1`

Quick example — cURL

```bash
# WHOIS lookup
curl -s "https://whoisjson.com/api/v1/whois?domain=example.com" \
  -H "Authorization: TOKEN=YOUR_API_KEY"

# DNS records
curl -s "https://whoisjson.com/api/v1/nslookup?domain=example.com" \
  -H "Authorization: TOKEN=YOUR_API_KEY"

# Domain availability
curl -s "https://whoisjson.com/api/v1/domain-availability?domain=example.com" \
  -H "Authorization: TOKEN=YOUR_API_KEY"

# SSL certificate check
curl -s "https://whoisjson.com/api/v1/ssl-cert-check?domain=example.com" \
  -H "Authorization: TOKEN=YOUR_API_KEY"

# Subdomains
curl -s "https://whoisjson.com/api/v1/subdomains?domain=example.com" \
  -H "Authorization: TOKEN=YOUR_API_KEY"
```

**Response Format**JSON (default) or XML — set `format=xml` **parameter**

**Remaining Requests**Check `Remaining-Requests` **header in every response**

**Force Refresh**Add `_forceRefresh=1` **to bypass cache (costs 2x credits)**

**Code Examples**## Copy-Paste API Examples

Pick your language and paste directly into your project. Swap the path for DNS, SSL, or availability — the auth header is identical across all endpoints.

* cURL
* JavaScript
* Python

```bash
curl -s "https://whoisjson.com/api/v1/whois?domain=example.com" \
  -H "Authorization: TOKEN=YOUR_API_KEY"
```

**API Endpoints**## Six Endpoints, One Token

All endpoints share the same base URL and authentication. Your free plan includes 1,000 requests/month across all services.

GET

/api/v1/whois

### WHOIS Lookup

Query domain registration data — registrar, dates, nameservers, status codes, and contact information.

`domain` **(required) — domain name**

[Learn more →](https://whoisjson.com/whois-api)

GET

/api/v1/nslookup

### DNS Records

Resolve A, AAAA, MX, TXT, CNAME, NS, SOA records for any domain in a single call.

`domain` **(required) — domain name**

[Learn more →](https://whoisjson.com/nslookup-api)

GET

/api/v1/ssl-cert-check

### SSL Certificate

Validate SSL/TLS certificates — issuer, validity period, encryption standard, and chain of trust.

`domain` **(required) — domain name**

[Learn more →](https://whoisjson.com/ssl-certificates-api)

GET

/api/v1/domain-availability

### Domain Availability

Real-time registration status check. Returns whether a domain is available or already registered.

`domain` **(required) — domain name**

[Learn more →](https://whoisjson.com/domain-availability-api)

GET

/api/v1/subdomains

### Subdomain Discovery

Find active subdomains using parallel DNS brute-force with wildcard detection. Returns A & CNAME records.

`domain` **(required) — domain name**

[Learn more →](https://whoisjson.com/subdomain-api)

GET

/api/v1/reverseWhois

### Reverse WHOIS

Discover all domains associated with a given IP address, sourced from our private database.

`ip` **(required) — IP address**

GUIDE

/bulk-whois-api

### Bulk & High-Volume

Node.js and Python examples, rate-limit handling, error retry logic, pricing by volume, and a provider comparison table.

[Read the guide →](https://whoisjson.com/bulk-whois-api)

**Reference**## HTTP Status Codes

The API uses standard HTTP status codes to indicate success or failure. Every response includes a `Remaining-Requests` header so you can track your usage in real time.

[Read the FAQ →](https://whoisjson.com/faq)
[View rate limits per plan →](https://whoisjson.com/pricing)

| Code          | Description          | Reason                              |
| ------------- | -------------------- | ----------------------------------- |
| **200** | Successful operation | Request processed successfully      |
| **400** | Bad Request          | Invalid request parameters          |
| **401** | Unauthorized         | Invalid or missing API token        |
| **403** | Access Denied        | Email address not validated         |
| **429** | Limit Exceeded       | Monthly quota or rate limit reached |
| **500** | Internal Error       | Server-side issue — retry later    |

**SDKs & Libraries**## Official Client Libraries

Install our official SDK for your preferred language and start querying in minutes.

**MCP**Official

### MCP Server

Use WHOIS, DNS, SSL, and availability directly in Claude, Cursor, and Windsurf — no code required.

`npx @whoisjson/mcp-server`

**PHP**Official

### PHP Client

Composer package for Laravel, Symfony, and vanilla PHP projects.

`composer require whoisjson/whoisjson`

**Python**Official

### Python Client

pip package compatible with Python 3.7+ — Django, Flask, FastAPI, scripts.

`pip install whoisjson`

**Node.js**Official

### Node.js Client

npm package for Express, Next.js, Fastify, and any Node.js project.

`npm install @whoisjson/whoisjson`

**Interactive Reference**## Try It Yourself

Explore every endpoint, inspect request parameters and response schemas, and test live API calls directly from this page.

### Making requests

WhoisJSON.com provides RESTful APIs designed for server-to-server communication using HTTPS. Responses are delivered in JSON or XML format.

To get started, create a free developer account at [whoisjson.com](https://whoisjson.com/). The first **1,000 requests/month** are included at no cost.

> It may take up to one minute for your account to activate after registration.

Base URL: `https://whoisjson.com/api/v1`

### Authentication

Set the `Authorization` header to `TOKEN=<YOUR_API_KEY>` on every request.

```
Authorization: TOKEN=abc123yourapikey
```

### Quota header

Every response includes a `Remaining-Requests` header with the number of API calls left in your current billing period:

```
Remaining-Requests: 452
```

### HTTP status codes

| Code    | Meaning               | Reason                             |
| ------- | --------------------- | ---------------------------------- |
| `200` | OK                    | Successful operation               |
| `400` | Bad Request           | Missing or invalid query parameter |
| `401` | Unauthorized          | API key is missing or invalid      |
| `403` | Forbidden             | Email address not validated        |
| `429` | Too Many Requests     | Usage or rate limit exceeded       |
| `500` | Internal Server Error | Unexpected server-side error       |

### Useful links

* [OpenAPI Specification](https://whoisjson.com/openapi.json) — machine-readable OpenAPI 3.0 JSON spec
* [Full documentation](https://whoisjson.com/documentation)
* [Terms of service](https://whoisjson.com/terms-of-service)
* [Contact us](https://whoisjson.com/contact-us)

**Servers**https://whoisjson.com/api/v1 - Production

[ ]

### [WHOIS](https://whoisjson.com/documentation#/WHOIS)Domain registration data, ownership, and registrar information

**GET**[/whois](https://whoisjson.com/documentation#/WHOIS/getWhois)Retrieve full WHOIS record for a domain

### [DNS](https://whoisjson.com/documentation#/DNS)DNS record queries — A, AAAA, MX, TXT, NS, SOA, CAA, DMARC, and more

**GET**[/nslookup](https://whoisjson.com/documentation#/DNS/getDnsRecords)Retrieve all DNS records for a domain

### [SSL](https://whoisjson.com/documentation#/SSL)TLS/SSL certificate inspection and validation

**GET**[/ssl-cert-check](https://whoisjson.com/documentation#/SSL/getSslCertCheck)Retrieve SSL/TLS certificate details for a domain

### [Domain](https://whoisjson.com/documentation#/Domain)Domain availability checks and subdomain discovery

**GET**[/subdomains](https://whoisjson.com/documentation#/Domain/getSubdomains)Discover active subdomains for a domain

**GET**[/domain-availability](https://whoisjson.com/documentation#/Domain/getDomainAvailability)Check if a domain name is available for registration

### [IP](https://whoisjson.com/documentation#/IP)Reverse WHOIS lookup from an IP address

**GET**[/reverseWhois](https://whoisjson.com/documentation#/IP/getReverseWhois)Retrieve WHOIS data for an IP address

#### Schemas

**Error**

**Whois**

**Contact**

**Nslookup**

**SSL-Cert-Check**

**DomainAvailability**

**SubdomainDiscovery**

## A RESTful API Designed for Developers

WhoisJSON provides a unified RESTful API for domain intelligence. All six endpoints — [WHOIS lookup](https://whoisjson.com/whois-api), [DNS records](https://whoisjson.com/nslookup-api), [SSL certificate validation](https://whoisjson.com/ssl-certificates-api), [domain availability](https://whoisjson.com/domain-availability-api), [subdomain discovery](https://whoisjson.com/subdomain-api), and reverse WHOIS — share the same base URL, authentication method, and response format. Whether you are building a cybersecurity tool in Python, a domain management dashboard in Node.js, or a registration pipeline in PHP, our API integrates in minutes with predictable URLs, standard HTTP methods, and clear error codes.

## Authentication & Rate Limits

Every API call requires a single `Authorization: TOKEN=YOUR_API_KEY` header. Your token is generated instantly when you [create a free account](https://whoisjson.com/login). The free plan includes 1,000 requests per month shared across all endpoints with a rate limit of 20 requests per minute. Need more? Our [paid plans](https://whoisjson.com/pricing) scale up to unlimited requests with rate limits of 900 req/min. Check the `Remaining-Requests` header in every API response to monitor your usage in real time.

## Caching, Formats & Advanced Features

Responses are cached for performance (3-hour TTL). Add`_forceRefresh=1` to any request to bypass the cache and get fresh data (costs 2x credits on most plans). All endpoints return JSON by default; append `format=xml` if your stack requires XML. Our WHOIS engine supports RDAP, the next-generation domain data protocol, and covers over 1,500 TLDs and country-code TLDs. For monitoring use cases, explore our [Domain Monitoring](https://whoisjson.com/domain-monitoring) service that tracks WHOIS, DNS, and SSL changes and sends alerts automatically.

## MCP Server — AI-native access

WhoisJSON is also available as an[ MCP server](https://whoisjson.com/mcp), compatible with Claude Desktop, Cursor, and Windsurf. Once configured, your AI assistant can run WHOIS lookups, DNS queries, SSL checks, and availability probes in response to plain-English questions — no code, no copy-pasting. The server is published as[ @whoisjson/mcp-server](https://www.npmjs.com/package/@whoisjson/mcp-server) on npm and runs via`<span> </span>npx`. Your existing API key works identically for both the REST API and the MCP server.

**Need help integrating?** Check our [FAQ](https://whoisjson.com/faq) for common questions, or [contact our support team](https://whoisjson.com/contact-us) — we typically respond within a few hours.

## Ready to Start Building?

Create your free account, grab your API key, and make your first call in under two minutes.

[Pricing](https://whoisjson.com/pricing)[FAQ](https://whoisjson.com/faq)[Latest lookups](https://whoisjson.com/latest-whois)

[![WhoisJson API](https://whoisjson.com/assets/img/banner.svg)](https://whoisjson.com/)Access WHOIS data through our modern RESTful API. Reliable service with 1,000 free requests per month.

###### RDAP Compatible

Supporting next-generation domain data protocol

##### API Products

* [WHOIS API](https://whoisjson.com/whois-api)
* [Bulk WHOIS API](https://whoisjson.com/bulk-whois-api)
* [Domain Availability](https://whoisjson.com/domain-availability-api)
* [DNS Lookup API](https://whoisjson.com/nslookup-api)
* [SSL Certificates](https://whoisjson.com/ssl-certificates-api)
* [Subdomain Discovery](https://whoisjson.com/subdomain-api)
* [Domain Monitoring](https://whoisjson.com/domain-monitoring)

##### Solutions

* [Brand Protection](https://whoisjson.com/brand-protection-api)
* [Phishing Domain Detection](https://whoisjson.com/phishing-domain-detection-api)
* [Attack Surface Monitoring](https://whoisjson.com/attack-surface-monitoring-api)
* [Domain Monitoring](https://whoisjson.com/domain-monitoring)

##### Resources

* [Documentation](https://whoisjson.com/documentation)
* [Blog](https://whoisjson.com/blog)
* [Free API Key](https://whoisjson.com/free-domain-api)
* [MCP Server](https://whoisjson.com/mcp)
* [API Status](https://whoisjson.com/api-status)
* [Pricing](https://whoisjson.com/pricing)
* [FAQ](https://whoisjson.com/faq)
* [Contact](https://whoisjson.com/contact-us)

---

2016-2026 WhoisJSON.com. All rights reserved.

[Terms of Service](https://whoisjson.com/terms-of-service)
