<?php

namespace App\Models\Dice;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiceResults extends Model
{
    use HasFactory;

    protected $table = 'diceresults';
    protected $primaryKey = 'id';
    public $timestamps = false;
}
