<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Extra;

class ExtrasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sort_by = request()->query('sort_by', 'extra');
        $sort_dir = request()->query('sort_dir', 'asc');
        $extras = Extra::orderBy($sort_by, $sort_dir)->get();
        return view('extras.index', compact('extras'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('extras.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            ['extra' => 'required|min:3|max:255',],
        );

        $extra = new Extra();
        $extra->extra = $request->extra;
        $extra->save();

        return redirect()->route('extras.index')->with('success', $extra->extra . ' sikeresen létrehozva.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $extra = Extra::with('cars.extras')->findOrFail($id);
        $cars = $extra->cars;
        return view('extras.show', compact('extra', 'cars'));
        
        //$extra = Extra::find($id);
        //return view('extras.show', compact('extra'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $extra = Extra::find($id);
        return view('extras.edit', compact('extra'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate(
            ['extra' => 'required|min:1|max:255',],
            ['extra.min' => 'Az extra legalább 1 karakter hosszú kell legyen.',]
        );

        $extra = Extra::find($id);
        $extra->extra = $request->extra;
        $extra->save();

        return redirect()->route('extras.index')->with('success', 'Extra sikeresen frissítve!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $extra = Extra::find($id);
        $extra->delete();
        return redirect()->route('extras.index')->with('success', $extra->extra . ' sikeresen törölve!');
    }
}
