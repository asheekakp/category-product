<html>
    <body>
        <form action="{{url('save-product')}}" method="post">
            @csrf()
            <div>
                <label>Parent Category</label>
                <select name="category" >
                    <option value="">Select an Category to add as an subcategory</option>
                @foreach($categorys as $key => $sub)
                    <option @isset($edit) @if($edit->category_id == $key) {{ "selected" }} @endif @endisset value="{{$key}}">{{$sub}}</option>
                @endforeach
                </select>
            </div>
            <div>
                <label>Product Name</label>
                <input type="text" name="product"/>
            </div>
            <div>
                <input type="submit" name="submit" value="Save"/>
            </div>
        </form>
        <a href="{{url('home')}}">Home</a>
    </body>
</html>