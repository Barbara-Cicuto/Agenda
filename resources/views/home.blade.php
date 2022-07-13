@extends('partials.master')
@section('content')
    <main id="home">
        {{$msgCreatedContact ?? ''}}
        {{$msgDeleteContact ?? ''}}
        {{$msgUserInfoUpdated ?? ''}}
        <table border="1">
            <tr>
                <th>Nome</th>
                <th>Ações</th>
            </tr>
            @foreach ($contacts as $contact)
                <tr>
                    <td>{{$contact->name}}</td>
                    <td><a href="{{route('show',['id' => $contact->id])}}">Ver</a> - <a href="{{route('edit-contact', ['id' => $contact->id])}}">Editar</a> - <a href="{{route('delete', ['id' => $contact->id])}}">Excluir</a></td>   
                </tr>
            @endforeach
        </table>
        <a href="{{route('new-contact')}}">New user</a>
        <a href="{{route('profile', ['id' => $user_id])}}">Profile</a>
    </main>
@endsection