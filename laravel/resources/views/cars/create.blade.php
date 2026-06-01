@extends('layout')

@section('content')

<div class="form-back-link">
    <a href="{{ route('cars.index') }}" class="btn btn-secondary">← Vissza a listához</a>
</div>

<h1>
    <span class="title-bar" aria-hidden="true"></span>
    Új autó regisztrálása
</h1>

@if ($errors->any())
    <div class="alert alert-warning">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('cars.store') }}" method="post" class="race-form">
    @csrf
 
    {{-- SECTION: Alapadatok --}}
    <div class="form-section">
        <div class="form-section-header">
            <span class="form-section-number">01</span>
            <span class="form-section-title">Alapadatok</span>
        </div>
        <div class="form-grid">
            <div class="form-field">
                <label for="name">Autó neve</label>
                <input type="text" name="name" id="name"
                       value="{{ old('name') }}"
                       placeholder="pl. Twin Mill"
                       autocomplete="off">
            </div>
            <div class="form-field">
                <label for="toy_code">Azonosító</label>
                <input type="text" name="toy_code" id="toy_code"
                       value="{{ old('toy_code') }}"
                       placeholder="pl. HW-2024-042"
                       autocomplete="off">
            </div>
        </div>
    </div>
 
    {{-- SECTION: Részletek --}}
    <div class="form-section">
        <div class="form-section-header">
            <span class="form-section-number">02</span>
            <span class="form-section-title">Részletek</span>
        </div>
        <div class="form-grid">
            <div class="form-field">
                <label for="color_id">Szín</label>
                <select name="color_id" id="color_id">
                    <option value="">— Válassz színt —</option>
                    @foreach($colors as $color)
                        <option value="{{ $color->id }}" {{ old('color_id') == $color->id ? 'selected' : '' }}>
                            {{ $color->color }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-field">
                <label for="year_id">Gyártási év</label>
                <select name="year_id" id="year_id">
                    <option value="">— Válassz évet —</option>
                    @foreach($years as $year)
                        <option value="{{ $year->id }}" {{ old('year_id') == $year->id ? 'selected' : '' }}>
                            {{ $year->year }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-field">
                <label for="series_id">Széria</label>
                <select name="series_id" id="series_id">
                    <option value="">— Válassz szériát —</option>
                    @foreach($series as $serie)
                        <option value="{{ $serie->id }}" {{ old('series_id') == $serie->id ? 'selected' : '' }}>
                            {{ $serie->series }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-field">
                <label for="designer_id">Tervező</label>
                <select name="designer_id" id="designer_id">
                    <option value="">— Válassz tervezőt —</option>
                    @foreach($designers as $designer)
                        <option value="{{ $designer->id }}" {{ old('designer_id') == $designer->id ? 'selected' : '' }}>
                            {{ $designer->designer }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
 
    {{-- SECTION: Extrák --}}
    <div class="form-section">
        <div class="form-section-header">
            <span class="form-section-number">03</span>
            <span class="form-section-title">Extrák</span>
            <span class="form-section-hint">Kattints a kiválasztáshoz, többet is választhatsz</span>
        </div>
        <div class="extras-chips" id="extrasChips">
            @foreach ($extras as $extra)
                @php $oldExtras = old('extras', []); @endphp
                <label class="chip {{ in_array($extra->id, $oldExtras) ? 'chip--active' : '' }}">
                    <input type="checkbox"
                           name="extras[]"
                           value="{{ $extra->id }}"
                           {{ in_array($extra->id, $oldExtras) ? 'checked' : '' }}>
                    {{ $extra->extra }}
                </label>
            @endforeach
        </div>
    </div>
 
    {{-- SECTION: Megjegyzés & státusz --}}
    <div class="form-section">
        <div class="form-section-header">
            <span class="form-section-number">04</span>
            <span class="form-section-title">Megjegyzés & Státusz</span>
        </div>
        <div class="form-grid form-grid--single">
            <div class="form-field">
                <label for="notes">Megjegyzés</label>
                <textarea name="notes" id="notes"
                          placeholder="Pl. apától kapott ajándék, különleges kiadás…">{{ old('notes') }}</textarea>
            </div>
        </div>
        <div class="form-toggle-row">
            <label class="toggle-label" for="isPacked">
                <span class="toggle-text">Csomagolt (bontatlan)?</span>
                <span class="toggle-wrap">
                    <input type="checkbox" name="isPacked" id="isPacked"
                           class="toggle-input" {{ old('isPacked') ? 'checked' : '' }}>
                    <span class="toggle-track">
                        <span class="toggle-thumb"></span>
                    </span>
                </span>
            </label>
        </div>
    </div>
 
    {{-- SECTION: Kép --}}
    <div class="form-section">
        <div class="form-section-header">
            <span class="form-section-number">05</span>
            <span class="form-section-title">Kép</span>
        </div>
        <div class="form-img-row">
            <div class="form-field form-field--grow">
                <label for="img_url">Kép URL</label>
                <input type="text" name="img_url" id="img_url"
                       value="{{ old('img_url') }}"
                       placeholder="https://…"
                       autocomplete="off">
            </div>
            <div class="img-preview-wrap">
                <div class="img-preview" id="imgPreview">
                    <span class="img-preview-placeholder">🚗</span>
                </div>
            </div>
        </div>
    </div>
 
    {{-- Submit --}}
    <div class="form-submit-row">
        <a href="{{ route('cars.index') }}" class="btn btn-secondary">Mégsem</a>
        <button type="submit" class="btn btn-primary form-submit-btn">
            ✓ Autó mentése
        </button>
    </div>
 
</form>

<!--<form action="{{ route('cars.store') }}" method="post">
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
</form>-->

@include('cars._form_scripts')

@endsection