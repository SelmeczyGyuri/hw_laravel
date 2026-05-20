<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Color;

class ColorsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sort_by = request()->query('sort_by', 'color');
        $sort_dir = request()->query('sort_dir', 'asc');
        $colors = Color::orderBy($sort_by, $sort_dir)->get();
        return view('colors.index', compact('colors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('colors.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            ['color' => 'required|min:1|max:255',],
            ['color.min' => 'A szín neve legalább 1 karakter hosszú kell legyen.',]
        );

        $color = new Color();
        $color->color = $request->color;
        $color->save();

        return redirect()->route('colors.index')->with('success', $color->color . ' sikeresen létrehozva.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $color = Color::with('cars.extras')->findOrFail($id);
        $cars = $color->cars;
        return view('colors.show', compact('color', 'cars'));
        //$color = Color::find($id);
        //return view('colors.show', compact('color'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $color = Color::find($id);
        return view('colors.edit', compact('color'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate(
            ['color' => 'required|min:1|max:255',],
            ['color.min' => 'A szín legalább 1 karakter hosszú kell legyen.',]
            );

        $color = Color::find($id);
        $color->color = $request->color;
        $color->save();

        return redirect()->route('colors.index')->with('success', 'Szín sikeresen frissítve!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $color = Color::find($id);
        $color->delete();

        return redirect()->route('colors.index')->with('success', $color->color . ' sikeresen törölve!');
    }
}
