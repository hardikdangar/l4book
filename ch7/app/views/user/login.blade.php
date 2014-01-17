@extends("layouts.user")

@section('content')
<div class="span6 price_content">
{{ Form::open( array('url'=>'login')) }}
    <div class="container">
        <fieldset class="boxBody">
            <label>Email</label>
            <input type="text" name="email" tabindex="1" value="{{ Input::old('username')}}" placeholder="">
            <label>Password</label>
            <input type="password" name="password" tabindex="2" placeholder="">
        </fieldset>

        <input type="submit" class="btn btn-large btn-inverse" value="Login" tabindex="3">
    </div>
 {{ Form::close() }}
</div>
@stop