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

    protected $with = [
        'clicks'
    ];

    protected $appends = [
        'short',
    ];

    public function addClick()
    {
        $this->clicks()->create([
            'link_id' => $this->id,
        ]);
    }

    public function clicks()
    {
        return $this->hasMany(Click::class);
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
