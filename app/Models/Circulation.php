<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Circulation extends Model
{
    use HasFactory;

    public function Member() {
        return $this->belongsTo('App\Models\Member');
    }

    public function Book() {
        return $this->belongsTo('App\Models\Book');
    }
}
