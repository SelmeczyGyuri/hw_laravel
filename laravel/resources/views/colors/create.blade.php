@extends('layout')

@section('content')

<h1>Új szín</h1>

@error('color')
    <div class="alert alert-warning">
        {{ $message }}
    </div>
@enderror

<form action="{{ route('colors.store') }}" method="post">
    @csrf
    <fieldset>
        <label for="color">Szín</label>
        <input type="text" name="color" id="color">
    </fieldset>
    <button type="submit">Mentés</button>
</form>

@endsection