<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Question as Question;

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
     * Define relationship.
     * 
     * @return Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function questions() 
    {
        return $this->hasMany('App\Question');
    }

    /**
     * Counts how many questions are unblocked in topic.
     * 
     * @return integer     
     */
    public function totalQuestions()
    {
        return $this->hasMany('App\Question')
                    ->where('status', '<>', '2')
                    ->count();
    }

    /**
     * Counts how many published questions are in topic.
     * 
     * @return integer
     */
    public function publishedQuestions()
    {
        return $this->hasMany('App\Question')
                    ->where('status', '=', '1')
                    ->count();
    }

    /**
     * Counts how many unanswered questions are in topic.
     * 
     * @return integer 
     */
    public function noAnswerQuestions()
    {
        return $this->hasMany('App\Question')
                    ->whereNull('answer')
                    ->where('status', '<>', '2')
                    ->count();
    }
}
