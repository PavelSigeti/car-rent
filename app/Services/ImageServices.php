<?php

namespace App\Services;

use App\Models\Image;
use App\Services\Interfaces\ImagesContract;
use Illuminate\Support\Facades\Storage;

class ImageServices implements ImagesContract {

    public function saveMainImage($file, $carId)
    {
        $checker = true;
        if(Image::query()
            ->where('object_id','=', $carId)
            ->where('type', '=', 'car_main')
            ->exists()
        ) {
            $checker = false;
        }

        $image = $file;
        $name = 'pic_main_'.$carId.'.'.$image->getClientOriginalExtension();
        $path = $image->storeAs('orders/'.$carId, $name, 'public');
        $pathJpg = 'orders/'.$carId.'/pic_main_'.$carId.'.jpg';
        $pathThumbnail = 'orders/'.$carId.'/pic_main_thumb_'.$carId.'.jpg';
        $pathWebp = 'orders/'.$carId.'/pic_main_'.$carId.'.webp';
        $pathWebpThumbnail = 'orders/'.$carId.'/pic_main_thumb_'.$carId.'.webp';

        $im = new \Imagick(public_path('/storage/'.$path));
        $im->setImageFormat("jpg");
        $im->setImageCompression(\Imagick::COMPRESSION_JPEG);
        $im->setImageCompressionQuality(90);
        if($im->getImageWidth() > 1800 || $im->getImageWidth() > 1800)
            $im->adaptiveResizeImage(1800,1800, true, true);
        $im->writeImage('jpg:'.public_path('/storage/'.$pathJpg));

        $im->setImageFormat("webp");
        $im->writeImage('webp:'.public_path('/storage/'.$pathWebp));

        //cropThumbnail
        $im->adaptiveResizeImage(800, 600, true, true);
        $im->writeImage('jpg:'.public_path('/storage/'.$pathThumbnail));
        $im->writeImage('webp:'.public_path('/storage/'.$pathWebpThumbnail));

        if($image->getClientOriginalExtension() == 'png' || $image->getClientOriginalExtension() == 'jpeg') {
            unlink(public_path('storage/'.$path));
        }

        if($checker === true) {
            Image::create([
                'type' => 'car_main_jpg',
                'uri' => '/storage/'.$pathJpg,
                'object_id' => $carId,
                'group_id' => 0,
            ]);
            Image::create([
                'type' => 'car_main_thumb_jpg',
                'uri' => '/storage/'.$pathThumbnail,
                'object_id' => $carId,
                'group_id' => 0,
            ]);
            Image::create([
                'type' => 'car_main',
                'uri' => '/storage/'.$pathWebp,
                'object_id' => $carId,
                'group_id' => 0,
            ]);
            Image::create([
                'type' => 'car_main_thumb',
                'uri' => '/storage/'.$pathWebpThumbnail,
                'object_id' => $carId,
                'group_id' => 0,
            ]);
        } else {
            $images = Image::where('object_id', $carId)
                ->whereIn('type', ['car_main_jpg', 'car_main_thumb_jpg', 'car_main', 'car_main_thumb'])
                ->get();
            foreach ($images as $image) {
                $image->touch();
            }
        }

    }

    public function saveImages($files, $carId)
    {
        $groupId = Image::query()->where('object_id', '=', $carId)
            ->where('type', '=', 'car')
            ->max('group_id');

        if($groupId === null) $groupId = 0;

        $images = $files;
        $i = $groupId + 1;
        foreach($images as $image) {
            $name = 'pic_'.$carId.'_'.$i.'.'.$image->getClientOriginalExtension();

            $path = $image->storeAs('orders/'.$carId, $name, 'public');
            $pathJpg = 'orders/'.$carId.'/pic_'.$carId.'_'.$i.'.jpg';
            $pathThumbnail = 'orders/'.$carId.'/pic_thumb_'.$carId.'_'.$i.'.jpg';
            $pathWebp = 'orders/'.$carId.'/pic_'.$carId.'_'.$i.'.webp';
            $pathWebpThumbnail = 'orders/'.$carId.'/pic_thumb_'.$carId.'_'.$i.'.webp';

            $im = new \Imagick(public_path('/storage/'.$path));
            $im->setImageFormat("jpg");
            $im->setImageCompression(\Imagick::COMPRESSION_JPEG);
            $im->setImageCompressionQuality(70);
            if($im->getImageWidth() > 1800 || $im->getImageWidth() > 1800)
                $im->adaptiveResizeImage(1800,1800, true, true);
            $im->writeImage('jpg:'.public_path('/storage/'.$pathJpg));

            $im->setImageFormat("webp");
            $im->writeImage('webp:'.public_path('/storage/'.$pathWebp));

            $im->cropThumbnailImage(500, 400);
            $im->writeImage('jpg:'.public_path('/storage/'.$pathThumbnail));
            $im->writeImage('webp:'.public_path('/storage/'.$pathWebpThumbnail));

            Image::create([
                'type' => 'car_jpg',
                'uri' => '/storage/'.$pathJpg,
                'object_id' => $carId,
                'group_id'=> $i,
            ]);
            Image::create([
                'type' => 'car_thumb_jpg',
                'uri' => '/storage/'.$pathThumbnail,
                'object_id' => $carId,
                'group_id'=> $i,
            ]);
            Image::create([
                'type' => 'car',
                'uri' => '/storage/'.$pathWebp,
                'object_id' => $carId,
                'group_id'=> $i,
            ]);
            Image::create([
                'type' => 'car_thumb',
                'uri' => '/storage/'.$pathWebpThumbnail,
                'object_id' => $carId,
                'group_id'=> $i,
            ]);
            $i++;

            if($image->getClientOriginalExtension() == 'png' || $image->getClientOriginalExtension() == 'jpeg') {
                unlink(public_path('storage/'.$path));
            }

        }
    }

    public function savePlaceImage($file, $placeId)
    {
        $checker = true;
        if(Image::query()
            ->where('object_id','=', $placeId)
            ->where('type', '=', 'place')
            ->exists()
        ) {
            $checker = false;
        }

        $image = $file;
        $name = 'pic_'.$placeId.'.'.$image->getClientOriginalExtension();
        $path = $image->storeAs('places/'.$placeId, $name, 'public');
        $pathJpg = 'places/'.$placeId.'/pic_'.$placeId.'.jpg';
        $pathWebp = 'places/'.$placeId.'/pic_'.$placeId.'.webp';
        $pathWebpSmall = 'places/'.$placeId.'/pic_sm_'.$placeId.'.webp';

        $im = new \Imagick(public_path('/storage/'.$path));
        $im->setImageFormat("jpg");
        $im->setImageCompression(\Imagick::COMPRESSION_JPEG);
        $im->setImageCompressionQuality(70);
        $im->adaptiveResizeImage(250, 250);
        $im->writeImage('jpg:'.public_path('/storage/'.$pathJpg));

        $im->setImageFormat("webp");
        $im->writeImage('webp:'.public_path('/storage/'.$pathWebp));

        $im->adaptiveResizeImage(100, 100);
        $im->writeImage('webp:'.public_path('/storage/'.$pathWebpSmall));

        if($checker === true) {
            Image::create([
                'type' => 'place',
                'uri' => '/storage/'.$pathJpg,
                'object_id' => $placeId,
                'group_id' => 0,
            ]);
            Image::create([
                'type' => 'place_webp',
                'uri' => '/storage/'.$pathWebp,
                'object_id' => $placeId,
                'group_id' => 0,
            ]);
            Image::create([
                'type' => 'place_webp_sm',
                'uri' => '/storage/'.$pathWebpSmall,
                'object_id' => $placeId,
                'group_id' => 0,
            ]);
        } else {
            $images = Image::where('object_id', $placeId)
                ->whereIn('type', ['place', 'place_webp', 'place_webp_sm'])
                ->get();
            foreach ($images as $image) {
                $image->touch();
            }
        }
    }

    public function savePostImage($file, $postId)
    {
        $checker = true;
        if(Image::query()
            ->where('object_id','=', $postId)
            ->where('type', '=', 'post')
            ->exists()
        ) {
            $checker = false;
        }

        $image = $file;
        $name = 'pic_'.$postId.'.'.$image->getClientOriginalExtension();
        $path = $image->storeAs('posts/'.$postId, $name, 'public');
        $pathJpg = 'posts/'.$postId.'/pic_jpg.jpg';
        $pathWebp = 'posts/'.$postId.'/pic_webp.webp';

        $im = new \Imagick(public_path('/storage/'.$path));
        $im->setImageFormat("jpg");
        $im->setImageCompression(\Imagick::COMPRESSION_JPEG);
        $im->setImageCompressionQuality(70);
        $im->adaptiveResizeImage(450, 300);
        $im->writeImage('jpg:'.public_path('/storage/'.$pathJpg));

        $im->setImageFormat("webp");
        $im->writeImage('webp:'.public_path('/storage/'.$pathWebp));

        unlink(public_path('/storage/'.$path));

        if($checker === true) {
            Image::create([
                'type' => 'post',
                'uri' => '/storage/'.$pathJpg,
                'object_id' => $postId,
                'group_id' => 0,
            ]);
            Image::create([
                'type' => 'post_webp',
                'uri' => '/storage/'.$pathWebp,
                'object_id' => $postId,
                'group_id' => 0,
            ]);
        } else {
            $images = Image::where('object_id', $postId)
                ->whereIn('type', ['post', 'post_webp'])
                ->get();
            foreach ($images as $image) {
                $image->touch();
            }
        }
    }

    public function deleteImage($carId, $groupId) {
        $whereIn = ['car_jpg', 'car_thumb_jpg', 'car', 'car_thumb'];
        $images = Image::query()
            ->where('object_id', '=', $carId)
            ->where('group_id', '=', $groupId)
            ->whereIn('type',$whereIn)
            ->get();

        foreach ($images as $image) {
            unlink(public_path($image->uri));
            $image->delete();
        }
    }

    public function deleteCarImages($carId) {
        $whereIn = [
            'car_jpg', 'car_thumb_jpg', 'car',
            'car_thumb', 'car_main_jpg', 'car_main_thumb_jpg',
            'car_main', 'car_main_thumb',
        ];
        $images = Image::query()
            ->where('object_id', '=', $carId)
            ->whereIn('type',$whereIn)
            ->get();

        foreach ($images as $image) {
            unlink(public_path($image->uri));
            $image->delete();
        }
    }



}
