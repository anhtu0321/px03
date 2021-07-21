<?php

namespace App\Http\Controllers;

use App\LanhDao;
use Illuminate\Http\Request;

class LanhDaoController extends Controller
{
    public function index()
    {
        return LanhDao::orderBy('thu_tu','asc')->paginate(10);
    }
    
    public function store(Request $request)
    {
        $this->validateForm($request);
        $lanhdao = new LanhDao;
        $lanhdao->ho_ten = $request->ho_ten;
        $lanhdao->cap_bac = $request->cap_bac;
        $lanhdao->chuc_vu = $request->chuc_vu;
        $lanhdao->thu_tu = $request->thu_tu;
        $lanhdao->trang_thai = $request->trang_thai;
        $lanhdao->save();
    }

    public function edit(LanhDao $lanhdao, $id)
    {
        return LanhDao::where('id',$id)->get();
    }
  
    public function update(Request $request, LanhDao $lanhdao, $id)
    {
        $lanhdao = LanhDao::find($id);
        $lanhdao->ho_ten = $request->ho_ten;
        $lanhdao->cap_bac = $request->cap_bac;
        $lanhdao->chuc_vu = $request->chuc_vu;
        $lanhdao->thu_tu = $request->thu_tu;
        $lanhdao->trang_thai = $request->trang_thai;
        $lanhdao->save();
    }
    
    public function destroy(LanhDao $lanhdao, $id)
    {
        LanhDao::destroy($id);
    }
    public function validateForm(Request $request){
        return $request->validate([
            'ho_ten' => 'required',
            'cap_bac' => 'required',
            'chuc_vu' => 'required',
            'thu_tu' => 'required|numeric',
        ], 
        $messages = [
            'required' => ':attribute không được để trống.',
            'numeric' => ':attribute phải là ký tự số.'
        ],
        $attributes = [
            'ho_ten' => 'Họ tên',
            'cap_bac' => 'Cấp bậc',
            'chuc_vu' => 'Chức vụ',
            'thu_tu' => 'Thứ tự'
        ]);
    }
}
