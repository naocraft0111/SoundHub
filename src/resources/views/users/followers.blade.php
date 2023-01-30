@extends('layouts.app')

@section('title', $user->name. 'のフォロワー')

@section('content')
    <div class="container">
        @include('users.user')
        @include('users.tabs', ['hasDetails' => false, 'hasArticles' => false, 'hasLikes' => false])
        @foreach ($followers as $person)
            @include('users.person')
        @endforeach
        <div class="pagination mt-3 justify-content-center">
            {{ $followers->links('pagination::default') }}
        </div>
    </div>
@endsection
