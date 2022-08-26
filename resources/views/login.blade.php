@extends('partials.master')
@section('content')
<main id="login">
    <div>
        {{$failedLogin ?? ''}}
        {{$needAuthentication ?? ''}}
    </div>
    <div>
        <form action="{{route('login-post')}}" method="post">
            @csrf

            <label for="email">Email</label><br>
            <input type="email" name="email" placeholder="Email" class="input">
            <p>{{$errors->has('email') ? $errors->first('email') : ''}}</p>
            
            <label for="password">Password</label><br>
            <input type="password" name="password" placeholder="Password" class="input">
            <p>{{$errors->has('password') ? $errors->first('password') : ''}}</p>
    
            <input type="checkbox" name="rememberMe">Remember me
    
            <input type="submit" value="Enter">
        </form>
    </div>
    <a href="{{route('subscribe')}}">Subcribe</a>
</main>    
@endsection