<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Casts\Attribute;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class section extends Model
{
    use HasFactory;
    protected $guarded=[];
    protected function description(): Attribute
    {
      return Attribute::make(
            get: fn($value)=> empty($value) ? 'لم يتم كتابة وصف' : $value,
        );
    }
 

}
