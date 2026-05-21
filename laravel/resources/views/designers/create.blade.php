@extends('layout')

@section('content')

<div class="form-back-link">
    <a href="{{ route('designers.index') }}" class="btn btn-secondary">← Vissza a listához</a>
</div>
<br>
<h1>
    <span class="title-bar" aria-hidden="true"></span>
    Új tervező
</h1>

@error('designer')
    <div class="alert alert-warning">
        {{ $message }}
    </div>
@enderror

<div class="simple-form-wrap">
    <form action="{{ route('designers.store') }}" method="post" class="simple-form">
        @csrf
        <div class="simple-form-body">
            <label for="designer">Tervező neve</label>
            <input type="text" name="designer" id="designer"
                   value="{{ old('designer') }}"
                   autocomplete="off">
        </div>
        <div class="simple-form-actions">
            <a href="{{ route('designers.index') }}" class="btn btn-secondary">Mégsem</a>
            <button type="submit" class="btn btn-primary">✓ Mentés</button>
        </div>
    </form>
</div>
 
@include('_simple_form_styles')

@endsection