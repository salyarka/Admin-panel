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
     * [totalQuestions description]
     * 
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function totalQuestions()
    {
        return $this->hasMany('App\Question')->count();
    }

    /**
     * [answeredQuestions description]
     * 
     * @return [type] [description]
     */
    public function publishedQuestions()
    {
        return $this->hasMany('App\Question')->where('status', '=', '1')->count();
    }

    /**
     * [noAnswerQuestions description]
     * 
     * @return [type] [description]
     */
    public function noAnswerQuestions()
    {
        return $this->hasMany('App\Question')->whereNull('answer')->count();
    }
}
