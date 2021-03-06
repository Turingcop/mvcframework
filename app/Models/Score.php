<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method create($array)
 */
class Score extends Model
{
    use HasFactory;

    protected $table = 'score';

    protected $fillable = ['score', 'name'];
}
