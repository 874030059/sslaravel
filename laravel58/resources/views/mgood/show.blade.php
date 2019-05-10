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
<center>
    <table>
        <th>
            商品名称
        </th>
        <th>
            商品定价
        </th>
        <th>
            商品描述
        </th>
         <h5><a href="http://localhost/laravel58/public/admin/product/add">商品添加</a></h5>
        @foreach ($data as $user)

        <tr>
            <td>{{ $user->name }}</td>
            <td>{{ $user->price }}</td>
            <td>{{ $user->desc }}</td>
            <td><a href="http://localhost/laravel58/public/admin/product/del?id={{$user->id}}">删除</a></td>
            <td><a href="http://localhost/laravel58/public/admin/product/up?id={{$user->id}}">修改</a></td>
        </tr>
        @endforeach

    </table>
</center>
</body>
</html>