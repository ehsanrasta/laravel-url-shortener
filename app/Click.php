<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Click extends Model
{
    protected $fillable = ['link_id'];

    protected $hidden = [
        'id',
        'link_id',
        'updated_at',
    ];

    public function link()
    {
        return $this->hasOne(Link::class);
    }
}
