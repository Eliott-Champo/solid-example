<?php

namespace App\Models;

use App\Models\Profile;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Twitter extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function profile()
    {
        $this->belongsTo(Profile::class);
    }
}
