<html>
    <body>
        <table border=1>
            <tbody>
                <tr>
                    <td>Sl no</td>
                    <td>Product</td>
                    <td>Sub</td>
                    <td>URL</td>
                </tr><?php $i=0;?>
                @foreach($product as $p)
                <tr>
                    <td>{{++$i}}</td>
                    <td>{{$p->product_name}}</td>
                    <td>{{$p->sub_category}}</td>
                    <td>{{$p->url}}</td>
                <tr>
                @endforeach
            </tbody>
        </table>
        <a href="{{url('home')}}">Home</a>
    </body>
</html>