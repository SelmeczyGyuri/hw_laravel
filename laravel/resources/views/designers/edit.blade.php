@extends('layout')

@section('content')

@error('designer')
    <div class="alert alert-warning">
        {{ $message }}
    </div>
@enderror

<form action="{{ route('designers.update', $designer->id) }}" method="post">
    @csrf
    @method('PUT')
    <fieldset>
        <label for="designer">Tervező</label>
        <input type="text" name="designer" id="designer" value="{{ old('designer', $designer->designer) }}">
    </fieldset>
    <button type="submit">Mentés</button>
</form>

@endsection