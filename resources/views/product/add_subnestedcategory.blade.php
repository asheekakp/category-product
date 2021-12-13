<html>
    <body>
        <form action="{{url('save-product')}}" method="post">
            @csrf()
            <div>
                <label>Product Name</label>
                <input type="text" name="product"/>
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