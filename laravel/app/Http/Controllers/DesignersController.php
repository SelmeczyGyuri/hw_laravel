<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Designer;

class DesignersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sort_by = request()->query('sort_by', 'designer');
        $sort_dir = request()->query('sort_dir', 'asc');
        $designers = Designer::orderBy($sort_by, $sort_dir)->get();
        return view('designers.index', compact('designers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('designers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            ['designer' => 'required|min:1|max:255',],
            ['designer.min' => 'A tervező neve legalább 1 karakter hosszú kell legyen.',]
        );

        $designer = new Designer();
        $designer->designer = $request->designer;
        $designer->save();

        return redirect()->route('designers.index')->with('success', $designer->designer . ' sikeresen létrehozva.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $designer = Designer::with('cars.extras')->findOrFail($id);
        $cars = $designer->cars;
        return view('designers.show', compact('designer', 'cars'));
        
        //$designer = Designer::find($id);
        //return view('designers.show', compact('designer'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $designer = Designer::find($id);
        return view('designers.edit', compact('designer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate(
            ['designer' => 'required|min:1|max:255',],
            ['designer.min' => 'A tervező neve legalább 1 karakter hosszú kell legyen.',]
        );

        $designer = Designer::find($id);
        $designer->designer = $request->designer;
        $designer->save();

        return redirect()->route('designers.index')->with('success', 'Tervező sikeresen frissítve!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $designer = Designer::find($id);
        $designer->delete();
        return redirect()->route('designers.index')->with('success', $designer->designer . ' sikeresen törölve!');
    }
}
