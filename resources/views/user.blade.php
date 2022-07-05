@extends('partials.master')
@section('content')
<main id="user">
    <form action="{{route('profile-post', ['id' => $id])}}">
        <input type=text name="username" value="{{$user->name}}"><br>
        <input type=email name="useremail" value="{{$user->email}}">
        <input type="submit" name="usersave" value="Save">
    </form>
    <a class="edit">edit</a>
    <a href="{{route('home')}}">Home</a>
</main>
@endsection