<?php

namespace App\Http\Controllers;

use App\Diadiem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('profile.edit');
    }
    // public function submit()
    // {
    //     $oid=11;
    //     DB::update('update diadiem set name = ? where objectid = ?', ["ok",$oid]);
    // }
    public function submit(Request $request)
    {
        $name=$request->name;
        $objectid=$request->oid;
        $loai=$request->loai;
        $diadiem = Diadiem::find($objectid);
        // $post->title = "Title bài viết thứ 2";
        // $post->save();
        $diadiem->name=$name;
        $diadiem->loai=$loai;
        $diadiem->save();
        Session::flash('success', 'Bạn thay đổi post thành công');
        // return redirect()->route('posts');
    }
}
