<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Question;
use DB;

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
     * Get the questions that have an answer.
     * 
     * @return Illuminate\Support\Collection
     */
    static public function answeredQuestions()
    {
        return $questions = DB::table('questions')
                                    ->join('topics', 'questions.topic_id', '=', 'topics.id')
                                    ->whereNotNull('answer')
                                    ->get();
    }

    /**
     * Checks have the answer questions or not.
     * 
     * @param  string  topic id.
     * @return boolean
     */
    public function haveAnsweredQuestions($id)
    {
        $query = DB::table('questions')
                        ->join('topics', 'questions.topic_id', '=', 'topics.id')
                        ->whereNotNull('answer')
                        ->where('questions.topic_id', '=', $id)
                        ->get();
        return count($query) > 0;
    }
}
