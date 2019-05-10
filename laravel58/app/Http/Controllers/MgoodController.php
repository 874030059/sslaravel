<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Ixudra\Curl\Facades\Curl;

class MgoodController extends Controller
{
    public function search()//后台数据库查询
    {
        $db=DB::table('mgood')->get();
        //var_dump($db);
        return view('mgood/show',['data'=>$db]);

    }
   public function add()//跳转至添加
   {
       return view('mgood/insert');
   }
   public function see()
   {
       $res=Curl::to('http://localhost:9200/_search')

           ->withContentType('application/json')
           ->get();
       return $res;
   }
   public function doadd(Request $request){//后台添加
        $data=$request->toArray();
        //var_dump($data);die;
        $db=DB::table('mgood')->insertGetId(['name'=>$data['name'],'price'=>$data['price'],'desc'=>$data['desc']]);

        if ($db)
        {
            $res=Curl::to('http://localhost:9200/mgood/test/'.$db)
                ->withData(json_encode($data,true))
                ->withContentType('application/json')
                ->post();
            //return $res;
            if ($res)
            {
                return redirect('admin/product/search');
            }
        }

   }


   public function del(Request $request)//后台删除
   {
       $id=$request->get('id');
       //echo $id;die;
       $db=DB::table('mgood')->where(['id'=>$id])->delete();

       if ($db)
       {
           $res=Curl::to('http://localhost:9200/mgood/test/'.$id)

               ->withContentType('application/json')
               ->delete();
           if ($res)
           {
               return redirect('admin/product/search');
           }
       }
   }
   public function es(Request $request)//es搜索
   {
       $value=$request->get('value');
       $page=$request->get('page');
       //var_dump($value);die;
       $arr=[
            "query"=>[
                "wildcard"=>[
                    "name"=>"*$value*"
                ]
            ],
//           "highlight"=>[
//               "fields"=>[
//                   "fragment_size"=>150,
//               "color"=>"</red>"
//               ]
//           ]
//           "size"=>2,
//           "from"=>($page-1)*2,
       ];
       $res=Curl::to('http://localhost:9200/mgood/test/_search')
           ->withData(json_encode($arr,true))
           ->withContentType('application/json')
           ->post();
       return $res;
   }

   public function up(Request $request)
   {
       $id=$request->get('id');
       //$db=DB::table('mgood')->where(['id'=>$id])->get()->toArray();
       //var_dump($db);die;
       return view('mgood/doup',['id',$id]);
   }

    public function update(Request $request)//后台修改
    {
        $data=$request->toArray();
        $id=$request->get('id');
        $name=$request->get('name');
        $price=$request->get('price');
        $desc=$request->get('desc');
        //echo $id;die;
        $db=DB::table('mgood')->where(['id'=>$id])->update(['name'=>$name,'price'=>$price,'desc'=>$desc]);


        if ($db)
        {
            $res=Curl::to('http://localhost:9200/mgood/test/')
                ->withData(json_encode($data,true))
                ->withContentType('application/json')
                ->put();
            return $res;
//            if ($res)
//            {
//                return redirect('admin/product/search');
//            }
        }
    }
}
