<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait GeneratePrimaryKeyUuid 
{
    protected static function bootGeneratePrimaryKeyUuid()
    {
        static::creating(function ($model) {
            if (!$model->getKey()) {
                $model->setAttribute($model->getKeyName(), (string) Str::uuid());
            }
        });
    }

  public function getIncrementing()
  {
      return false;
  }

  public function getKeyType()
  {
      return 'string';
  }
}
