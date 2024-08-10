@extends('master')

@section('content')
    <form action="{{ route('games.update', $game->id) }}" method="post" enctype="multipart/form-data">

        @csrf
        @method('PUT')
        <div class="mt-2 mb-3">
            <label for="name" class="form-label">Title</label>
            <input type="text" name="title" id="" class="form-control" value="{{ $game->title }}">
            @error('title')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="mt-2 mb-3">
            <label for="name" class="form-label">developter</label>
            <input type="text" name="developter" id="" class="form-control" value="{{ $game->developter }}">
            @error('developter')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="mt-2 mb-3">
            <label for="name" class="form-label">release_year</label>
            <input type="text" name="release_year" id="" class="form-control" value="{{ $game->release_year }}">
            @error('release_year')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="mt-2 mb-3">
            <label for="name" class="form-label">genre</label>
            <input type="text" name="genre" id="" class="form-control" value="{{ $game->genre }}">
            @error('genre')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="mt-2 mb-3">
            <label for="name" class="form-label">cover_art</label>
            <input type="file" name="cover_art" id="" class="form-control">
            <img src="{{ \Storage::url($game->cover_art) }}" alt="" width="80px">
            @error('cover_art')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
        <a href="{{ route('games.index') }}" class="btn btn-primary">Trở về</a>
    </form>
@endsection
