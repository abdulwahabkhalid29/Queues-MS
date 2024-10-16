<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionLog extends Model
{
    use HasFactory;
    protected $fillable = [
        'ticket_id',
        'action',
        'timestamp',
    ];
    public function ticket()
    {
        return $this->belongsTo(Ticket::class, 'ticket_id' , 'ticket_id');
    }
}
