<?php

namespace App\Http\Controllers;

//use Ixudra\Curl\Facades\Curl;
//use App\Jobs\Queue;
use App\Jobs\Queue;
use Illuminate\Support\Facades\DB;
use App\tuser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Ixudra\Curl\Facades\Curl;


//use Ixudra\Curl\Facades\Curl;

class ShopController extends Controller
{
    public function login()
    {
        return view('shop/dologin');
    }
    public function yz(Request $request)
    {
        $name=$request->get('name');
        $pwd=$request->get('password');
        //var_dump($name);
        $user=new tuser();
        $res=$user::where(['name'=>$name,'pwd'=>$pwd])->get();
        //var_dump($res);
        if ($res)
        {

            return redirect('shop/show');
        }

    }
    public function show()
    {
         $data=DB::table('tgood')->get();
         //var_dump($data);
        return view('shop/show',['data'=>$data]);
    }
    public function buy($id)
    {
         //echo $id;
        $data=DB::table('tgood')->where(['id'=>$id])->get()->toArray();
        //var_dump($data[0]->gname);
        $db=DB::table('dgood')->insert(
            ['dname' =>$data[0]->gname , 'dprice' => $data[0]->gprice]
        );
        if ($db)
        {
            $this->dispatch(new Queue($data));
            return response()->json(['code'=>0, 'msg'=>"success"]);
        }

    }
    public function see()
    {
        $res=Curl::to('localhost:9200/_search')
            ->withContentType('application/json')
            ->get();
        return $res;
    }

    public function add()
    {
         return view('shop/insert');
    }

//    public function doadd(Request $request)
//    {
//        $data=$request->toArray();
//        $this->dispatch(new Queue($data));
//        //var_dump($data);die;
////        $db=DB::table('tgood')->insertGetId(['gname' => $data['gname'],'gprice'=>$data['gprice']]);
//        $res=Curl::to('http://localhost:9200/test/tgood')
//            ->withData(json_encode($data,true))
//            ->withContentType('application/json')
//            ->post();
//        return $res;
//    }
//    public function del(Request $request)
//    {
//        $id=$request->id;
//        $res = Curl::to('http://localhost:9200/laravel5.8/blog/'.$id)
//            ->withContentType('application/json')
//            ->delete();
//        return $res;
//    }
//
//    public function search(Request $request){
//             $value=$request->get('value');
//             $page=$request->get('page');
//        $arr=[
//            "query"=>[
//                "wildcard"=>[
//                    "gname"=>"*$value*"
//                ]
//            ],
//            "size"=>2,
//            "from"=>($page-1)*2,
//
//
//        ];
//
//        $res=Curl::to("http://localhost:9200/test/tgood/_search")
//            ->withData(json_encode($arr))
//            ->withContentType("application/json")
//            ->post();
//
//        return $res;
//    }

      public function doadd(Request $request)
      {
          $data=$request->toArray();
          $this->dispatch(new Queue($data));

          $db=DB::table('tgood')->insertGetId(['gname'=>$data['gname'],'gcount'=>$data['gcount'],'gprice'=>$data['gprice']]);

          $res=Curl::to('http://localhost:9200/shop/tgood/'.$db)
              ->withData(json_encode($data))
              ->withContentType('application/json')
              ->post();
//
//          if ($res)
//          {
//
//              Mail::raw('你好，我是PHP程序！', function ($message) {
//                  $to = '874030059@qq.com';
//                  $message ->to($to);
//              });
//          }
          return $res;

      }

      public function del(Request $request)
      {
          $id=$request->id;
          //echo $id;die;

          //$db=DB::table('tgood')->where(['id'=>$id])->delete();

          $res=Curl::to('http://localhost:9200/shop/tgood/'.$id)
              ->withContentType('application/json')
              ->delete();
          return $res;
      }

      public function search(Request $request)
      {
          $value=$request->get('value');
          $page=$request->get('page');
          //return $value;die;
          $arr=[
              "query"=>[
                  "wildcard"=>[
                      'gname'=>"*$value*"
                  ]
              ],
                  "size"=>2,
                  "from"=>($page-1)*2,

          ];
          $res=Curl::to('http://localhost:9200/shop/tgood/_search')
              ->withData(json_encode($arr))
              ->withContentType('application/json')
              ->post();
          return $res;

      }
}
