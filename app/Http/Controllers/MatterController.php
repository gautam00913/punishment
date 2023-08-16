<?php

namespace App\Http\Controllers;

use App\Models\Matter;
use Illuminate\Http\Request;

class MatterController extends Controller
{
    public function index()
    {
        return view('matters.index', ['matters' => Matter::all()]);
    }

    public function form(Request $request, $action)
    {
        $this->authorize('administration');

        $matter = $request->query('matter') ? Matter::find($request->query('matter')) : new Matter();
        return view('matters.form', compact('action', 'matter'));
    }

    public function store(Request $request)
    {
        $this->authorize('administration');

        $matter = Matter::create($request->only(['name', 'code']));
        if($matter)
            return back()->with('toast', [
                'type' => 'success',
                'message' => "Matière $matter->name créée avec succès"
            ]);
            
        return back();
    }
    
    public function update(Request $request, Matter $matter)
    {
        $this->authorize('administration');

        $updated = $matter->update($request->only(['name', 'code']));
        if($updated)
            return back()->with('toast', [
                'type' => 'success',
                'message' => "Matière modifiée avec succès"
            ]);
            
        return back();
    }
}
