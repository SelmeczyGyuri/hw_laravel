@extends('layout')

@section('content')

@error('color')
    <div class="alert alert-warning">
        {{ $message }}
    </div>
@enderror

<form action="{{ route('colors.update', $color->id) }}" method="post">
    @csrf
    @method('PUT')
    <fieldset>
        <label for="color">Szín</label>
        <input type="text" name="color" id="color" value="{{ old('color', $color->color) }}">
    </fieldset>
    <button type="submit">Mentés</button>
</form>

@endsection