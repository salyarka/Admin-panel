<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Topic;

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
        'status', 'author_name', 'text', 'answer', 'topic_id'
    ];

    /**
     * Define relationship.
     */
    public function topic() 
    {
        return $this->belongsTo('App\Topic');
    }

    public function scopeAnswered($query)
    {
        return $query->whereNotNull('answer'); // Корректно ли делать такой запрос? возвомжно использовать whereNotNull
    }
}
