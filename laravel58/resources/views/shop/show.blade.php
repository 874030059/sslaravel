<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
   <h5>展示页</h5>
   <h1><a href="http://localhost/laravel58/public/shop/add">添加商品</a></h1>
   <table>
       <th>商品名称</th>
       <th>商品定价</th>
       <th>商品数量</th>
       <th>操作</th>
       @foreach ($data as $user)
           <tr>
               <td>{{ $user->gname }}</td>
               <td>{{ $user->gprice }}</td>
               <td>{{ $user->gcount }}</td>
               <td><b><a href="http://localhost/laravel58/public/shop/buy/{{$user->id}}">下订单</a></b></td>
           </tr>

       @endforeach

   </table>
</body>
</html>