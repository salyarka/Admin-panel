<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Question;

class Topic extends Model
{
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title'];

    /**
     * Get the questions associated with the topic.
     */
    public function questions() 
    {
        return $this->hasMany('App\Question');
    }

    // public function scopeAnswered($query)
    // {
    //     return questions()->whereNotNull('answer')->get(); // Корректно ли делать такой запрос? возвомжно использовать whereNotNull
    // }
}
