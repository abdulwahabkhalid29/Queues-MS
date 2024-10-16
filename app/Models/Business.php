<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Business extends Model
{
    use HasFactory;
    protected $fillable = [
        'business_name',
        'user_id',
        'business_type',
        'email',
        'phone_number',
        'address',
    ];
    public function user()
    {
        return $this->belongsTo(User::class , 'user_id', 'user_id');
    }
}