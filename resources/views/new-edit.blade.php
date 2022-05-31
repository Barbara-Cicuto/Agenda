@extends('partials.master')
@section('content')
<main id="new-edit-contact">
    {{$msgCantUpdatedContact ?? ''}}
    {{$msgUpdatedContact ?? ''}}
    @if ($edit == true)
        <form action="{{route('edit-contact-post', ['id' => $contact->id])}}" method="post">
    @else 
        <form action="{{route('new-contact-post')}}" method="post">
    @endif
            @csrf
            <input type="hidden" name="user_id" value="{{1}}">
    
            <input type="text" name="name" placeholder="Nome da pessoa" value="{{$contact->name ?? ''}}">
            <p style ="color:red;">{{$errors->has('name') ? $errors->first('name') : ''}}</p>
    
            <input type="tel" name="phone" placeholder="Telefone" value="{{$contact->phone ?? ''}}">
            <p>{{$errors->has('phone') ? $errors->first('phone') : ''}}</p>
    
            <input type="email" name="email" placeholder="Email" value="{{$contact->email ?? ''}}">
            <p>{{$errors->has('email') ? $errors->first('email') : ''}}</p>
    
            <input type="number" name="age" placeholder="Idade" value="{{$contact->age ?? ''}}">
            <p>{{$errors->has('age') ? $errors->first('age') : ''}}</p>
    
            <input type="text" name="instagram" placeholder="Instagram" value="{{$contact->instagram ?? ''}}">
            <p>{{$errors->has('instagram') ? $errors->first('instagram') : ''}}</p>
    
            <input type="text" name="linkedin" placeholder="Linkedin" value="{{$contact->linkedin ?? ''}}">
            <p>{{$errors->has('linkedin') ? $errors->first('linkedin') : ''}}</p>
    
            <input type="text" name="github" placeholder="Github" value="{{$contact->github ?? ''}}">
            <p>{{$errors->has('github') ? $errors->first('github') : ''}}</p>
            
            <input type="submit" value="Salvar">
        </form>
</main>    
@endsection