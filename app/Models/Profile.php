<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    public function Author()
    {
        // return $this->belongsTo('App\Models\profile');
        return $this->belongsTo(Author::class);
    }
}
