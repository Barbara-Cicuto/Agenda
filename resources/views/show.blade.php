@extends('partials.master')
@section('content')
<main id="show-contact">
    <div>
        <h1>{{$contact->name}}</h1>
        <div>
            <p>Telefone: {{$contact->phone}}</p>
            <p>Email: {{$contact->email}}</p>
            <p>Idade: {{$contact->age}}</p>
            <p>Instagram: {{$contact->instagram}}</p>
            <p>Linkedin: {{$contact->linkedin}}</p>
            <p>Github: {{$contact->github}}</p>
        </div>
    </div>
</main>    
@endsection