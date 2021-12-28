<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;
    protected $table = "schedules";
    public $incrementing = true;
    public $timestamps = true;
    protected $fillable = ['id', 'day', 'timeStart', 'timeEnd', 'buildingID', 'roomID', 'subjectID', 'subjectName', 'credit', 'user', 'listDevice', 'teacher', 'status']; 
}
