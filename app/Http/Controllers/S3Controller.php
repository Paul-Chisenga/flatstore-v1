<?php

namespace App\Http\Controllers;

use App\Services\S3Service;
use Illuminate\Http\Request;

class S3Controller extends Controller
{
    public function __construct(private S3Service $s3Service) {}

    public function downloadFile(Request $request)
    {
        // get file path from request query parameter
        $file_path = $request->query('file_path');

        return $this->s3Service->downloadFile($file_path);
    }
}
