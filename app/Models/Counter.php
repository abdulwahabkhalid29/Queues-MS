<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Counter extends Model
{
    use HasFactory;

    protected $fillable = [
        'business_id',
        'counter_number',
    ];
    public function business()
    {
        return $this->belongsTo(Business::class, 'business_id' , 'business_id');
    }
}
