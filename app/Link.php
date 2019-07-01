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
    ];

    protected $appends = [
        'short',
        'clicksByMonth',
        'totalClicks',
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
        $clicksByMonth = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];

        if (count($this->clicks) === 0) {
            return $clicksByMonth;
        }

        foreach ($this->clicks as $click) {
            $clicksByMonth[$click->month - 1] = $click->click_count;
        }

        return $clicksByMonth;
    }

    public function getTotalClicksAttribute()
    {
        return array_reduce($this->clicksByMonth, function ($carry, $item) {
            return $carry + $item;
        });
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
