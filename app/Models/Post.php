<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'priority', 'due_date'];

    public function scopeDueInNextSevenDays($query)
    {
        $now = Carbon::now();
        $sevenDaysLater = Carbon::now()->addDays(7);

        
        return $query->whereBetween('due_date', [$now, $sevenDaysLater]);
    }
}
