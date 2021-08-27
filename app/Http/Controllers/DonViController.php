<?php

namespace App\Http\Controllers;

use App\DonVi;
use Illuminate\Http\Request;

class DonViController extends Controller
{
    public function index()
    {
        return DonVi::orderBy('khoi','asc')->orderBy('thu_tu','asc')->paginate(10);
    }
    public function listNoPaginate()
    {
        return DonVi::orderBy('khoi','asc')->orderBy('thu_tu','asc')->where('trang_thai','=','1')->get();
    }
    public function store(Request $request)
    {
        $this->validateForm($request);
        $donvi = new DonVi;
        $donvi->ten_phong = $request->ten_phong;
        $donvi->ky_hieu = $request->ky_hieu;
        $donvi->ten_phong_full = $request->ten_phong_full;
        $donvi->khoi = $request->khoi;
        $donvi->thu_tu = $request->thu_tu;
        $donvi->trang_thai = $request->trang_thai;
        $donvi->save();
    }

    public function edit(DonVi $donvi, $id)
    {
        return DonVi::where('id',$id)->get();
    }
  
    public function update(Request $request, DonVi $donvi, $id)
    {
        $donvi = DonVi::find($id);
        $donvi->ten_phong = $request->ten_phong;
        $donvi->ky_hieu = $request->ky_hieu;
        $donvi->ten_phong_full = $request->ten_phong_full;
        $donvi->khoi = $request->khoi;
        $donvi->thu_tu = $request->thu_tu;
        $donvi->trang_thai = $request->trang_thai;
        $donvi->save();
    }
    
    public function destroy(DonVi $donvi, $id)
    {
        DonVi::destroy($id);
    }
    public function validateForm(Request $request){
        return $request->validate([
            'ten_phong'=>'required',	
            'ky_hieu'=>'required',
            'ten_phong_full'=>'required',
            'khoi'=>'required',
            'thu_tu' => 'required|numeric',
        ], 
        $messages = [
            'required' => ':attribute không được để trống.',
            'numeric' => ':attribute phải là ký tự số.'
        ],
        $attributes = [
            'ten_phong'=>'Tên phòng',	
            'ky_hieu'=>'Ký hiệu',
            'ten_phong_full'=>'Tên đầy đủ',
            'khoi'=>'Khối',
            'thu_tu' => 'Thứ tự'
        ]);
    }
}
