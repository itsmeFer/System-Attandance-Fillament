<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $fillable = ['user_id', 'check_in', 'check_out', 'check_in_location', 'check_out_location'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
