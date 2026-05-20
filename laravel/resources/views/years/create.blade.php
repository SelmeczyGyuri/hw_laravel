@extends('layout')

@section('content')

<h1>Új gyártási év</h1>

@error('year')
    <div class="alert alert-warning">
        {{ $message }}
    </div>
@enderror

<form action="{{ route('years.store') }}" method="post">
    @csrf
    <fieldset>
        <label for="year">Gyártási év</label>
        <input type="number" name="year" id="year" min="1968" max="9999">
    </fieldset>
    <button type="submit">Mentés</button>
</form>

@endsection