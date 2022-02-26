<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Record extends Model
{
    use HasFactory;

    protected $fillable = ['bundle_tag', 'operator', 'operations', 'qty'];

    public function user() {

        return $this->belongsTo(\App\Models\User::class, 'user_entry_id', 'id');

    }
}
