<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Advertisement extends Model
{
    use HasFactory;

    protected $fillable = ['model_id', 'image'];

    public function model()
    {
        return $this->belongsTo('App\Models\Model');
    }
}
