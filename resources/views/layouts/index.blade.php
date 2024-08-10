@extends('master')

@section('content')
    <div class="row">

        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Cover_art</th>
                    <th>Developer </th>
                    <th>Release year</th>
                    <th>gerner</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $item)
                    <tr>
                        <td> {{$item->id}} </td>
                        <td> {{$item->title}} </td>
                        <td> 
                            <img src="{{ \Storage::url($item->cover_art)}}"  width="80px" alt="">
                             </td>
                        <td> {{$item->developter}} </td>
                        <td> {{$item->release_year}} </td>
                        <td> {{$item->genre}} </td>
                        <td>
                            <a href="{{ route('games.edit', $item->id) }}" class="btn btn-primary">edit </a> 
                            <form action="{{ route('games.destroy', $item->id) }}" method="POST" > 
                                @csrf
                                @method('DELETE')
                                <button onclick="return confirm('Bạn muốn xoá?')" class="btn btn-danger" type="submit">xoá</button>

                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection