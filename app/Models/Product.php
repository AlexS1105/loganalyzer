<?php

namespace App\Models;

use Alexxx007\LogAnalyzer\Models\Log;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function logs()
    {
        return $this->hasMany(Log::class);
    }
}
