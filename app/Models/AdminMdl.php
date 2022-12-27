<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminMdl extends Model
{
    use HasFactory;
    protected $table='adminlogin';
    protected $primarykey = 'id';
}
