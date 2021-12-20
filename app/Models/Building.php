<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Building extends Model
{
    use HasFactory;
    protected $table = "building";
    public $incrementing = true;
    public $timestamps = true;
    protected $fillable = ['buildingID', 'status', 'note']; 
}
