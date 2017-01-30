<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddWord;
use App\Forbidden;
use App\Services\Log;

class WordController extends Controller
{
    /**
     * Log instance.
     * 
     * @var Log
     */       
    private $myLog;

    /**
     * Create a new controller instance.
     * 
     * @param Log $log
     * @return  void
     */
    public function __construct(Log $log)
    {
        $this->myLog = $log;
    }
    
    /**
     * Add forbidden word.
     *
     * @param  AddWord $request
     * @return Response
     */
    public function addWord(AddWord $request)
    {
        $forbidden = new Forbidden();
        $forbidden->word = $request->word;
        $forbidden->save();
        flash('Слово успешно добавлено.', 'success');
        $this->myLog->write(
            'добавил запрещенное слово "' . 
            $forbidden->word . 
            '" (' . $forbidden->id . ')'
        );
        return redirect()->back();
    }

    /**
     * Delete forbidden word.
     *
     * @param  string $id words id
     * @return Response
     */
    public function deleteWord($id)
    {
        $forbidden = Forbidden::findOrFail($id);
        $forbidden->delete();
        flash('Слово успешно удалено.', 'success');
        $this->myLog->write(
            'удалил запрещенное слово "' .
            $forbidden->word .
            '" (' . $forbidden->id . ')'
        );
        return redirect()->back();        
    }

}
