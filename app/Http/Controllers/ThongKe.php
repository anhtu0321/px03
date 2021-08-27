<?php

namespace App\Http\Controllers;
use App\VanBanDen;
use App\VanBanDi;
use DB;
use Illuminate\Http\Request;

class ThongKe extends Controller
{
    public function index(){
        $date = date("Y-m-d");
        $vanbanden = DB::table('van_ban_den')->count();
        $vanbandi = DB::table('van_ban_di')->count();
        // thất bại
        $thatbai = DB::table('van_ban_den')
        ->where('trang_thai','=','Thất bại')
        ->count();
        // hoàn thành
        $hoanthanh = DB::table('van_ban_den')
        ->where('trang_thai','=','Hoàn thành')
        ->count();
        // Chưa xử lý
        $chuaxuly = DB::table('van_ban_den')
        ->where('trang_thai','=','Chưa xử lý')
        ->where(function($query) use ($date){
            $query->where('han_xu_ly','>=',$date)
                  ->orWhere('han_xu_ly','=',null);
        })
        ->count();
        // Đang xử lý
        $dangxuly = DB::table('van_ban_den')
        ->where('trang_thai','=','Đang xử lý')
        ->where(function($query) use ($date){
            $query->where('han_xu_ly','>=',$date)
                  ->orWhere('han_xu_ly','=',null);
        })
        ->count();
        // Quá hạn
        $quahan = DB::table('van_ban_den')
        ->where('han_xu_ly','<',$date)
        ->where(function($query){
            $query->where('trang_thai','=','Chưa xử lý')
                  ->orWhere('trang_thai','=','Đang xử lý');
        })
        ->count();
        $bieudotron[] = array('name'=>'Văn bản đến','soluong'=>$vanbanden,'mausac'=>'green');
        $bieudotron[] = array('name'=>'Văn bản đi','soluong'=>$vanbandi,'mausac'=>'orange');
        $xulycongviec = array('tongso'=>$vanbanden,'hoanthanh'=>$hoanthanh,'thatbai'=>$thatbai,'chuaxuly'=>$chuaxuly,'dangxuly'=>$dangxuly,'quahan'=>$quahan);
        return response()->json(['data'=>['bieudotron'=>$bieudotron, 'xulycongviec'=>$xulycongviec]],200);
    }
}
