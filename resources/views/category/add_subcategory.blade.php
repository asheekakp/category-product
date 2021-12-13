<html>
    <body>
        <form action="{{url('add-sub-category')}}" method="post">
            @csrf()
            <div>
                <label>Sub Category Name</label>
                <input type="text" name="sub_category_name"/>
            </div>
            <div>
                <label>Category</label>
                <select name="category" >
                @foreach($categories as $category)
                    <option value="{{$category->id}}">{{$category->category_name}}</option>
                @endforeach
                </select>
            </div>
            <div>
            </div>
            <input type="submit" name="submit" value="Save"/>
        </form>
        <a href="{{url('home')}}">Home</a>
    </body>
</html>