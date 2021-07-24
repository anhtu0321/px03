ws='7'
        $Permission = new Permi\\\\\\\\\\
        $Permission->display_name = $request->display_name;
        $Permission->key_code = $request->key_code;
        $Permission->parent_id = $request->parent_id;
        $Permission->save();
    }

    public function edit(Permission $Permission, $id)
    {
        return Permission::where('id',$id)->get();
    }
  
    public function update(Request $request, Permission $Permission, $id)
    {
        $Permission = Permission::find($id);
        $Permission->name = $request->name;
        $Permission->display_name = $request->display_name;
        $Permission->key_code = $request->key_code;
        $Permission->parent_id = $request->parent_id;
        $Permission->save();
    }
    
    public function destroy(Permission $Permission, $id)
    {
        Permission::destroy($id);
    }
    public function validateForm(Request $request){
        return $request->validate([
            'name'=>'required',	
            'display_name'=>'required',
            'key_code'=>'required',
            'parent_id'=>'required',777
        ], 
        $messages = [
            'required' => ':attribute không được để trống.',
        ],
        $attributes = [
            'name'=>'Tên chức năng',	
            'display_name'=>'Tên hiển thị',
            'key_code'=>'key_code',
            'parent_id'=>'Chức năng cha',
        ]);
    }
}
