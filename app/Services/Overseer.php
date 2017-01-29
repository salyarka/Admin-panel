<?php

namespace App\Services;

use App\Forbidden;

class Overseer
{
    private $collection;

    public function __construct()
    {
        $lala = Forbidden::all();
        $tr = [];
        foreach ($lala as $la) {
            array_push($tr, $la->word);
        }
        $this->collection = array_fill_keys($tr, true);
    }

    public function check($question)
    {
        $text = $question->text;
        $words = explode(' ', $text);
        $forbidden = [];
        foreach ($words as $word) {
            if (isset($this->collection[strtolower($word)])) {
                array_push($forbidden, $word);
            }
        }
        if ($forbidden) {
            $question->status = 2;
            $question->alert_words = $forbidden[0];
        }
    }
}