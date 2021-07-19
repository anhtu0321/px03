<?php

namespace App\Http\Controllers;

use App\LoaiVanBan;
use Illuminate\Http\Request;

class LoaiVanBanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return LoaiVanBan::orderBy('thu_tu','asc')->paginate(5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validateForm($request);
        $loaiVanBan = new LoaiVanBan;
        $loaiVanBan->ten_loai = $request->ten_loai;
        $loaiVanBan->thu_tu = $request->thu_tu;
        $loaiVanBan->trang_thai = $request->trang_thai;
        $loaiVanBan->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\LoaiVanBan  $loaiVanBan
     * @return \Illuminate\Http\Response
     */
    public function show(LoaiVanBan $loaiVanBan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\LoaiVanBan  $loaiVanBan
     * @return \Illuminate\Http\Response
     */
    public function edit(LoaiVanBan $loaiVanBan, $id)
    {
        return LoaiVanBan::where('id',$id)->get();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\LoaiVanBan  $loaiVanBan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LoaiVanBan $loaiVanBan, $id)
    {
        $loaiVanBan = LoaiVanBan::find($id);
        $loaiVanBan->ten_loai = $request->ten_loai;
        $loaiVanBan->thu_tu = $request->thu_tu;
        $loaiVanBan->trang_thai = $request->trang_thai;
        $loaiVanBan->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\LoaiVanBan  $loaiVanBan
     * @return \Illuminate\Http\Response
     */
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
        ]
    );
    }
    
}
