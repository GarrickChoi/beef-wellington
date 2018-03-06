<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class Friendsline extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = DB::table('shop_friendsline')->paginate(10);
        if ($data) {
            return view('Admin.Friendsline.friendslist',['data' => $data]);
        } else {
            return view('Admin.AdminUser.login');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Admin.Friendsline.friendslist-add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $name = $request->input('name');
        $url = $request->input('url');
        $status = $request->input('status');
        $friendsline = DB::table('shop_friendsline')->insert(['name' => $name, 'url' => $url, 'status' => $status]);
        if ($friendsline) {          
            return redirect('friendsline');
        } else {
            return redirect('Admin.AdminUser.login');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = DB::table('shop_friendsline')->select('id','name','url','status')->where('id',$id)->get();
        if ($data) {
            return view('Admin.Friendsline.friendslist-edit',['data' => $data]);
        } else {
            return view('Admin.AdminUser.login');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $name = $request->input('name');
        $url = $request->input('url');
        $status = $request->input('status');
        $fline = DB::table('shop_friendsline')->where('id', $id)->update(['name' => $name, 'url' => $url ,'status' => $status]);

        if ($fline) {
            return redirect('friendsline');
        } else {
            return redirect('Admin.AdminUser.login');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $shop_friendsline = DB::table('shop_friendsline')->where('id', $id)->delete();

        if ($shop_friendsline) {
            return redirect('friendsline');
        } else {
            return redirect('Admin.AdminUser.login');
        }
    }
}
