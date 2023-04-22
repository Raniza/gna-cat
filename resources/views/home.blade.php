@extends('layouts.app')

@section('content')
<main class="container-fluid">
    @error('error')
        <div class="form-error mb-2">
            <span>{{ $errors->first('error') }}</span>
        </div>
    @enderror
    <h4>Home Page</h4>
</main>    
@endsection