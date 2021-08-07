<?php

namespace App\Http\Controllers;

use App\LoaiVanBan;
use Illuminate\Http\Request;

class LoaiVanBanController extends Controller
{
    public function index()
    {
        return LoaiVanBan::orderBy('thu_tu','asc')->paginate(10);
    }
    public function listLoai()
    {
        return LoaiVanBan::orderBy('thu_tu','asc')->get();
    }
    
    public function store(Request $request)
    {
        $this->validateForm($request);
        $loaiVanBan = new LoaiVanBan;
        $loaiVanBan->ten_loai = $request->ten_loai;
        $loaiVanBan->thu_tu = $request->thu_tu;
        $loaiVanBan->trang_thai = $request->trang_thai;
        $loaiVanBan->save();
    }

    public function edit(LoaiVanBan $loaiVanBan, $id)
    {
        return LoaiVanBan::where('id',$id)->get();
    }
  
    public function update(Request $request, LoaiVanBan $loaiVanBan, $id)
    {
        $loaiVanBan = LoaiVanBan::find($id);
        $loaiVanBan->ten_loai = $request->ten_loai;
        $loaiVanBan->thu_tu = $request->thu_tu;
        $loaiVanBan->trang_thai = $request->trang_thai;
        $loaiVanBan->save();
    }
    
    public function destroy(LoaiVanBan $loaiVanBan, $id)
    {
        LoaiVanBan::destroy($id);
    }
    public function validateForm(Request $request){
        return $request->validate([
            'ten_loai' => 'required',
            'thu_tu' => 'required|numeric',
        ], 
        $messages = [
            'required' => ':attribute không được để trống.',
            'numeric' => ':attribute phải là ký tự số.'
        ],
        $attributes = [
            'ten_loai' => 'Tên loại',
            'thu_tu' => 'Thứ tự'
        ]);
    }
    
}
