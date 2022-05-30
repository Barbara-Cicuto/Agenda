@extends('partials.master')
@section('content')
<main id="new-edit-contact">
    <form action="{{route('new-edit')}}" method="post">
        @csrf
        <input type="hidden" name="user_id" value="{{1}}">

        <input type="text" name="name" placeholder="Nome da pessoa" value="{{old('name')}}">
        <p style="color:red;">{{$errors->has('name') ? $errors->first('name') : ''}}</p>

        <input type="tel" name="phone" placeholder="Telefone" value="{{old('phone')}}">
        <p>{{$errors->has('phone') ? $errors->first('phone') : ''}}</p>

        <input type="email" name="email" placeholder="Email" value="{{old('email')}}">
        <p>{{$errors->has('email') ? $errors->first('email') : ''}}</p>

        <input type="number" name="age" placeholder="Idade" value="{{old('age')}}">
        <p>{{$errors->has('age') ? $errors->first('age') : ''}}</p>

        <input type="text" name="instagram" placeholder="Instagram" value="{{old('instagram')}}">
        <p>{{$errors->has('instagram') ? $errors->first('instagram') : ''}}</p>

        <input type="text" name="linkedin" placeholder="Linkedin" value="{{old('linkedin')}}">
        <p>{{$errors->has('linkedin') ? $errors->first('linkedin') : ''}}</p>

        <input type="text" name="github" placeholder="Github" value="{{old('github')}}">
        <p>{{$errors->has('github') ? $errors->first('github') : ''}}</p>
        
        <input type="submit" value="Salvar">
    </form>
</main>    
@endsection