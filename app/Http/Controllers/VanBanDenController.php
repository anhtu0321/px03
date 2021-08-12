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
        ->select('van_ban_den.id','van_ban_den.so','van_ban_den.ngay','van_ban_den.trich_yeu','van_ban_den.ghi_chu','van_ban_den.han_xu_ly','van_ban_den.trang_thai','van_ban_den.file','van_ban_den.duoi_file', 'nguon_den.ten_nguon', 'loai_van_ban.ten_loai')
        ->orderBy('van_ban_den.id','desc')
        ->paginate(10);
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
            $thumucluu = public_path('vanbandenupload/');
            $tenfile = $request->file->getClientOriginalName();
            $tenduoi = $request->file->getClientOriginalExtension();
            if($tenfile !=''){$file_size = $request->file->getSize();}
            $tenfile = $this->convertString($tenfile);
            $tenfile = time().'_'.$file_size.'_'.$tenfile;
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
        $VanBanDen->nguoi_nhap = Auth::user()->fullname; 
        $VanBanDen->save();
    }

    public function edit(VanBanDen $VanBanDen, $id)
    {
        return VanBanDen::where('id',$id)->get();
    }
    public function view(VanBanDen $VanBanDen, $id)
    {
        $vanbanden = DB::table('van_ban_den')
        ->leftjoin('nguon_den','van_ban_den.id_nguon_den', '=', 'nguon_den.id')
        ->leftjoin('loai_van_ban','van_ban_den.id_loai', '=', 'loai_van_ban.id')
        ->leftjoin('users','van_ban_den.id_user_xu_ly', '=', 'users.id')
        ->where('van_ban_den.id',$id)
        ->select('van_ban_den.*', 'nguon_den.ten_nguon', 'loai_van_ban.ten_loai', 'users.fullname')

        ->get();
        return $vanbanden;
    }
    public function update(Request $request, VanBanDen $VanBanDen, $id)
    {
        $this->validateForm($request);
        $VanBanDen = VanBanDen::find($id);
        $file_url=$VanBanDen->file;
        $duoi_file=$VanBanDen->duoi_file;
        if($request->file != ''){
            // Xóa file cũ nếu có
            if($file_url !=''){
                $path = public_path('vanbandenupload/'.$file_url);
                if(file_exists($path)){
                    unlink($path);
                }
            }
            // Upload file mới
            $thumucluu = public_path('vanbandenupload/');
            $tenfile = $request->file->getClientOriginalName();
            $tenduoi = $request->file->getClientOriginalExtension();
            if($tenfile !=''){$file_size = $request->file->getSize();}
            $tenfile = $this->convertString($tenfile);
            $tenfile = time().'_'.$file_size.'_'.$tenfile;
            $file_url = $tenfile;
            $duoi_file = $tenduoi;
            $request->file->move($thumucluu, $tenfile);
        }
        // else{
        //     // Xóa file cũ nếu có
        //     if($file_url !=''){
        //         $path = public_path('vanbandenupload/'.$file_url);
        //         if(file_exists($path)){
        //             unlink($path);
        //         }
        //     }
        //     $file_url="";
        //     $duoi_file="";
        // }
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
        $VanBanDen->nguoi_nhap = Auth::user()->fullname; 
        $VanBanDen->save();
    }
    
    public function destroy(VanBanDen $VanBanDen, $id)
    {
        $file_url = VanBanDen::find($id)->file;
        VanBanDen::destroy($id);
        if($file_url !=''){
            $path = public_path('vanbandenupload/'.$file_url);
            if(file_exists($path)){
                unlink($path);
            }
        }
    }
    public function validateForm(Request $request){
        return $request->validate([
            'trich_yeu' => 'required',
        ], 
        $messages = [
            'required' => ':attribute không được để trống.',
        ],
        $attributes = [
            'trich_yeu' => 'Trích yếu',
        ]);
    }
}
