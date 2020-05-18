<?php

namespace App;

use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

class Channel extends Model implements HasMedia
{
	use HasMediaTrait;

    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    public function image()
    {
    	if ($this->media->first()) {
    		# code...
    		return $this->media->first()->getFullUrl('thumb');
    	}

    	return null;
    }

    public function registerMediaConversions(?Media $media = null)
    {
    	# Cria thumb de imagens 
    	$this->addMediaConversion('thumb')
    		->width(100)
    		->height(100);
    }
}
