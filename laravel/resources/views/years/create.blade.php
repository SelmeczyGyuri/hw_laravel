@extends('layout')

@section('content')

<div class="form-back-link">
    <a href="{{ route('years.index') }}" class="btn btn-secondary">← Vissza a listához</a>
</div>
<br>
<h1>
    <span class="title-bar" aria-hidden="true"></span>
    Új gyártási év
</h1>


@error('year')
    <div class="alert alert-warning">
        {{ $message }}
    </div>
@enderror

<div class="simple-form-wrap">
    <form action="{{ route('years.store') }}" method="post" class="simple-form">
        @csrf
        <div class="simple-form-body">
            <label for="year">Gyártási év</label>
            <input type="number" name="year" id="year"
                   value="{{ old('year') }}"
                   autocomplete="off" min="1968" max="9999">
        </div>
        <div class="simple-form-actions">
            <a href="{{ route('years.index') }}" class="btn btn-secondary">Mégsem</a>
            <button type="submit" class="btn btn-primary">✓ Mentés</button>
        </div>
    </form>
</div>

@endsection