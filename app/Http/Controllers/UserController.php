<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use DB;
use Auth;
use Hash;
class UserController extends Controller
{
    public function index()
    {
        return User::with('roles')->paginate(50);
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
    public function getPermissons(){
        $id = Auth::user()->id;
        $permissions = DB::table('user_roles')
        ->join('role_permissions','user_roles.role_id','=','role_permissions.role_id')
        ->join('permissions','role_permissions.permission_id','=','permissions.id')
        ->select('permissions.key_code','permissions.id')
        ->where('user_roles.user_id',$id)
        ->get();
        return $permissions;
    }
    public function doiMatKhau(Request $request){
        $error = array();
        $oldpass = array();
        $newpass = array();
        $renewpass = array();
        $checkError = true;
        if($request->oldpass == ''){
            $oldpass[] ="Mật khẩu cũ không được để trống !";
            $checkError = false;
        }
        if($request->newpass == ''){
            $newpass[] = "Mật khẩu mới không được để trống !";
            $checkError = false;
        }
        if($request->renewpass == ''){
            $renewpass[] = "Nhập lại mật khẩu không được để trống !";
            $checkError = false;
        }
        if(!Hash::check($request->oldpass, Auth::user()->password)){
            $oldpass[] = "Mật khẩu cũ không đúng !"; 
            $checkError = false;
        }
        if($oldpass != []){$error[0]['oldpass'] = $oldpass;}
        if($newpass != []){$error[0]['newpass'] = $newpass;}
        if($renewpass != []){$error[0]['renewpass'] = $renewpass;}
        
        if($checkError == false){
            return response()->json([
                'message' =>'Dữ liệu không hợp lệ !',
                'errors' => $error[0],
            ], 422);
        }else{
            $User = Auth::user();
            // dd($User);
            $User->password = bcrypt($request->newpass);
            $User->save();
        }
        
        
        
    }
}
