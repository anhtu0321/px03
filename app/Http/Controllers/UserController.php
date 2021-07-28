<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use DB;
class UserController extends Controller
{
    public function index()
    {
        return User::paginate(10);
    }
    
    public function store(Request $request)
    {
        $this->validateForm($request);
        try{
            DB::beginTransaction();
                $User = new User;
                $User->fullname = $request->fullname;
                $User->username = $request->username;
                $User->password = bcrypt($request->password);
                $User->save();
                $User->roles()->attach($request->roles);
            DB::commit();
        }catch(\Exception $exception){
            DB::rollback();
        }

    }

    public function edit(User $User, $id)
    {
        return User::with('roles')->where('id',$id)->get();
    }
  
    public function update(Request $request, User $User, $id)
    {
        $this->validateFormEdit($request);
        try{
            DB::beginTransaction();
                $User = User::find($id);
                $User->fullname = $request->fullname;
                $User->username = $request->username;
                if($request->password != ''){
                    $User->password = bcrypt($request->password);
                }
                $User->save();
                $User->roles()->sync($request->roles);
            DB::commit();
        }catch(\Exception $exception){
            DB::rollback();
        }
    }
    
    public function destroy(User $User, $id)
    {
        User::destroy($id);
    }
    public function validateForm(Request $request){
        return $request->validate([
            'fullname'=>'required',	
            'username'=>'required',
            'password'=>'required',
        ], 
        $messages = [
            'required' => ':attribute không được để trống.',
        ],
        $attributes = [
            'fullname'=>'Tên hiển thị',	
            'username'=>'Tài khoản',
            'password'=>'Mật khẩu',
        ]);
    }
    public function validateFormEdit(Request $request){
        return $request->validate([
            'fullname'=>'required',	
            'username'=>'required',
        ], 
        $messages = [
            'required' => ':attribute không được để trống.',
        ],
        $attributes = [
            'fullname'=>'Tên hiển thị',	
            'username'=>'Tài khoản',
        ]);
    }
}
