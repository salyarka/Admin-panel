<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use App\Http\Requests\AddAdmin;
use App\Http\Requests\EditAdmin;
use Illuminate\Http\Request;
use App\Admin;
use App\Services\Log;

class AdminController extends Controller
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
     * Show main admin panel.
     * 
     * @return Response
     */
    public function show()
    {
        $admins = Admin::all();
        return view('dashboard.admins', ['admins' => $admins]);
    }

    /**
     * Add new admin
     *
     * @param  AddAdmin $request
     * @return Response
     */
    public function add(AddAdmin $request)
    {
        $admin = new Admin();
        $admin->login = $request->login;
        $admin->surname = $request->surname;
        $admin->name = $request->name;
        $admin->password = Hash::make($request->password);
        $admin->role = 'admin';        
        $admin->save();
        flash('Новый администратор успешно добавлен.', 'success');
        $this->myLog->write(
            'добавил администратора "' .
            $admin->login .
            '" (' . $admin->id . ')'
        );        
        return redirect()->back();
    }

    /**
     * Edit admin.
     *
     * @param  EditAdmin $request
     * @param  string    $id       admins id
     * @return Response
     */
    public function edit(EditAdmin $request, $id)
    {
        $admin = Admin::findOrFail($id);
        $admin->login = $request->new_login;
        $admin->surname = $request->new_surname;
        $admin->name = $request->new_name;
        if (strlen($request->new_password) > 0) {
            $admin->password = Hash::make($request->new_password);
        }
        $admin->save();
        $this->myLog->write(
            'изменил данные администратора "' .
            $admin->login .
            '" (' . $admin->id . ')'
        );
        return redirect()->back();
    }

    /**
     * Delete admin.
     *
     * @param  string    $id    admins id
     * @return Response
     */
    public function delete($id)
    {
        $admin = Admin::find($id);
        $admin->delete();
        $this->myLog->write(
            'удалил администратора "' .
            $admin->login .
            '" (' . $admin->id . ')'
        );
        return redirect()->back();
    }
}
