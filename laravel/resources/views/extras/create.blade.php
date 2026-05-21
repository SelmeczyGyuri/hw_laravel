@extends('layout')

@section('content')

<div class="form-back-link">
    <a href="{{ route('extras.index') }}" class="btn btn-secondary">← Vissza a listához</a>
</div>
<br>
<h1>
    <span class="title-bar" aria-hidden="true"></span>
    Új extra
</h1>

@error('extra')
    <div class="alert alert-warning">
        {{ $message }}
    </div>
@enderror

<div class="simple-form-wrap">
    <form action="{{ route('extras.store') }}" method="post" class="simple-form">
        @csrf
        <div class="simple-form-body">
            <label for="extra">Extra neve</label>
            <input type="text" name="extra" id="extra"
                   value="{{ old('extra') }}"
                   autocomplete="off">
        </div>
        <div class="simple-form-actions">
            <a href="{{ route('extras.index') }}" class="btn btn-secondary">Mégsem</a>
            <button type="submit" class="btn btn-primary">✓ Mentés</button>
        </div>
    </form>
</div>
 
@include('_simple_form_styles')

@endsection