@extends('layout')

@section('content')

@error('series')
    <div class="alert alert-warning">
        {{ $message }}
    </div>
@enderror

<form action="{{ route('series.update', $series->id) }}" method="post">
    @csrf
    @method('PUT')
    <fieldset>
        <label for="series">Szín</label>
        <input type="text" name="series" id="series" value="{{ old('series', $series->series) }}">
    </fieldset>
    <button type="submit">Mentés</button>
</form>

@endsection