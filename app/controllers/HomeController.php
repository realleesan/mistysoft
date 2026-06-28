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
      'title' => 'MistySoft - Digital Solutions for Your Business',
      'description' => 'MistySoft cung cấp giải pháp digital toàn diện: thiết kế website, app, tool, phần mềm theo yêu cầu, SaaS products, và các dịch vụ hỗ trợ.',
      'content' => $content,
      'projects' => $projects,
      'pricing' => $pricing,
    ]);
  }

  public function comingSoon(): void
  {
    $this->view('errors/coming-soon', [
      'title' => 'Sắp ra mắt - MistySoft',
      'description' => 'Tính năng này đang được phát triển và sẽ sớm ra mắt.',
    ], 'main');
  }
}
