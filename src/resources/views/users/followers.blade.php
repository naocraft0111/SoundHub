@extends('layouts.app')

@section('title', $user->name. 'のフォロワー')

@section('content')
    <div class="container">
        @include('users.user')
        @include('users.tabs', ['hasDetails' => true, 'hasArticles' => false, 'hasLikes' => false])
        @foreach ($followers as $person)
            @include('users.person')
        @endforeach
        {{ $followers->links('pagination::default') }}
    </div>
@endsection
