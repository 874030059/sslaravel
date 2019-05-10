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
    <form action="{{route('admin.product.doadd')}}" method="get">
    <table>
         <tr>
             <td>商品名称:<input type="text" name="name"></td>
         </tr>
        <tr>
            <td>商品价格:<input type="text" name="price"></td>
        </tr>
        <tr>
            <td>商品描述:<input type="text" name="desc"></td>
        </tr>
        <tr>
            <td><input type="submit" value="添加"></td>
        </tr>
    </table>
    </form>
</center>
</body>
</html>