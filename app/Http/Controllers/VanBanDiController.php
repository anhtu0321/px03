<?php

namespace App\Http\Controllers;

use App\VanBanDi;
use Illuminate\Http\Request;
use Auth;
use DB;
use App\traits\ConvertString;

class VanBanDiController extends Controller
{
    use ConvertString;
    public function index()
    {
        $vanbandi = DB::table('van_ban_di')
        ->leftjoin('nguon_di','van_ban_di.id_nguon_di', '=', 'nguon_di.id')
        ->leftjoin('loai_van_ban','van_ban_di.id_loai', '=', 'loai_van_ban.id')
        ->select('van_ban_di.id','van_ban_di.so','van_ban_di.ngay','van_ban_di.trich_yeu','van_ban_di.ghi_chu','van_ban_di.han_xu_ly','van_ban_di.trang_thai','van_ban_di.file','van_ban_di.duoi_file', 'nguon_di.ten_nguon', 'loai_van_ban.ten_loai')
        ->orderBy('van_ban_di.id','desc')
        ->paginate(30);
        return $vanbandi;

    }
    
    public function store(Request $request)
    {
        $this->validateForm($request);
        $file_url="";
        $duoi_file="";
        if($request->file !=''){
            $thumucluu = public_path('vanbandiupload/');
            $tenfile = $request->file->getClientOriginalName();
            $tenduoi = $request->file->getClientOriginalExtension();
            if($tenfile !=''){$file_size = $request->file->getSize();}
            $tenfile = $this->convertString($tenfile);
            $tenfile = time().'_'.$file_size.'_'.$tenfile;
            $file_url = $tenfile;
            $duoi_file = $tenduoi;
            $request->file->move($thumucluu, $tenfile);
        }
        $VanBanDi = new VanBanDi;
        $VanBanDi->id_nguon_di = $request->id_nguon_di;
        $VanBanDi->so = $request->so;
        $VanBanDi->ngay = $request->ngay;
        $VanBanDi->id_loai = $request->id_loai;
        $VanBanDi->trich_yeu = $request->trich_yeu;
        $VanBanDi->noi_dung = $request->noi_dung;
        $VanBanDi->do_mat = $request->do_mat;
        $VanBanDi->id_lanh_dao = $request->id_lanh_dao;
        $VanBanDi->file = $file_url;
        $VanBanDi->duoi_file = $duoi_file;
        $VanBanDi->don_vi_nhan = $request->don_vi_nhan;
        $VanBanDi->can_bo_tham_muu = $request->can_bo_tham_muu;
        $VanBanDi->luu_tru = $request->luu_tru;
        $VanBanDi->ghi_chu = $request->ghi_chu; 
        $VanBanDi->nguoi_nhap = Auth::user()->fullname; 
        $VanBanDi->save();
    }

    public function edit(VanBanDi $VanBanDi, $id)
    {
        return VanBanDi::where('id',$id)->get();
    }
    public function view(VanBanDi $VanBanDi, $id)
    {
        $vanbandi = DB::table('van_ban_di')
        ->leftjoin('nguon_di','van_ban_di.id_nguon_di', '=', 'nguon_di.id')
        ->leftjoin('loai_van_ban','van_ban_di.id_loai', '=', 'loai_van_ban.id')
        ->leftjoin('lanh_dao','van_ban_di.id_lanh_dao', '=', 'lanh_dao.id')
        ->where('van_ban_di.id',$id)
        ->select('van_ban_di.*', 'nguon_di.ten_nguon', 'loai_van_ban.ten_loai', 'lanh_dao.cap_bac', 'lanh_dao.ho_ten')

        ->get();
        return $vanbandi;
    }
    public function update(Request $request, VanBanDi $VanBanDi, $id)
    {
        $this->validateForm($request);
        $VanBanDi = VanBanDi::find($id);
        $file_url=$VanBanDi->file;
        $duoi_file=$VanBanDi->duoi_file;
        if($request->file != ''){
            // Xóa file cũ nếu có
            if($file_url !=''){
                $path = public_path('vanbandiupload/'.$file_url);
                if(file_exists($path)){
                    unlink($path);
                }
            }
            // Upload file mới
            $thumucluu = public_path('vanbandiupload/');
            $tenfile = $request->file->getClientOriginalName();
            $tenduoi = $request->file->getClientOriginalExtension();
            if($tenfile !=''){$file_size = $request->file->getSize();}
            $tenfile = $this->convertString($tenfile);
            $tenfile = time().'_'.$file_size.'_'.$tenfile;
            $file_url = $tenfile;
            $duoi_file = $tenduoi;
            $request->file->move($thumucluu, $tenfile);
        }
        // lưu
        $VanBanDi->id_nguon_di = $request->id_nguon_di;
        $VanBanDi->so = $request->so;
        $VanBanDi->ngay = $request->ngay;
        $VanBanDi->id_loai = $request->id_loai;
        $VanBanDi->trich_yeu = $request->trich_yeu;
        $VanBanDi->noi_dung = $request->noi_dung;
        $VanBanDi->do_mat = $request->do_mat;
        $VanBanDi->id_lanh_dao = $request->id_lanh_dao;
        $VanBanDi->file = $file_url;
        $VanBanDi->duoi_file = $duoi_file;
        $VanBanDi->don_vi_nhan = $request->don_vi_nhan;
        $VanBanDi->can_bo_tham_muu = $request->can_bo_tham_muu;
        $VanBanDi->luu_tru = $request->luu_tru;
        $VanBanDi->ghi_chu = $request->ghi_chu; 
        $VanBanDi->nguoi_nhap = Auth::user()->fullname; 
        $VanBanDi->save();
    }
    
    public function destroy(VanBanDi $VanBanDi, $id)
    {
        $file_url = VanBanDi::find($id)->file;
        VanBanDi::destroy($id);
        if($file_url !=''){
            $path = public_path('vanbandiupload/'.$file_url);
            if(file_exists($path)){
                unlink($path);
            }
        }
    }

    public function search(Request $request){
        $vanbandi = DB::table('van_ban_di')
        ->leftjoin('nguon_di','van_ban_di.id_nguon_di', '=', 'nguon_di.id')
        ->leftjoin('loai_van_ban','van_ban_di.id_loai', '=', 'loai_van_ban.id')
        ->select('van_ban_di.id','van_ban_di.so','van_ban_di.ngay','van_ban_di.trich_yeu','van_ban_di.noi_dung','van_ban_di.do_mat','van_ban_di.don_vi_nhan','van_ban_di.can_bo_tham_muu','van_ban_di.luu_tru','van_ban_di.ghi_chu','van_ban_di.file','van_ban_di.duoi_file', 'nguon_di.ten_nguon', 'loai_van_ban.ten_loai')
        ->where('van_ban_di.trich_yeu','LIKE', '%'.$request->trich_yeu.'%')
        
        ->where(function($query) use ($request){
            if($request->noi_dung != ''){
                $query->where('van_ban_di.noi_dung','LIKE', '%'.$request->noi_dung.'%');
            }
            if(($request->date_begin != '') and ($request->date_end != '')){
                $query->whereBetween('van_ban_di.ngay',[$request->date_begin, $request->date_end]);
            }
            if($request->id_nguon_di != ''){
                $query->where('van_ban_di.id_nguon_di','=', $request->id_nguon_di);
            }
            if($request->id_loai != ''){
                $query->where('van_ban_di.id_loai','=', $request->id_loai);
            }
            if($request->so != ''){
                $query->where('van_ban_di.so','LIKE', '%'.$request->so.'%');
            }
            if($request->do_mat == '-1'){
                $query->whereNotIn('van_ban_di.do_mat',[1,2,3])
                      ->orWhere('van_ban_di.do_mat', null);
            }
            if(($request->do_mat != '-1') and ($request->do_mat != '')){
                $query->where('van_ban_di.do_mat','=', $request->do_mat);
            }
            if($request->don_vi_nhan != ''){
                $query->where('van_ban_di.don_vi_nhan','LIKE', '%'.$request->don_vi_nhan.'%');
            }
            if($request->can_bo_tham_muu != ''){
                $query->where('van_ban_di.can_bo_tham_muu','LIKE', '%'.$request->can_bo_tham_muu.'%');
            }
        })
        ->orderBy('van_ban_di.id','desc')
        ->paginate(30);
        return $vanbandi;
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
