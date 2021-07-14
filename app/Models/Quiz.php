<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Quiz extends Model
{
    use HasFactory;
    use Sluggable;
    protected $fillable = ['title', 'description', 'finished_at'];
    protected $dates = ['finished_at'];
    protected $appends = ['details'];

    public function getDetailsAttribute(){
        if($this->results()->count() > 0){
            return [
                'average' => round($this->results()->avg('point')),
                'joinCount' => $this->results()->count()
            ]; 
        }
        return null;
    }

    public function results(){
        return $this->hasMany('App\Models\Result');
    }

    public function my_results(){
        return $this->hasOne('App\Models\Result')->where('user_id',auth()->user()->id);
    }

    public function getFinishedAtAttribute($date)
    {
        return $date ? Carbon::parse($date) :null;
    }

    public function questions()
    {
        return $this->hasMany('App\Models\Question');
    }
    public function sluggable(): array
    {
        return [
            'slug' => [
                'onUpdate' => true,
                'source' => 'title'                
            ]
        ];
    }
}
