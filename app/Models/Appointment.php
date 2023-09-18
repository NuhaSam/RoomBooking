<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable =[
        'appointed_id','appointed_type','hall_id','start_date','end_date','comments',
    ];
    public function appointed(){
        return $this->morphTo();
    }
    public function hall(){
        return $this->belongsTo(Hall::class);
    }
}
