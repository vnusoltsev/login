<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SecretKey extends Model
{
    protected $guarded = false;
    protected $table = 'secret_key';
}
