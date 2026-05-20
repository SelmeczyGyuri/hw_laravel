@extends('layout')

@section('content')

<h1>Új Extra</h1>

@error('extra')
    <div class="alert alert-warning">
        {{ $message }}
    </div>
@enderror

<form action="{{ route('extras.store') }}" method="post">
    @csrf
    <fieldset>
        <label for="extra">Extra</label>
        <input type="text" name="extra" id="extra">
    </fieldset>
    <button type="submit">Mentés</button>
</form>

@endsection