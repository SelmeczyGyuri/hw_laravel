@extends('layout')

@section('content')

<h1>Új tervező</h1>

@error('designer')
    <div class="alert alert-warning">
        {{ $message }}
    </div>
@enderror

<form action="{{ route('designers.store') }}" method="post">
    @csrf
    <fieldset>
        <label for="designer">Tervező</label>
        <input type="text" name="designer" id="designer">
    </fieldset>
    <button type="submit">Mentés</button>
</form>

@endsection