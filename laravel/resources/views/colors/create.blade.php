@extends('layout')

@section('content')

<div class="form-back-link">
    <a href="{{ route('colors.index') }}" class="btn btn-secondary">← Vissza a listához</a>
</div>
<br>
<h1>
    <span class="title-bar" aria-hidden="true"></span>
    Új szín
</h1>

@error('color')
    <div class="alert alert-warning">
        {{ $message }}
    </div>
@enderror

<div class="simple-form-wrap">
    <form action="{{ route('colors.store') }}" method="post" class="simple-form">
        @csrf
        <div class="simple-form-body">
            <label for="color">Szín neve</label>
            <input type="text" name="color" id="color"
                   value="{{ old('color') }}"
                   autocomplete="off">
        </div>
        <div class="simple-form-actions">
            <a href="{{ route('colors.index') }}" class="btn btn-secondary">Mégsem</a>
            <button type="submit" class="btn btn-primary">✓ Mentés</button>
        </div>
    </form>
</div>

@endsection