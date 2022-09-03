<?php

namespace App\Traits;

trait ImageTrait
{
    public function save_image($image_request,$path){
        $name = time() . rand(10,1000) . '.' . $image_request->getClientOriginalExtension();
        $image_request->move($path,$name);
        return $name;
    }
    public function delete_image($imageName){
        if(file_exists($imageName))
            unlink($imageName);
    }
}
