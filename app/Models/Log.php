<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function product()
    {
        return $this->hasOne(User::class);
    }

    public function prevLog()
    {
        return $this->hasOne(Log::class, 'prev_log_id');
    }
}
