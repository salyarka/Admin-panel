<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Forbidden;

class Question extends Model
{
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'status', 'author_name', 'text', 
        'answer', 'topic_id'
    ];

    /**
     * Define relationship.
     *
     * @return Illuminate\Database\Eloquent\Relations\belongsTo
     */
    public function topic() 
    {
        return $this->belongsTo('App\Topic');
    }

    /**
     * Make associative array with forbidden words as keys.
     * 
     * @return array
     */
    public function blockedWords()
    {
        $forbiddens = Forbidden::all();
        $blockedWords = [];
        foreach ($forbiddens as $forbidden) {
            array_push($blockedWords, $forbidden->word);
        }
        return $blockedWords = array_fill_keys($blockedWords, true);
    }

    /**
     * Give forbidden words that are containedin the question.
     * 
     * @return array
     */
    public function getBlockedWords()
    {

        $blockedWords = $this->blockedWords();
        $words = explode(' ', $this->text);
        $findWords = [];
        foreach ($words as $word) {
            if (isset($blockedWords[strtolower($word)])) {
                if (!in_array($word, $findWords)) {
                    array_push($findWords, $word);
                }
            }
        }
        return $findWords;
    }

    /**
     * Checks, is there forbiddens words in question.
     * 
     * @return bool
     */
    public function check()
    {
        $blockedWords = $this->blockedWords();
        $words = explode(' ', $this->text);
        foreach ($words as $word) {
            if (isset($blockedWords[strtolower($word)])) {
                $this->status = 2;
                return True;
            }
        }
        if ($this->status == 2 || !$this->status) {
            $this->status = 0;
        }
    }
}
