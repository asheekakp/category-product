<html>
    <body>
        <div>
            <form action ="{{url('get-nested-category')}}" method="post">
            @csrf()
            <label>Category</label>
            <select name="category" >
            @foreach($categories as $category)
                <option value="{{$category->id}}">{{$category->category_name}}</option>
            @endforeach
            </select>
            <input type="submit" value="next">
            </form>
        </div>
        <a href="{{url('home')}}">Home</a>

</html>