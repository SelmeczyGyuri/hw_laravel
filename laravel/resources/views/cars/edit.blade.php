@extends('layout')

@section('content')

@if ($errors->any())
    <div class="alert alert-warning">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('cars.update', $car->id) }}" method="post">
    @csrf
    @method('PUT')
    <fieldset>
        <label for="name">Autó neve:</label>
        <input type="text" name="name" id="name" value="{{ old('name', $car->name) }}">
    </fieldset>
    <fieldset>
        <label for="toy_code">Azonosító</label>
        <input type="text" name="toy_code" id="toy_code" value="{{ old('toy_code', $car->toy_code) }}">
    </fieldset>
    <fieldset>
        <label for="color_id">Szín:</label>
        <select name="color_id" id="color_id">
            @foreach($colors as $color)
                <option value="{{ $color->id }}" {{ old('color_id', $car->color_id) == $color->id ? 'selected' : '' }}>
                    {{ $color->color }}
                </option>
            @endforeach
        </select>
    </fieldset>
    <fieldset>
        <label for="year_id">Gyártási év:</label>
        <select name="year_id" id="year_id">
            @foreach($years as $year)
                <option value="{{ $year->id }}" {{ old('year_id', $car->year_id) == $year->id ? 'selected' : '' }}>
                    {{ $year->year }}
                </option>
            @endforeach
        </select>
    </fieldset>
    <fieldset>
        <label for="series_id">Széria:</label>
        <select name="series_id" id="series_id">
            @foreach($series as $serie)
                <option value="{{ $serie->id }}" {{ old('series_id', $car->series_id) == $serie->id ? 'selected' : '' }}>
                    {{ $serie->series }}
                </option>
            @endforeach
        </select>
    </fieldset>
    <fieldset>
        <label for="designer_id">Tervező:</label>
        <select name="designer_id" id="designer_id">
            @foreach($designers as $designer)
                <option value="{{ $designer->id }}" {{ old('designer_id', $car->designer_id) == $designer->id ? 'selected' : '' }}>
                    {{ $designer->designer }}
                </option>
            @endforeach
        </select>
    </fieldset>

    <fieldset>
        <label for="notes">Jegyzet:</label>
        <textarea name="notes" id="notes">{{ old('notes', $car->notes) }}</textarea>
    </fieldset>
    <fieldset>
        <label for="isPacked">Csomagolt?:</label>
        <input type="checkbox" name="isPacked" id="isPacked" {{ old('isPacked', $car->isPacked) ? 'checked' : '' }}>
    </fieldset>
    <fieldset>
        <label for="extras">Extrák:</label>
        <select name="extras[]" id="extras" multiple>
            @foreach ($extras as $extra)
                <option value="{{ $extra->id }}" {{ old('extras', $car->extras->contains($extra->id)) ? 'selected' : '' }}>
                    {{ $extra->extra }}
                </option>
            @endforeach
        </select>
    </fieldset>
    <fieldset>
        <label for="img_url">Kép URL:</label>
        <input type="text" name="img_url" id="img_url" value="{{ old('img_url', $car->img_url) }}">
    </fieldset>
    <button type="submit">Mentés</button>
</form>

@endsection