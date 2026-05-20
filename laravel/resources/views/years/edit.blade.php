@extends('layout')

@section('content')

@error('year')
    <div class="alert alert-warning">
        {{ $message }}
    </div>
@enderror

<form action="{{ route('years.update', $year->id) }}" method="post">
    @csrf
    @method('PUT')
    <fieldset>
        <label for="year">Szín</label>
        <input type="number" name="year" id="year" value="{{ old('year', $year->year) }}">
    </fieldset>
    <button type="submit">Mentés</button>
</form>

@endsection