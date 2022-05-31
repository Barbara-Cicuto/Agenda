@extends('partials.master')
@section('content')
    <main id="home">
        {{$msgCreatedContact ?? ''}}
        {{$msgDeleteContact ?? ''}}
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
        <a href="{{route('new-contact')}}">Novo usuário</a>
    </main>
@endsection