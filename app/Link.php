<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    protected $fillable = [
        'original',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function short()
    {
        return app()->encoder->encode($this->id);
    }
}
