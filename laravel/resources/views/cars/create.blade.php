@extends('layout')

@section('content')

<h1>Új autó</h1>

@if ($errors->any())
    <div class="alert alert-warning">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('cars.store') }}" method="post">
    @csrf
    <fieldset>
        <label for="name">Autó neve</label>
        <input type="text" name="name" id="name">
    </fieldset>
    <fieldset>
        <label for="toy_code">Azonosító</label>
        <input type="text" name="toy_code" id="toy_code">
    </fieldset>
    <fieldset>
        <label for="color_id">Szín</label>
        <select name="color_id" id="color_id">
            <option value="">Válassz színt</option>
            @foreach($colors as $color)
                <option value="{{ $color->id }}">{{ $color->color }}</option>
            @endforeach
        </select>
    </fieldset>
    <fieldset>
        <label for="year_id">Gyártási év</label>
        <select name="year_id" id="year_id">
            <option value="">Válassz évet</option>
            @foreach($years as $year)
                <option value="{{ $year->id }}">{{ $year->year }}</option>
            @endforeach
        </select>
    </fieldset>
    <fieldset>
        <label for="series_id">Széria</label>
        <select name="series_id" id="series_id">
            <option value="">Válassz szériát</option>
            @foreach($series as $serie)
                <option value="{{ $serie->id }}">{{ $serie->series }}</option>
            @endforeach
        </select>
    </fieldset>
    <fieldset>
        <label for="designer_id">Tervező</label>
        <select name="designer_id" id="designer_id">
            <option value="">Válassz tervezőt</option>
            @foreach($designers as $designer)
                <option value="{{ $designer->id }}">{{ $designer->designer }}</option>
            @endforeach
        </select>
    </fieldset>
    
    <fieldset>
        <label for="notes">Jegyzet</label>
        <textarea name="notes" id="notes"></textarea>
    </fieldset>
    <fieldset>
        <label for="isPacked">Csomagolt?</label>
        <input type="checkbox" name="isPacked" id="isPacked">
    </fieldset>
    <fieldset>
        <label for="extras">Extrák</label>
        <select name="extras[]" id="extras" multiple>
            @foreach ($extras as $extra)
                <option value="{{ $extra->id }}">{{ $extra->extra }}</option>
            @endforeach
        </select>
    </fieldset>
    <fieldset>
        <label for="img_url">Kép URL</label>
        <input type="text" name="img_url" id="img_url">
    </fieldset>

    <button type="submit">Mentés</button>
</form>

@endsection