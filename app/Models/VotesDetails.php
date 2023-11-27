<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VotesDetails extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = [
        'vote_id',
        'candidate_id'
    ];
}
