<?php
namespace App\Http\Services;

use Illuminate\Support\Facades\File;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class FileDownloadService {
    private string $privateBasePath;
    private string $publicBasePath;

    public function __construct() {
        $this->privateBasePath = storage_path('app/private');
        $this->publicBasePath = storage_path('app/public');
    }
    private function normalizePath(string $path): string {
        $path = ltrim($path, '/\\');
        abort_if(str_contains($path, '..'), 403);

        return $path;
    }

    public function serve(string $path, bool $private = false, bool $download = false): BinaryFileResponse {
        $safePath = $this->normalizePath($path);
        $basePath = $this->publicBasePath;

        if ($private) {
            $basePath = $this->privateBasePath;
        }
        $fullPath = realpath($basePath . DIRECTORY_SEPARATOR . $safePath);

        abort_if(!$fullPath, 404, 'File not found');
        abort_if(!File::isFile($fullPath), 404, 'File not found');

        return $download ? response()->download($fullPath) : response()->file($fullPath);
    }
}
