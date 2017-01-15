<?php

namespace App\Http\Controllers;

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
        $admin->permissions = 'admin';        
        $admin->save();
        flash('Новый администратор успешно добавлен.', 'success');
        return redirect('admins');
    }

    /**
     * Edit admin.
     * 
     * @return [type] [description]
     */
    public function edit(EditAdmin $request)
    {

    }

    /**
     * Delete admin.
     * 
     * @return [type] [description]
     */
    public function delete()
    {

    }
}
