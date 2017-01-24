<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use App\Http\Requests\AddAdmin;
use App\Http\Requests\EditAdmin;
use Illuminate\Http\Request;
use App\Admin;

class AdminController extends Controller
{
    /**
     * Show main admin panel.
     * 
     * @return [type] [description]
     */
    public function show()
    {
        $admins = Admin::all();
        return view('admin_panel/admins', ['admins' => $admins]);
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
        return redirect('admins');
    }

    /**
     * Edit admin.
     * 
     * @return [type] [description]
     */
    public function edit(EditAdmin $request, $id)
    {
        $admin = Admin::find($id);
        $admin->login = $request->new_login;
        $admin->surname = $request->new_surname;
        $admin->name = $request->new_name;
        if (strlen($request->new_password) > 0) {
            $admin->password = Hash::make($request['new_password']);
        }
        $admin->save();
        return redirect('admins');
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
        return redirect('/admins');
    }
}
