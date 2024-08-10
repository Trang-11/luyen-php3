@extends('master')

@section('content')
    <form action="{{ route('games.store') }}" method="post" enctype="multipart/form-data">

        @csrf
        <div class="mt-2 mb-3">
            <label for="name" class="form-label">Title</label>
            <input type="text" name="title" id="" class="form-control">
            @error('title')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="mt-2 mb-3">
            <label for="name" class="form-label">developter</label>
            <input type="text" name="developter" id="" class="form-control">
            @error('developter')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="mt-2 mb-3">
            <label for="name" class="form-label">release_year</label>
            <input type="text" name="release_year" id="" class="form-control">
            @error('release_year')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="mt-2 mb-3">
            <label for="name" class="form-label">genre</label>
            <input type="text" name="genre" id="" class="form-control">
            @error('genre')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="mt-2 mb-3">
            <label for="name" class="form-label">cover_art</label>
            <input type="file" name="cover_art" id="" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection
