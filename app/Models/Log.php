<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function getPrevious($amount)
    {
        $toRet = [];
        $log = $this;

        while(count($toRet) < $amount && $log->prevLog) {
            $prev = $log->prevLog;
            array_push($toRet, $prev);
            $log = $prev;
        }

        return $toRet;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function nextLog()
    {
        return $this->hasOne(Log::class, 'prev_log_id');
    }

    public function prevLog()
    {
        return $this->belongsTo(Log::class, 'prev_log_id');
    }
}
