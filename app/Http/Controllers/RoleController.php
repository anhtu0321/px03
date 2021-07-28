<?php

namespace App\Http\Controllers;

use App\Role;
use App\Permission;
use Illuminate\Http\Request;
use DB;
class RoleController extends Controller
{
    public function index()
    {
        return Role::paginate(10);
    }
    public function listCha(){
        return Role::where('parent_id','0')->get();
    }
    public function store(Request $request)
    {
        $this->validateForm($request);
        try{
            DB::beginTransaction();
                $Role = new Role;
                $Role->name = $request->name;
                $Role->display_name = $request->display_name;
                $Role->save();
                $Role->permissions()->attach($request->mangchucnang);
            DB::commit();
        }catch(\Exception $exception){
            DB::rollback();
        }
    }
    public function edit(Role $Role, $id)
    {
        return Role::with('permissions')->where('id',$id)->get();
    }
  
    public function update(Request $request, Role $Role, $id)
    {
        $this->validateForm($request);
        try{
            DB::beginTransaction();
            $Role = Role::find($id);
            $Role->name = $request->name;
            $Role->display_name = $request->display_name;
            $Role->save();
            $Role->permissions()->sync($request->mangchucnang);
            DB::commit();
        }catch(\Exception $exception){
            DB::rollback();
        }
        
        
    }
    
    public function destroy(Role $Role, $id)
    {
        Role::destroy($id);
    }
    public function validateForm(Request $request){
        return $request->validate([
            'name'=>'required',	
            'display_name'=>'required',
        ], 
        $messages = [
            'required' => ':attribute không được để trống.',
        ],
        $attributes = [
            'name'=>'Tên phân quyền',	
            'display_name'=>'Tên đầy đủ',
        ]);
    }
}
