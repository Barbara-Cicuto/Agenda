@extends('partials.master')
@section('content')
<main id="user">
    {{$msgUserEmailExists ?? ''}}
    <form action="{{route('profile-post', ['id' => $id])}}" method="post">
        @csrf

        <input type=text name="name" value="{{$user->name}}"><br>
        <p>{{$errors->has('name') ? $errors->first('name') : ''}}</p>

        <input type=email name="email" value="{{$user->email}}">
        <p>{{$errors->has('email') ? $errors->first('email') : ''}}</p>

        <input type="submit" value="Save">
    </form>
    <a class="edit">edit</a>
    <a href="{{route('home')}}">Home</a>
</main>
@endsection