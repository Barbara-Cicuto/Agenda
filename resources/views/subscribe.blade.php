@extends('partials.master')
@section('content')
<main id="subscribe">
    <form action="{{route('subscribe-post')}}" method="post">
        @csrf
        <input type="name" name="name" placeholder="Name">
        <p>{{$errors->has('name') ? $errors->first('name') : ''}}</p>

        <input type="email" name="email" placeholder="Email">
        <p>{{$errors->has('email') ? $errors->first('email') : ''}}</p>

        <input type="password" name="password" placeholder="Password">Please enter a 8 characters long password with at least one special character and one number
        <p>{{$errors->has('password') ? $errors->first('password') : ''}}</p>

        <input type="password" name="password_confirmation" placeholder="Confirm password">
        <p>{{$errors->has('password_confirmation') ? $errors->first('password_confirmation') : ''}}</p>

        <input type="submit" value="Subscribe">
    </form>
</main>    
@endsection