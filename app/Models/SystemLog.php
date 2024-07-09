<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class SystemLog extends Model
{
    use HasFactory;
    protected $fillable = ['date','nurse_id'];

    public function nurse(){
        return $this->belongsTo(Nurse::class);
    }
}
