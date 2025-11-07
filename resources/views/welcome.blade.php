@extends('layout')

@section('content')
<div class="row justify-content-center" style="margin-top: 10vh;">
    <div class="col-md-8 text-center">
        <h1 class="display-3" style="font-weight: 300; letter-spacing: -1px;">La Boîte à Idées</h1>
        <p class="mt-4" style="font-size: 1.1rem; color: #666;">Proposez vos idées d'amélioration et contribuez au développement de notre entreprise.</p>
        
        @guest
            <p class="mt-4 alert alert-info" style="font-size: 1.1rem; color: #666;">Pour cela vous devez vous connecter a l'application ou vous inscrire !</p>
            
            <div class="mt-5">
                <a href="{{ route('login') }}" class="btn btn-primary btn-lg me-3">Connexion</a>
                <a href="{{ route('inscription') }}" class="btn btn-outline-primary btn-lg">S'inscrire</a>
            </div>
        @endguest

        @auth
            <p class="mt-4" style="font-size: 1.1rem; color: #666;">Vous êtes connecté !</p>
            <div class="mt-5">
                <a href="{{ route('dashboard') }}" class="btn btn-primary btn-lg">Accéder au tableau de bord</a>
            </div>
        @endauth
    </div>
</div>
@endsection
