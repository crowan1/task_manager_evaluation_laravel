@extends('layout')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 style="font-weight: 300; letter-spacing: -0.5px;">Mes Idées</h2>
            <a href="{{ route('ideas.create') }}" class="btn btn-primary">Proposer une idée</a>
        </div>

        <form method="GET" action="{{ route('dashboard') }}" class="mb-4">
            <div class="input-group">
                <input type="text" class="form-control" name="search" 
                       placeholder="Rechercher une idée..." 
                       value="{{ request('search') }}">
                <button class="btn btn-outline-secondary" type="submit">Rechercher</button>
                @if(request('search'))
                    <a href="{{ route('dashboard') }}" class="btn btn-outline-danger">Effacer</a>
                @endif
            </div>
        </form>

        @if($ideas->count() > 0)
            <div class="row">
                @foreach($ideas as $idea)
                    <div class="col-md-6 mb-3">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title" style="font-weight: 400;">{{ $idea->title }}</h5>
                                <p class="card-text" style="color: #666;">{{ Str::limit($idea->description, 100) }}</p>
                                <p class="mb-3">
                                    <span class="badge">{{ $idea->status }}</span>
                                    <small class="text-muted ms-2">{{ $idea->created_at->format('d/m/Y') }}</small>
                                </p>
                                @if($idea->status === 'Soumise')
                                    <a href="{{ route('ideas.edit', $idea) }}" class="btn btn-sm btn-warning">Modifier</a>
                                    <form action="{{ route('ideas.destroy', $idea) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" 
                                                onclick="return confirm('Êtes-vous sûr ?')">Supprimer</button>
                                    </form>
                                @else
                                    <span style="color: #999; font-size: 0.9rem;">Modification non autorisée</span>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="alert alert-info">
                Aucune idée trouvée. Commencez par proposer votre première idée !
            </div>
        @endif
    </div>
</div>
@endsection

