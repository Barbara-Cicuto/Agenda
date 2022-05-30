@extends('partials.master')
@section('content')
<main id="new-edit-contact">
    <form action="" method="post">
        @csrf
        <input type="text" placeholder="Nome da pessoa">
        <input type="text" placeholder="Telefone">
        <input type="text" placeholder="Email">
        <input type="text" placeholder="Idade">
        <input type="text" placeholder="Instagram">
        <input type="text" placeholder="Linkedin">
        <input type="text" placeholder="Github">
        
        <input type="submit" value="Salvar">
    </form>
</main>    
@endsection