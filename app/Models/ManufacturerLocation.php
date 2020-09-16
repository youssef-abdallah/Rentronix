<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManufacturerLocation extends Model
{
    use HasFactory;
    public function ManufacturerInfo()
    {
        return $this->belongsTo(ManufacturerInfo::class);
    }
}
