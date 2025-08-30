<?php

namespace App\Traits;

use Illuminate\Http\UploadedFile;

trait FileUpload {
  public function uploadFile(UploadedFile $file, string $path = 'uploads') : string {
    $filename = 'educore_'.uniqid().'.'.$file->getClientOriginalExtension();

    // move file to storage
    $file->move(public_path($path), $filename);

    return '/'.$path.'/'.$filename; // example: /uploads/educore_1725067200.jpg
  }
}