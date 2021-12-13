<html>
    <body>
        <form action="{{url('save-sub-nested-category')}}" method="post">
            @csrf()
            <div>
                <label>Sub Category Name</label>
                <input type="text" name="sub_category_name"/>
            </div>
            <input type="hidden" name="category" value="{{$category}}"/>        
            <div>
                <label>Sub Category</label>
                <select name="sub_category" >
                @foreach($subcategory as $key => $sub)
                    <option value="{{$key}}">{{$sub}}</option>
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