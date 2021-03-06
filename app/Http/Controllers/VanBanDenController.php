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
        $vanbanden = DB::table('van_ban_den')
        ->leftjoin('nguon_den','van_ban_den.id_nguon_den', '=', 'nguon_den.id')
        ->leftjoin('loai_van_ban','van_ban_den.id_loai', '=', 'loai_van_ban.id')
        ->select('van_ban_den.id','van_ban_den.so','van_ban_den.ngay','van_ban_den.trich_yeu','van_ban_den.ghi_chu','van_ban_den.han_xu_ly','van_ban_den.trang_thai','van_ban_den.file','van_ban_den.duoi_file', 'nguon_den.ten_nguon', 'loai_van_ban.ten_loai')
        ->orderBy('van_ban_den.id','desc')
        ->paginate(30);
        return $vanbanden;

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
        $VanBanDen->trang_thai = "Ch??a x??? l??"; 
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
            // X??a file c?? n???u c??
            if($file_url !=''){
                $path = public_path('vanbandenupload/'.$file_url);
                if(file_exists($path)){
                    unlink($path);
                }
            }
            // Upload file m???i
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
        // l??u
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
        $VanBanDen->trang_thai = "Ch??a x??? l??"; 
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

    public function search(Request $request){
        $date = date("Y-m-d");
        $vanbanden = DB::table('van_ban_den')
        ->leftjoin('nguon_den','van_ban_den.id_nguon_den', '=', 'nguon_den.id')
        ->leftjoin('loai_van_ban','van_ban_den.id_loai', '=', 'loai_van_ban.id')
        ->select('van_ban_den.id','van_ban_den.so','van_ban_den.ngay','van_ban_den.trich_yeu','van_ban_den.do_mat','van_ban_den.ghi_chu','van_ban_den.han_xu_ly','van_ban_den.trang_thai','van_ban_den.file','van_ban_den.duoi_file', 'nguon_den.ten_nguon', 'loai_van_ban.ten_loai')
        ->where('van_ban_den.trich_yeu','LIKE', '%'.$request->trich_yeu.'%')
        ->where(function($query) use ($request, $date){
            if(($request->date_begin != '') and ($request->date_end != '')){
                $query->whereBetween('van_ban_den.ngay',[$request->date_begin, $request->date_end]);
            }
            if($request->id_nguon_den != ''){
                $query->where('van_ban_den.id_nguon_den','=', $request->id_nguon_den);
            }
            if($request->id_loai != ''){
                $query->where('van_ban_den.id_loai','=', $request->id_loai);
            }
            if($request->so != ''){
                $query->where('van_ban_den.so','LIKE', '%'.$request->so.'%');
            }
            if($request->do_mat == '-1'){
                $query->whereNotIn('van_ban_den.do_mat',[1,2,3])
                      ->orWhere('van_ban_den.do_mat', null);
            }
            if(($request->do_mat != '-1') and ($request->do_mat != '')){
                $query->where('van_ban_den.do_mat','=', $request->do_mat);
            }
            // if Th??m th??ng s??? ????? t??m ki???m theo tr???ng th??i
            if($request->trang_thai == '??ang x??? l??' || $request->trang_thai == 'Ch??a x??? l??'){
                $query->where('van_ban_den.trang_thai','=',$request->trang_thai)
                      ->where(function($query) use ($date){
                            $query->where('van_ban_den.han_xu_ly','>=', $date)
                                  ->orWhere('van_ban_den.han_xu_ly','=', null);
                      });
            }
            if($request->trang_thai == 'Ho??n th??nh' || $request->trang_thai == 'Th???t b???i'){
                $query->where('van_ban_den.trang_thai','=',$request->trang_thai);
            }
            if($request->trang_thai == 'Qu?? h???n'){
                $query->where('van_ban_den.han_xu_ly','<>', null)
                      ->where('van_ban_den.han_xu_ly','<', $date)
                      ->where(function($query){
                        $query->where('van_ban_den.trang_thai','=','Ch??a x??? l??')
                              ->orWhere('van_ban_den.trang_thai','=','??ang x??? l??');
                      });
            }
        })
        ->orderBy('van_ban_den.id','desc')
        ->paginate(30);
        return $vanbanden;
    }

    public function validateForm(Request $request){
        return $request->validate([
            'trich_yeu' => 'required',
        ], 
        $messages = [
            'required' => ':attribute kh??ng ???????c ????? tr???ng.',
        ],
        $attributes = [
            'trich_yeu' => 'Tr??ch y???u',
        ]);
    }

    public function vanbanxuly(){
        $id_user = Auth::user()->id;
        $vanbanden = DB::table('van_ban_den')
        ->select('id','so','ngay','trich_yeu','han_xu_ly','trang_thai','file','duoi_file','luu_tru')
        ->orderBy('trang_thai','desc')
        ->orderBy('han_xu_ly','asc')
        ->where('id_user_xu_ly','=',$id_user)
        ->where('trang_thai','=','Ho??n th??nh')
        ->orWhere('trang_thai','=','Th???t b???i')
        ->paginate(30);
        return $vanbanden;
    }

    public function chuaxuly(){
        $id_user = Auth::user()->id;
        $vanbanden = DB::table('van_ban_den')
        ->select('id','so','ngay','trich_yeu','han_xu_ly','trang_thai','file','duoi_file','luu_tru')
        ->orderBy('trang_thai','desc')
        ->orderBy('han_xu_ly','asc')
        ->where('id_user_xu_ly','=',$id_user)
        ->where('trang_thai','!=','Ho??n th??nh')
        ->where('trang_thai','!=','Th???t b???i')
        ->paginate(30);
        return $vanbanden;
    }
    
    public function capnhattrangthai(Request $request){
        $VanBanDen = VanBanDen::find($request->id);
        $VanBanDen->trang_thai = $request->trang_thai;
        $VanBanDen->luu_tru = $request->luu_tru;
        $VanBanDen->save();
    }
}
