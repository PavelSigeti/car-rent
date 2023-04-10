<?php

namespace App\Services\Interfaces;

interface ImagesContract {

    public function saveMainImage($file, $carId);

    public function saveImages($files, $carId);

    public function savePlaceImage($file, $placeId);

    public function savePostImage($file, $postId);

    public function deleteImage($carId, $groupId);
}

