@extends('partials.master')
@section('content')
<main id="login">
    {{$failedLogin ?? ''}}
    {{$needAuthentication ?? ''}}
    <form action="{{route('login-post')}}" method="post">
        @csrf
        <input type="email" name="email" placeholder="Email">
        <p>{{$errors->has('email') ? $errors->first('email') : ''}}</p>

        <input type="password" name="password" placeholder="Password">
        <p>{{$errors->has('password') ? $errors->first('password') : ''}}</p>

        <input type="checkbox" name="rememberMe">Remember me

        <input type="submit" value="Enter">
    </form>
</main>    
@endsection