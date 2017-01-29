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
    private $myLog;

    public function __construct(Log $log)
    {
        $this->myLog = $log;
    }

    /**
     * Show main admin panel.
     * 
     * @return [type] [description]
     */
    public function show()
    {
        $admins = Admin::all();
        return view('dashboard.admins', ['admins' => $admins]);
    }

    /**
     * Add new admin
     * 
     * @return
     */
    public function add(AddAdmin $request)
    {
        $admin = new Admin();
        $admin->login = $request->login;
        $admin->surname = $request->surname;
        $admin->name = $request->name;
        $admin->password = $request->password;
        $admin->role = 'admin';        
        $admin->save();
        flash('Новый администратор успешно добавлен.', 'success');
        $this->myLog->write('добавил администратора "' . $admin->login . '" (' . $admin->id . ')');        
        return redirect()->back();
    }

    /**
     * Edit admin.
     * 
     * @return [type] [description]
     */
    public function edit(EditAdmin $request, $id)
    {
        $admin = Admin::findOrFail($id);
        $admin->login = $request->new_login;
        $admin->surname = $request->new_surname;
        $admin->name = $request->new_name;
        if (strlen($request->new_password) > 0) {
            $admin->password = Hash::make($request['new_password']);
        }
        $admin->save();
        $this->myLog->write('изменил данные администратора "' . $admin->login . '" (' . $admin->id . ')');
        return redirect()->back();
    }

    /**
     * Delete admin.
     * 
     * @return [type] [description]
     */
    public function delete(Request $request, $id)
    {
        $admin = Admin::find($id);
        $admin->delete();
        $this->myLog->write('удалил администратора "' . $admin->login . '" (' . $admin->id . ')');
        return redirect()->back();
    }
}
