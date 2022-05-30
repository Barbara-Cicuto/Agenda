@extends('partials.master')
@section('content')
    <main id="home">
        {{$msgCreatedContact ?? ''}}
        <table border="1">
            <tr>
                <th>Nome</th>
                <th>Ações</th>
            </tr>
            @foreach ($contacts as $contact)
                <tr>
                    <td>{{$contact->name}}</td>
                    <td><a href="{{route('show',['id' => $contact->id])}}">Ver</a> - <a href="{{route('new-edit')}}">Editar</a> - <a href="#">Excluir</a></td>   
                </tr>
            @endforeach
        </table>
        <a href="{{route('new-edit')}}">Novo usuário</a>
    </main>
@endsection