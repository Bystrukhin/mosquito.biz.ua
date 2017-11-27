@extends('adminlte::page')
@section('title', 'Mosquito Admin')
@section('content')

    <form method="post" action="{{route('admin.postSetBackgroundColor')}}">
        <h3>You can change background color of your site</h3>
        <br>
        <br>
        <div class="btn-group">
            <a href="#" class="btn btn-primary">Select color</a>
            <a href="#" class="btn btn-primary dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></a>
            <ul class="dropdown-menu" style="padding: 10px" id="myDiv">
                <li><p><input checked="checked" type="radio" value=" " style="margin-right: 10px;" name="bg_color"> White color</p></li>
                <li><p><input checked="checked" type="radio" value="-blue" style="margin-right: 10px;" name="bg_color"> Blue color</p></li>
                <li><p><input checked="checked" type="radio" value="-grey" style="margin-right: 10px;" name="bg_color"> Grey color</p></li>
            </ul>
        </div>
        <button type="submit" class="btn btn-primary" onclick="change_color()">Apply changes</button>
        {{ csrf_field() }}
    </form>

    <script>
        function change_color () {
            var url = '{{ asset('color') }}';
            var color = $('.bg_color').val();
            $.ajax({
                type: 'get',
                data: {id: id},
                url: url,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
                },
                success: function(response) {
                    console.log('success: '+response);
                },
                error: function(response) {
                    var errors = response.responseJSON;
                    console.log(errors);
                }
            });
        }
    </script>

@endsection