<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    //
    protected $fillable = ['file'];
    
    protected $uploadPath = '/images/';

    public function getFileAttribute ($photo){

    	return $this->uploadPath . $photo;

    }
}
