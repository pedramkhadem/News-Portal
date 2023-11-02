<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use App\Traits\FileUploadTrait;
use Illuminate\Http\Request;

class AdminImageController extends Controller
{
    use FileUploadTrait;

    public function image(Request $request)
    {
            $image_path = $this->handleFileUpload($request, 'image');

            return response()->json([
                'message' =>'your image succssfuly upload',
                'image_path' => $image_path,
            ]);
    }
}
