@extends('layout')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">{{ $idea->title }}</h4>
                    <span class="badge">{{ $idea->status }}</span>
                </div>
            </div>
            <div class="card-body">
                <p style="white-space: pre-wrap;">{{ $idea->description }}</p>
                
                <div class="mt-4">
                    <small class="text-muted">
                        Créée le {{ $idea->created_at->format('d/m/Y à H:i') }}
                    </small>
                    @if($idea->updated_at != $idea->created_at)
                        <br>
                        <small class="text-muted">
                            Modifiée le {{ $idea->updated_at->format('d/m/Y à H:i') }}
                        </small>
                    @endif
                </div>
            </div>
            <div class="card-body border-top">
                <a href="{{ route('dashboard') }}" class="btn btn-secondary">Retour</a>
                @if($idea->status === 'Soumise')
                    <a href="{{ route('ideas.edit', $idea) }}" class="btn btn-warning">Modifier</a>
                    <form action="{{ route('ideas.destroy', $idea) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" 
                                onclick="return confirm('Êtes-vous sûr ?')">Supprimer</button>
                    </form>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

