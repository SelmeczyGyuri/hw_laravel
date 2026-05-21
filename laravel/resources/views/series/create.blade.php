@extends('layout')

@section('content')

<div class="form-back-link">
    <a href="{{ route('series.index') }}" class="btn btn-secondary">← Vissza a listához</a>
</div>
<br>
<h1>
    <span class="title-bar" aria-hidden="true"></span>
    Új széria
</h1>

@error('series')
    <div class="alert alert-warning">
        {{ $message }}
    </div>
@enderror

<div class="simple-form-wrap">
    <form action="{{ route('series.store') }}" method="post" class="simple-form">
        @csrf
        <div class="simple-form-body">
            <label for="series">Széria neve</label>
            <input type="text" name="series" id="series"
                   value="{{ old('series') }}"
                   autocomplete="off">
        </div>
        <div class="simple-form-actions">
            <a href="{{ route('series.index') }}" class="btn btn-secondary">Mégsem</a>
            <button type="submit" class="btn btn-primary">✓ Mentés</button>
        </div>
    </form>
</div>
 
@include('_simple_form_styles')

@endsection