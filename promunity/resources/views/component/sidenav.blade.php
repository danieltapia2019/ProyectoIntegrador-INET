<div class="sideNavigation" id="sideNAV">
    <a href="#">
        @if (isset(auth()->user()->foto))
        <img src="{{ asset('/storage/img/avatar/'.auth()->user()->foto) }}" alt="{{auth()->user()->username}}"
            id="sideNAV">
        @else
        <img src="/img/perfil.jpg" alt="" class="" id="imgSideNav">
        @endif
    </a>
    <a>Administrador:</a>
    <a href="/perfil">{{auth()->user()->username}}</a>
    <a href="/home"> <img src="/img/logo.png" alt="" id="logoHOME"> </a>
    <hr>
    <a href="/admin/abm">ABM General</a>
    {{-- <a href="/setting"><i class="fas fa-cogs"></i>Settings</a> --}}
</div>
