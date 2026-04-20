<?php

namespace App\Http\Controllers;

use App\Http\Requests\storeIdeaRequest;
use App\Http\Requests\updateIdeaRequest;
use App\Models\ideas;
use Auth;
use Illuminate\Http\Request;

class ideaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();
        $ideas = $user->ideas()->get();

        return view('ideas.index', [
            'ideas' => [],
        ]);
    }

    public function create()
    {
        return view('ideas.create');
    }


    public function store(storeIdeaRequest $request)
    {
        ideas::create([
            'description' => $request->description,
            'state' => 'pending',
            'user_id' => auth()->id(),
        ]);

        return redirect('ideas');
    }


    public function show(ideas $idea)
    {
        return view('ideas.show', [
            'idea' => $idea,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ideas $idea)
    {
        return view('ideas.edit', [
            'idea' => $idea,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(updateIdeaRequest $request, ideas $idea)
    {
        $idea->update([
            'description' => $request->description,
        ]);
        return redirect('ideas');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ideas $idea)
    {
        $idea->delete();
        return redirect('ideas');
    }
}
