<?php

namespace App\Http\Controllers;

use App\NguonDi;
use Illuminate\Http\Request;

class NguonDiController extends Controller
{
    public function index()
    {
        return NguonDi::orderBy('thu_tu','asc')->paginate(10);
    }
    
    public function store(Request $request)
    {
        $this->validateForm($request);
        $nguonDi = new NguonDi;
        $nguonDi->ten_nguon = $request->ten_nguon;
        $nguonDi->thu_tu = $request->thu_tu;
        $nguonDi->save();
    }

    public function edit(NguonDi $nguonDi, $id)
    {
        return NguonDi::where('id',$id)->get();
    }
  
    public function update(Request $request, NguonDi $nguonDi, $id)
    {
        $nguonDi = NguonDi::find($id);
        $nguonDi->ten_nguon = $request->ten_nguon;
        $nguonDi->thu_tu = $request->thu_tu;
        $nguonDi->save();
    }
    
    public function destroy(NguonDi $nguonDi, $id)
    {
        NguonDi::destroy($id);
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
