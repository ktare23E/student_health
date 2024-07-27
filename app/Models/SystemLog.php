<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SystemLog extends Model
{
    use HasFactory;
    protected $fillable = ['date','nurse_id'];

    public function nurse(){
        return $this->belongsTo(Nurse::class);
    }

    public function getReadableDateAttribute()
    {
        // return Carbon::parse($this->date)->format('F j, Y');
        return Carbon::parse($this->date)->format('F j, Y g:i A'); //this is for the datetime format 1:00 PM
    }
}
