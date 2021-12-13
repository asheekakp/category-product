<html>
    <body>
        <table border=1>
            <tbody>
            <tr>
                <td>Sl no</td>
                <td>Category</td>
                <td>URL</td>
                <td>Edit</td>
            </tr><?php $i=0;?>
            @foreach($categories as $p)
            <tr>
                <td>{{++$i}}</td>
                <td>{{$p->category_name}}</td>
                <td>{{$p->url}}</td>
                <td><a href="{{url('add-category').'/'.$p->id}}">Edit</a></td>
            <tr>
            @endforeach
            </tbody>
        </table>
        <a href="{{url('home')}}">Home</a>
    </body>

</html>