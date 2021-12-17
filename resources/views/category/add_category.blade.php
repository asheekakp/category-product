<html>
    <body>
        <form action="{{url('add-category')}}" method="post">
            @csrf()
            <label>Parent Category</label>
            <select name="category" >
                <option value="">Select an Category to add as an subcategory</option>
            @foreach($categorys as $key => $sub)
                <option @isset($edit)  @if($edit->category_id == $key) {{ "selected" }} @endif @endisset value="{{$key}}">{{$sub}}</option>
            @endforeach
            </select>
            <label>Category Name</label>
            <input type="text" name="category_name" @if(isset($edit)) value="{{$edit->category_name}}"@endif/>
            @if(isset($edit))
            <input type="hidden" name="id" value="{{$edit->id}}"/>
            @endif
            
            <input type="submit" name="submit" value="Save"/>
        </form>
        <a href="{{url('home')}}">Home</a>
    </body>
</html>