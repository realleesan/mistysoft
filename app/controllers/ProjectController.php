<?php
declare(strict_types=1);

class ProjectController extends Controller
{
  public function show(string $slug): void
  {
    $project = Project::findBySlug($slug);

    if (!$project) {
      http_response_code(404);
      $this->view('errors/404', [
        'title' => 'Không tìm thấy dự án',
      ]);
      return;
    }

    $this->view('projects/show', [
      'title' => $project['title'] . ' - MistySoft',
      'description' => $project['short_description'] ?? '',
      'project' => $project,
    ]);
  }

  public function apiIndex(): void
  {
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json; charset=utf-8');

    $projects = array_map(
      fn(array $p) => Project::formatForApi($p),
      Project::getAll()
    );

    json_response([
      'success' => true,
      'data' => $projects,
    ]);
  }

  public function apiShow(string $slug): void
  {
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json; charset=utf-8');

    $project = Project::findBySlug($slug);

    if (!$project) {
      json_response([
        'success' => false,
        'message' => 'Project not found',
      ], 404);
    }

    json_response([
      'success' => true,
      'data' => Project::formatForApi($project),
    ]);
  }
}
