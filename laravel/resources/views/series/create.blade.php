@extends('layout')

@section('content')

<h1>Új széria</h1>

@error('series')
    <div class="alert alert-warning">
        {{ $message }}
    </div>
@enderror

<form action="{{ route('series.store') }}" method="post">
    @csrf
    <fieldset>
        <label for="series">Széria</label>
        <input type="text" name="series" id="series">
    </fieldset>
    <button type="submit">Mentés</button>
</form>

@endsection