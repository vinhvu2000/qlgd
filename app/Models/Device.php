<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    use HasFactory;
    protected $table = "device";
    public $incrementing = true;
    public $timestamps = true;
    protected $fillable = ['deviceID', 'deviceName', 'roomID', 'buildingID', 'status', 'note']; 
}
