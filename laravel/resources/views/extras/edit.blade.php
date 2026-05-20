@extends('layout')

@section('content')

@error('extra')
    <div class="alert alert-warning">
        {{ $message }}
    </div>
@enderror

<form action="{{ route('extras.update', $extra->id) }}" method="post">
    @csrf
    @method('PUT')
    <fieldset>
        <label for="extra">Extra</label>
        <input type="text" name="extra" id="extra">
    </fieldset>
    <button type="submit">Mentés</button>
</form>

@endsection