<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelEntry extends Model
{
    use HasFactory;

    protected $fillable = ['mo','style_id'];

    public function style() {
        return $this->belongsTo(\App\Models\Style::class, 'style_id', 'id');
    }
}
