<?php

namespace App\Models;

use App\Models\Position;
use App\Models\Candidates;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ballot extends Model
{
    use HasFactory;

    protected $primary_id = 'ballot_id';
    protected $table = 'ballots';

    protected $fillable = ['ballot_name','details','ballot_key','id'];

        public function Positions()
        {
            return $this->hasManyThrough(
                Position::class,
                Candidates::class,
                'ballot_id',
                'ballot_id'
            );
        }


}
