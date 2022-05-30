@extends('partials.master')
@section('content')
    <main id="home">
        <table border="1">
            <tr>
                <th>Nome</th>
                <th>Ações</th>
            </tr>
            <tr>
                <td>Nome da pessoa</td>
                <td><a href="{{route('show')}}">Ver</a> - <a href="{{route('new-edit')}}">Editar</a> - <a href="#">Excluir</a></td>
            </tr>
        </table>
    </main>
@endsection