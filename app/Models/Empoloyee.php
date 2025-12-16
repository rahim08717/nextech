<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Empoloyee extends Model
{
   protected $fillable = [
    'name',
    'email',
    'phone',
    'description',
    'image'
];
}
