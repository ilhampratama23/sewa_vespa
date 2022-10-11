<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GambarMotor extends Model
{
    use HasFactory;

    protected $table = 'gambar_motors';

    protected $guarded = ['id'];
}
