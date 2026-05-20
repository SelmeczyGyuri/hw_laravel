<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Series;

class SeriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sort_by = request()->query('sort_by', 'series');
        $sort_dir = request()->query('sort_dir', 'asc');
        $series = Series::orderBy($sort_by, $sort_dir)->get();
        return view('series.index', compact('series'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('series.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            ['series' => 'required|min:1|max:255',],
            ['series.min' => 'A széria legalább 1 karakter hosszú kell legyen.',]
        );

        $series = new Series();
        $series->series = $request->series;
        $series->save();

        return redirect()->route('series.index')->with('success', $series->series . ' sikeresen létrehozva.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $series = Series::with('cars.extras')->findOrFail($id);
        $cars = $series->cars;
        return view('series.show', compact('series', 'cars'));
        //$series = Series::find($id);
        //return view('series.show', compact('series'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $series = Series::find($id);
        return view('series.edit', compact('series'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate(
            ['series' => 'required|min:1|max:255',],
            ['series.min' => 'A széria legalább 1 karakter hosszú kell legyen.',]
            );

        $series = Series::find($id);
        $series->series = $request->series;
        $series->save();

        return redirect()->route('series.index')->with('success', 'Széria sikeresen frissítve!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $series = Series::find($id);
        $series->delete();

        return redirect()->route('series.index')->with('success', $series->series . ' sikeresen törölve!');
    }
}
