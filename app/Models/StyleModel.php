<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StyleModel extends Model
{
    use HasFactory;

    protected $fillable = ['model_name', 'style_id'];

    public function getStyle() {

        return $this->belongsTo(\App\Models\Style::class, 'style_id', 'id');

    }
}
