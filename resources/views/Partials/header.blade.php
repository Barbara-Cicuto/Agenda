<header id="header">
    <div>
        <figure>
            <img src="" title="Logo" alt="agenda's logo">
        </figure>
    </div>
    <nav>
        <a href="{{route('profile', ['id' => $user_id])}}">Profile</a>
        <a href="{{route('logout')}}">Logout</a>
    </nav>
</header>