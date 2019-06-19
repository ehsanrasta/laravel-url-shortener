<?php

namespace App;

use App\User;
use Carbon\Carbon;
use DB;
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
        'clicks'
    ];

    protected $appends = [
        'short',
        'clicksByMonth'
    ];

    public function addClick($date)
    {
        $this->clicks()->create([
            'link_id' => $this->id,
            'created_at' => $date,
        ]);

        //TODO: Job queue instead
    }

    public function clicks()
    {
        return $this->hasMany(Click::class);
    }

    public function getClicksByMonthAttribute()
    {
        $clicksByMonth = [];

        for ($i = 0; $i < 12; $i++) {
            $clicksByMonth[$i] = (int)$this->clicks[$i]['click_count'];
        }

        return $clicksByMonth;
    }

    function getShortAttribute()
    {
        return app()->encoder->encode($this->id);
    }

    public
    function user()
    {
        return $this->belongsTo(User::class);
    }
}
