@extends('partials.master')
@section('content')
<main id="user">
    <table border=1>
        <tr>
            <th>Info</th>
            <th>Data</th>
            <th>Action</th>
        </tr>
        <tr>
            <td>Name</td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>Email</td>
            <td></td>
            <td></td>
        </tr>
    </table>
    <a href="{{route('home')}}">Home</a>
</main>
@endsection