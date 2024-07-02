<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Division;

class District extends Model
{
    use HasFactory;
    protected $fillable = ['district_name','division_id'];

    public function division()
    {
        $this->belongsTo(Division::class);
    }
}
