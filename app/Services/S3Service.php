<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class S3Service
{
    public function uploadFile(UploadedFile $file, $path): string
    {
        // Generate a unique filename
        $filename = uniqid().'_'.$file->getClientOriginalName();

        // Create the full file path
        $filePath = "$path/$filename";

        // Upload the file to S3
        Storage::disk('s3')->put($filePath, file_get_contents($file));

        // Return the file path
        return $filePath;
    }

    public function deleteFile(string $filePath): void
    {
        Storage::disk('s3')->delete($filePath);
    }

    public function downloadFile(string $filePath): mixed
    {
        return Storage::disk('s3')->download($filePath);
    }

    public function getFileContent(string $filePath): string
    {
        return Storage::disk('s3')->get($filePath);
    }
}
