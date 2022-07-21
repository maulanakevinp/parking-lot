<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Parking extends Model
{
    protected $fillable = [
        'license_plate',
        'unique_code',
        'start_time',
        'end_time',
    ];

    public function getPriceAttribute()
    {
        $setting = Setting::first();
        $start = new \DateTime($this->start_time);
        $end = new \DateTime($this->end_time);
        $diff = $start->diff($end);
        return number_format($setting->price_per_hour * $diff->h,'2',',','.');
    }
}
