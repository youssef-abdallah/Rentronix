<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManufacturerInfo extends Model
{
    protected $table = 'manufacturer_info' ;
    protected $guarded = [];
    use HasFactory;

    public function User(){
        return $this->belongsTo(User::class, 'id');
    }
    public function ManufacturerLocation(){
        return $this->hasMany(ManufacturerLocation::class);
    }
}
