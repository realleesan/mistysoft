<?php
declare(strict_types=1);

class HomeController extends Controller
{
  public function index(): void
  {
    if (isset($_GET['utm_source'])) {
      $_SESSION['utm_source'] = $_GET['utm_source'];
    }

    $content = ContentBlock::getActiveBlocks();
    $projects = Project::getFeatured(6);
    $pricing = PricingPlan::getActive();

    $this->view('home/index', [
      'title' => 'MistySoft - Thiết kế website chuyên nghiệp',
      'description' => 'MistySoft thiết kế website chuyên nghiệp, tối ưu chuyển đổi cho doanh nghiệp. Landing page, website doanh nghiệp, bảng giá minh bạch.',
      'content' => $content,
      'projects' => $projects,
      'pricing' => $pricing,
    ]);
  }
}
