<?php

namespace App\Services;

use App\Models\User;
use Tinify\Tinify;
use Tinify\Exception;

class ImageService
{
   public function optimizeAndSave(User $user, $photo)
{
    try {
        \Tinify\setKey(env('TINIFY_API_KEY'));

        // Get the image to compress
        $source = \Tinify\fromFile($photo->getRealPath());

        // Crop and center the image
        $resized = $source->resize([
            "method" => "cover",
            "width" => 70,
            "height" => 70,
        ]);

        // Save the resized image directly to the public directory
        $savePath = public_path('images/users/' . $user->token . '_cropped.jpg');
        $resized->toFile($savePath);

        $user->update(['photo' => 'images/users/' . $user->token . '_cropped.jpg']);

    } catch (\Tinify\Exception $e) {
        echo "Error Tinify API: " . $e->getMessage();
    }
}

}
