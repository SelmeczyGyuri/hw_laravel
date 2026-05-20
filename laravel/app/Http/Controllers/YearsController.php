<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Year;

class YearsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sort_by = request()->query('sort_by', 'year');
        $sort_dir = request()->query('sort_dir', 'asc');
        $years = Year::orderBy($sort_by, $sort_dir)->get();
        return view('years.index', compact('years'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('years.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            ['year' => 'required',],
            ['year.min' => 'A gyártási év legalább 1968 kell legyen.',]
        );

        $year = new Year();
        $year->year = $request->year;
        $year->save();

        return redirect()->route('years.index')->with('success', $year->year . ' sikeresen létrehozva.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $year = Year::with('cars.extras')->findOrFail($id);
        $cars = $year->cars;
        return view('years.show', compact('year', 'cars'));
        //$year = Year::find($id);
        //return view('years.show', compact('year'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $year = Year::find($id);
        return view('years.edit', compact('year'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate(
            ['year' => 'required|min:1968|max:9999',],
            ['year.min' => 'A gyártási év legalább 1968 kell legyen.',]
            );

        $year = Year::find($id);
        $year->year = $request->year;
        $year->save();

        return redirect()->route('years.index')->with('success', 'Gyártási év sikeresen frissítve!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $year = Year::find($id);
        $year->delete();

        return redirect()->route('years.index')->with('success', $year->year . ' sikeresen törölve!');
    }
}
