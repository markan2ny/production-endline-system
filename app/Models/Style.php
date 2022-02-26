<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Style extends Model
{
    use HasFactory, SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = ['style_code', 'style_desc', 'author'];

    public function author() {
        return $this->belongsTo(\App\Models\User::class, 'author_id', 'id');
    }
    public function user() {
        return $this->hasOne(\App\Models\User::class, 'user_id', 'id');
    }
    public function styleModel() {
        return $this->hasMany(\App\Models\StyleModel::class, 'style_id', 'id');
    }

}
