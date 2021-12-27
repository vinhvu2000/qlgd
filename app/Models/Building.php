<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Building extends Model
{
    use HasFactory;
    protected $table = "building";
    protected $primaryKey = 'buildingID';
    public $incrementing = false;
    public $timestamps = true;
    protected $fillable = ['buildingID', 'status', 'note']; 
    public function rooms()
    {
    	return $this->hasMany(Room::class,'buildingID');
    }

}
