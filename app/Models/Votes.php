<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Votes extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = [
        'voters_id',
        'ballot_id'
    ];

}
