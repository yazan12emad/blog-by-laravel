<?php

namespace App\Services;

class FileUploadService
{
    public function uploadFile($file, $directory = 'uploads' ,$folder = 'public' )
    {
        if (!$file->isValid()) {
            throw new \Exception('Invalid file upload.');
        }

        $path = $file->store($directory, $folder);

        if (!$path) {
            throw new \Exception('Failed to store the uploaded file.');
        }

        return $path;
    }

}
