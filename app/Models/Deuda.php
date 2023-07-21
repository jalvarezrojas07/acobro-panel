<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deuda extends Model
{
    use HasFactory;
    protected $guarded=[];
    public $timestamps = false;
    protected $table = 'sistema_deuda';
}
