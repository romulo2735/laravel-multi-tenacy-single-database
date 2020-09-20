@extends('layouts.app')
@section('content')
    <div class="row">
        @forelse($posts as $post)
            <p>{{ $post->title }}</p>
        @empty
            <p>Data not avaliable</p>
        @endforelse
    </div>
@endsection
