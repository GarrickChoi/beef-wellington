<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
/**
 *  个人中心在线客服！
 *  @author Choi <[309432711@qq.com]>
 *  @date  2018-01-31
 */
class PersonController extends Controller
{
    public function news() 
    { 
    	$id = session('homeUser')->id;
      	$data = DB::table('shop_suggest')->select('id','date','type')
      	->when($id, function ($query) use ($id) {
                    return $query->where('uid', $id);
                })
      	->where('status',2)->get();
      	return view('Home.news',['data' => $data]);
    }

    public function suggest()
    { 
    	return view('Home.suggest');
    }

   public function blog($id)
   { 
   		$data = DB::table('shop_suggest')->select('date','type','question','answer')->where('id',$id)->first();
   		
   		return view('Home.blog',[
   			'date' => $data->date,
   			'type' => $data->type,
   			'question' => $data->question,
   			'answer' => $data->answer
   			]);
   }

   public function doSuggest(Request $request)
   { 
   		$type = $request->input('type');
      	$question = $request->input('question');
      //session拿东西
      	$id = session('homeUser')->id;
      	$name = session('homeUser')->username;


      	if ($type && $question) {
        	DB::table('shop_suggest')->insert(
          		['uid' => $id , 'name' => $name , 'type' => $type , 'question' => $question]);


        	$data = DB::table('shop_suggest')->select('id','date','type')
      		->when($id, function ($query) use ($id) {
                    return $query->where('uid', $id);
                })
      		->where('status',2)->get();
      		return view('Home.news',['data' => $data]);
      	}

      return back()->with('msg','请填写选项和内容');
   }

   public function newsAjax(Request $request)
   { 
   		$id = $request->input('id');
      $type = $request->input('type');

      $data = DB::table('shop_suggest')
      ->select('id','date','type')
      ->when($type, function ($query) use ($type) {
                    return $query->where('status', $type);
                })
      ->where('uid',$id)
      ->get();

      return response()->json([
          'data' => $data,
        ]);

   }
}
