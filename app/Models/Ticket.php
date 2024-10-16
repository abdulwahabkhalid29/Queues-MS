<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'business_id',
        'counter_id',
        'status',
        'ticket_number',
        'created_time',
        'completed_at',
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id' , 'user_id');
    }
    public function business()
    {
        return $this->belongsTo(Business::class, 'business_id' , 'business_id');
    }
    public function counter()
    {
        return $this->belongsTo(Counter::class, 'counter_id' , 'counter_id');
    }
}
