<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\User;
use App\Billing\Traits\UserManagement;

class ClientsController extends Controller
{
    use UserManagement;

    public function clients_store()
    {
        $data = request()->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $data['password'] = bcrypt(request()->password);
        $data['role_id'] = 4;
        
        User::create($data);

        return back();
    }

    public function clients_update()
    {
        $data = request()->validate([
            'id' => 'required',
            'name' => 'required',
            'email' => 'required|email',
            'password' => ''
        ]);

        if ($data['password'] == '')
            unset($data['password']);

        $data['password'] = bcrypt(request()->password);
        $data['role_id'] = 4;
        
        User::find($data['id'])->update($data);

        return back();
    }

    public function client_lock($id)
    {
        if($this->lockClient($id)){
            return redirect()->back();
        }
    }
}
