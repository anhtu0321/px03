<?php

namespace App\Http\Controllers;

use App\VanBanDen;
use Illuminate\Http\Request;
use Auth;
use DB;
use App\traits\ConvertString;

class VanBanDenController extends Controller
{
    use ConvertString;
    public function index()
    {
        // return VanBanDen::orderBy('id','desc')->paginate(30);
        $vanbanden = DB::table('van_ban_den')
        ->leftjoin('nguon_den','van_ban_den.id_nguon_den', '=', 'nguon_den.id')
        ->leftjoin('loai_van_ban','van_ban_den.id_loai', '=', 'loai_van_ban.id')
        ->select('van_ban_den.so','van_ban_den.ngay','van_ban_den.trich_yeu','van_ban_den.ghi_chu','van_ban_den.trang_thai','van_ban_den.file','van_ban_den.duoi_file', 'nguon_den.ten_nguon', 'loai_van_ban.ten_loai')
        ->orderBy('van_ban_den.id','desc')
        ->paginate(30);
        return $vanbanden;

        // >join('contacts', 'users.id', '=', 'contacts.user_id')
        //     ->join('orders', 'users.id', '=', 'orders.user_id')
        //     ->select('users.*', 'contacts.phone', 'orders.price')
        //     ->get();
    }
    
    public function store(Request $request)
    {
        $this->validateForm($request);
        $file_url="";
        $duoi_file="";
        if($request->file !=''){
            $file_size = $request->file->getSize();
            $thumucluu = public_path('vanbandenupload/');
            $tenfile = $request->file->getClientOriginalName();
            $tenduoi = $request->file->getClientOriginalExtension();
            $tenfile = $this->convertString($tenfile);
            $tenfile = time().'_'.$file_size.'_'.$tenfile.'.'.$tenduoi;
            $file_url = $tenfile;
            $duoi_file = $tenduoi;
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
        $VanBanDen->duoi_file = $duoi_file;
        $VanBanDen->phe_duyet = $request->phe_duyet;
        $VanBanDen->id_user_xu_ly = $request->id_user_xu_ly;
        $VanBanDen->han_xu_ly = $request->han_xu_ly;
        $VanBanDen->ghi_chu = $request->ghi_chu; 
        $VanBanDen->trang_thai = "Chưa xử lý"; 
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
