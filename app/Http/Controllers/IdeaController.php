<?php

namespace App\Http\Controllers;

use App\Models\Idea;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IdeaController extends Controller
{
    use AuthorizesRequests;
    public function index(Request $request)
    {
        $query = Auth::user()->ideas();

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', '%' . $search . '%')
                  ->orWhere('description', 'like', '%' . $search . '%');
            });
        }

        $ideas = $query->orderBy('created_at', 'desc')->get();

        return view('dashboard', compact('ideas'));
    }

    public function create()
    {
        return view('ideas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string'
        ]);

        Auth::user()->ideas()->create([
            'title' => $request->title,
            'description' => $request->description
        ]);

        return redirect()->route('dashboard')->with('success', 'Idée créée avec succès!');
    }

    public function edit(Idea $idea)
    {
        $this->authorize('update', $idea);
        return view('ideas.edit', compact('idea'));
    }

    public function update(Request $request, Idea $idea)
    {
        $this->authorize('update', $idea);

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string'
        ]);

        $idea->update([
            'title' => $request->title,
            'description' => $request->description
        ]);

        return redirect()->route('dashboard')->with('success', 'Idée mise à jour avec succès!');
    }

    public function destroy(Idea $idea)
    {
        $this->authorize('delete', $idea);
        $idea->delete();

        return redirect()->route('dashboard')->with('success', 'Idée supprimée avec succès!');
    }
}
