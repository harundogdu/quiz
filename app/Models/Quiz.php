<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'description', 'finished_at'];
    protected $dates = ['finished_at'];

    public function getFinishedAtAttribute($date)
    {
        return $date ? Carbon::parse($date) :null;
    }

    public function questions()
    {
        return $this->hasMany('App\Models\Question');
    }
}
