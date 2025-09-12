<?php

namespace App\Traits;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;

trait FileUpload {
  public function uploadFile(UploadedFile $file, string $path = 'uploads') : string {
    $filename = 'educore_'.uniqid().'.'.$file->getClientOriginalExtension();

    // move file to storage
    $file->move(public_path($path), $filename);

    return '/'.$path.'/'.$filename; // example: /uploads/educore_1725067200.jpg
  }

  public function deleteFile(string $path) : bool {
    if(File::exists(public_path($path))) {
      return File::delete(public_path($path));
    }

    return false;
  }
}