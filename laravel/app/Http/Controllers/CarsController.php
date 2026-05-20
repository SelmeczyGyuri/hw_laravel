<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Color;
use App\Models\Car;
use App\Models\Designer;
use App\Models\Extra;
use App\Models\Series;
use App\Models\Year;

class CarsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sort_by = request()->query('sort_by', 'name');
        $sort_dir = request()->query('sort_dir', 'asc');
        $cars = Car::with('extras')->orderBy($sort_by, $sort_dir)->get();
        return view('cars.index', compact('cars'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $colors = Color::all();
        $designers = Designer::all();
        $extras = Extra::all();
        $series = Series::all();
        $years = Year::all();
        return view('cars.create', compact('colors', 'designers', 'extras', 'series', 'years'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $isPacked = $request->has('isPacked');
        if($isPacked) {
            $request->merge(['isPacked' => true]);
        }

        $request->validate([
            'name' => 'required|max:255|min:3',
            'toy_code' => 'required|max:10|min:4',
            'color_id' => 'required|exists:colors,id',
            'year_id' => 'required|exists:years,id',
            'designer_id' => 'required|exists:designers,id',
            'series_id' => 'required|exists:series,id',
            'isPacked' => 'boolean',
            'notes' => 'required|min:1|max:1000',
            'img_url' => 'url',
            'extras' => 'array'
        ]);

        $car = Car::create($request->except('extras'));
        $car->extras()->attach($request->extras);

        return redirect()->route('cars.index')->with('success', $car->name . ' sikeresen hozzáadva.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $car = Car::with('extras')->find($id);
        return view('cars.show', compact('car'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $car = Car::find($id);
        $colors = Color::all();
        $designers = Designer::all();
        $series = Series::all();
        $years = Year::all();
        $extras = Extra::all();
        return view('cars.edit', compact('car', 'colors', 'designers', 'series', 'years', 'extras'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $isPacked = $request->has('isPacked');
        if($isPacked) {
            $request->merge(['isPacked' => true]);
        }

        $request->validate([
            'name' => 'required|max:255|min:3',
            'toy_code' => 'required|max:10|min:4',
            'color_id' => 'required|exists:colors,id',
            'year_id' => 'required|exists:years,id',
            'designer_id' => 'required|exists:designers,id',
            'series_id' => 'required|exists:series,id',
            'notes' => 'required|min:1|max:1000',
            'isPacked' => 'boolean',
            'img_url' => 'url',
            'extras' => 'array'
        ]);
        $car = Car::find($id);
        $car->update($request->except('extras'));
        $car->extras()->sync($request->extras);
        return redirect()->route('cars.index')->with('success', $car->name . ' sikeresen módosítva.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $car = Car::find($id);
        $car->delete();
        return redirect()->route('cars.index')->with('success', $car->name . ' sikeresen törölve.');
    }
}
