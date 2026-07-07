<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\FileDownloadService;

class TermsController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, FileDownloadService $downloader) {
        // TODO: add auth control
        return $downloader->serve('/pdf/terms-and-conditions.pdf', false, false);
    }
}
