<html>
    <body>
        <form action="{{url('add-category')}}" method="post">
            @csrf()
            <label>Catgory Name</label>
            <input type="text" name="category_name" @if(isset($edit)) value="{{$edit->category_name}}"@endif/>
            @if(isset($edit))
            <input type="hidden" name="id" value="{{$edit->id}}"/>
            @endif
            <input type="submit" name="submit" value="Save"/>
        </form>
        <a href="{{url('home')}}">Home</a>
    </body>
</html>