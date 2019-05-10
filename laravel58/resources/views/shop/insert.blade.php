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
<form action="{{route('shop.doadd')}}" method="get">
    <table>
        <tr>
            <td>商品名称:<input type="text" name="gname"></td>
        </tr>
        <tr>
            <td>商品标价:<input type="text" name="gprice"></td>
        </tr>
        <tr>
            <td>商品数量:<input type="text" name="gcount"></td>
        </tr>
        <tr>
            <td><input type="submit" value="添加"></td>
        </tr>
    </table>
</form>
</body>
</html>
