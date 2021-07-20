<?php

namespace App\Http\Controllers;

use App\NguonDen;
use Illuminate\Http\Request;

class NguonDenController extends Controller
{
    public function index()
    {
        return NguonDen::orderBy('thu_tu','asc')->paginate(10);
    }
    
    public function store(Request $request)
    {
        $this->validateForm($request);
        $nguonDen = new NguonDen;
        $nguonDen->ten_nguon = $request->ten_nguon;
        $nguonDen->thu_tu = $request->thu_tu;
        $nguonDen->save();
    }

    public function edit(NguonDen $nguonDen, $id)
    {
        return NguonDen::where('id',$id)->get();
    }
  
    public function update(Request $request, NguonDen $nguonDen, $id)
    {
        $nguonDen = NguonDen::find($id);
        $nguonDen->ten_nguon = $request->ten_nguon;
        $nguonDen->thu_tu = $request->thu_tu;
        $nguonDen->save();
    }
    
    public function destroy(NguonDen $nguonDen, $id)
    {
        NguonDen::destroy($id);
    }
    public function validateForm(Request $request){
        return $request->validate([
            'ten_nguon' => 'required',
            'thu_tu' => 'required|numeric',
        ], 
        $messages = [
            'required' => ':attribute không được để trống.',
            'numeric' => ':attribute phải là ký tự số.'
        ],
        $attributes = [
            'ten_nguon' => 'Tên nguồn',
            'thu_tu' => 'Thứ tự'
        ]);
    }
}
