<?php

namespace App\Http\Controllers;

use App\Role;
use Illuminate\Http\Request;

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
        $Role = new Role;
        $Role->name = $request->name;
        $Role->display_name = $request->display_name;
        $Role->save();
    }

    public function edit(Role $Role, $id)
    {
        return Role::where('id',$id)->get();
    }
  
    public function update(Request $request, Role $Role, $id)
    {
        $Role = Role::find($id);
        $Role->name = $request->name;
        $Role->display_name = $request->display_name;
        $Role->save();
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
            'name'=>'Tên chức năng',	
            'display_name'=>'Tên hiển thị',
        ]);
    }
}
