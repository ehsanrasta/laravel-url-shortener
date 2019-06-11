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
        'updated_at',
    ];

    protected $appends = [
        'short'
    ];

    public function incrementClicks()
    {
        $this->increment('clicks');
    }

    public function getShortAttribute()
    {
        return app()->encoder->encode($this->id);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
