<?php

namespace App;

use Illuminate\Database\Eloquent\Model as BaseModel;
use Illuminate\Support\Str;

class Model extends BaseModel
{
	// Desativa o auto incremento numerico
    public $incrementing = false;

    // Necessario para passar informacao em massa
    protected $guarded = [];

    protected static function boot()
    {
        parent::boot();

        static::creating(function($model){
            $model->{$model->getKeyName()} = (string) Str::uuid();
        });
    }
}
