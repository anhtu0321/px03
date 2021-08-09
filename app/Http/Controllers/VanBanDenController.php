<?php

namespace App\Http\Controllers;

use App\VanBanDen;
use Illuminate\Http\Request;
use Auth;
use App\traits\ConvertString;

class VanBanDenController extends Controller
{
    use ConvertString;
    public function index()
    {
        return VanBanDen::orderBy('id','desc')->paginate(30);
    }
    
    public function store(Request $request)
    {
        $this->validateForm($request);
        $file_url="";
        if($request->file !=''){
            $file_size = $request->file->getSize();
            $thumucluu = public_path('vanbandenupload/');
            $tenfile = $request->file->getClientOriginalName();
            $tenduoi = $request->file->getClientOriginalExtension();
            $tenfile = $this->convertString($tenfile);
            $tenfile = time().'_'.$file_size.'_'.$tenfile.'.'.$tenduoi;
            $file_url = $tenfile;
            $request->file->move($thumucluu, $tenfile);
        }
        $VanBanDen = new VanBanDen;
        $VanBanDen->id_nguon_den = $request->id_nguon_den;
        $VanBanDen->so = $request->so;
        $VanBanDen->ngay = $request->ngay;
        $VanBanDen->id_loai = $request->id_loai;
        $VanBanDen->trich_yeu = $request->trich_yeu;
        $VanBanDen->do_mat = $request->do_mat;
        $VanBanDen->nguoi_ky = $request->nguoi_ky;
        $VanBanDen->file = $file_url;
        $VanBanDen->phe_duyet = $request->phe_duyet;
        $VanBanDen->id_user_xu_ly = $request->id_user_xu_ly;
        $VanBanDen->han_xu_ly = $request->han_xu_ly;
        $VanBanDen->ghi_chu = $request->ghi_chu; 
        $VanBanDen->nguoi_nhap = Auth::user()->id; 
        $VanBanDen->save();
    }

    public function edit(VanBanDen $VanBanDen, $id)
    {
        return VanBanDen::where('id',$id)->get();
    }
  
    public function update(Request $request, VanBanDen $VanBanDen, $id)
    {
        $VanBanDen = VanBanDen::find($id);
        $VanBanDen->ten_nguon = $request->ten_nguon;
        $VanBanDen->thu_tu = $request->thu_tu;
        $VanBanDen->save();
    }
    
    public function destroy(VanBanDen $VanBanDen, $id)
    {
        VanBanDen::destroy($id);
    }
    public function validateForm(Request $request){
        return $request->validate([
            'trich_yeu' => 'required',
            // 'thu_tu' => 'required|numeric',
        ], 
        $messages = [
            'required' => ':attribute không được để trống.',
            // 'numeric' => ':attribute phải là ký tự số.'
        ],
        $attributes = [
            'trich_yeu' => 'Trích yếu',
            // 'thu_tu' => 'Thứ tự'
        ]);
    }
}
