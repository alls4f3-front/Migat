<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $fillable = ['user_id', 'subject', 'description', 'status'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
