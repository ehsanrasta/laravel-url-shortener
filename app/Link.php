<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    protected $fillable = [
        'original',
    ];

    protected $hidden = [
        'user_id',
        'id',
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
