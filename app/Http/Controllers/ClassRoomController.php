<?php

namespace App\Http\Controllers;

use App\Models\ClassRoom;
use Illuminate\Http\Request;

class ClassRoomController extends Controller
{
    public function index()
    {
        return view('classes.index', ['classes' => ClassRoom::all()]);
    }
    public function show($slug)
    {
        $classe = ClassRoom::with(['students', 'students.user'])->withCount('teachers')->where('slug', $slug)->firstOrFail();
        return view('classes.show', ['classe' => $classe]);
    }

    public function form(Request $request, $action)
    {
        $this->authorize('administration');

        $classe = $request->query('classe') ? ClassRoom::find($request->query('classe')) : new ClassRoom();
        return view('classes.form', compact('action', 'classe'));
    }

    public function store(Request $request)
    {
        $this->authorize('administration');

        $classe = ClassRoom::create($request->only(['name']));
        if($classe)
            return back()->with('toast', [
                'type' => 'success',
                'message' => "Classe $classe->name créée avec succès"
            ]);
            
        return back();
    }
    
    public function update(Request $request, ClassRoom $classe)
    {
        $this->authorize('administration');

        $updated = $classe->update($request->only(['name']));
        if($updated)
            return back()->with('toast', [
                'type' => 'success',
                'message' => "Classe modifiée avec succès"
            ]);
            
        return back();
    }
}
