<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ballot extends Model
{
    use HasFactory;

    protected $fillable = ['ballot_name','details','ballot_key','id'];
}
