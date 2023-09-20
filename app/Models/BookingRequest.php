<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingRequest extends Model
{
    use HasFactory;

    protected $fillable =[
        'start_time','end_time','comment','hall_id','user_id',
        // 'appointed_id','appointed_type',
    ];

    public function hall(){
        return $this->belongsTo(Hall::class);
    }
    public function user(){
        return $this->belongsTo(User::class);    
    }
}
