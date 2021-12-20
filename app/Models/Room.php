<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;
    protected $table = "room";
    public $incrementing = true;
    public $timestamps = true;
    protected $fillable = ['roomID', 'buildingID', 'status', 'note']; 
}
