@extends('layouts.app')

@section('title', 'ユーザー一覧 | SoundHub')

@section('content')
    <div class="container">
        @include('error_card_list')
        <div class="d-grid gap-2 mt-3">
            <a class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#myModal" href="#"><i class="fa fa-filter"></i>検索条件</a>
        </div>
        {{-- 検索モーダル --}}
        <div id="myModal" class="modal fade" tab-index="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">検索条件</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form id="filter" method="GET" action="{{ route('users.search') }}">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="name">ユーザー名</label>
                                <input id="name" type="text" class="form-control" name="name" value=@if (isset($inputs['name'])) {{ $inputs['name'] }} @endif>
                            </div>

                            <div class="form-group mt-3">
                                <label for="age">年齢</label>
                                <div class="row g-2 flex-nowrap">
                                    <div class="col-4"><input id="age_from" type="text" class="form-control" name="age_from" placeholder="指定なし" value=@if(isset($inputs['age_from'])) {{ $inputs['age_from'] }} @endif></div>
                                    <div class="col-1 text-center"><span class="form-control-plaintext">歳</span></div>
                                    <div class="col-2 text-center"><span class="form-control-plaintext">〜</span></div>
                                    <div class="col-4"><input id="age_to" type="text" class="form-control" name="age_to"placeholder="指定なし" value=@if(isset($inputs['age_to'])) {{ $inputs['age_to'] }} @endif></div>
                                    <div class="col-1 text-center"><span class="form-control-plaintext">歳</span></div>
                                </div>
                            </div>

                            <div class="form-group mt-3">
                                <label for="sound_category">音楽性</label>
                                <select name="sound_category" class="form-control">
                                    <option value="0">-------</option>
                                    @foreach ($sound_categories as $index => $name)
                                        <option value="{{ $index }}" @if(isset($inputs['sound_category'])) @selected(old('sound_category', $inputs['sound_category']) == $index) @endif>{{ $name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group mt-3">
                                <label for="pref">所在地</label>
                                <select name="pref" id="pref" class="form-control">
                                    @foreach ($prefs as $pref_id => $name)
                                    <option value="" hidden>&#9660;選択してください</option>
                                    <option value="{{ $pref_id }}" @if(isset($inputs['pref'])) @selected(old('pref', $inputs['pref']) == $pref_id) @endif>{{ $name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group mt-3">
                                <label for="gender">性別</label>
                                <select name="gender" id="gender" class="form-control">
                                    <option value="">-------</option>
                                    <option value="1" @if(isset($inputs['gender'])) @selected(old('gender', $inputs['gender']) == "1") @endif>男性</option>
                                    <option value="2" @if(isset($inputs['gender'])) @selected(old('gender', $inputs['gender']) == "2" ) @endif>女性</option>
                                    <option value="3" @if(isset($inputs['gender'])) @selected(old('gender', $inputs['gender']) == "3") @endif>その他</option>
                                </select>
                            </div>

                            <div class="form-group mt-3">
                                <label for="category">楽器ジャンル</label>
                                <select name="primary_category_id" id="primary" class="form-control">
                                    <option value="0" hidden>&#9660;全て</option>
                                    @foreach ($primaryCategoryList as $index => $name)
                                    <option value="{{ $index }}" @if(isset($inputs['primary_category_id'])) @selected(old('primary_category_id', $inputs['primary_category_id']) == $index) @endif>{{ $name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group mt-3">
                                <label for="category">楽器名</label>
                                <select name="secondary_category" id="secondary" class="form-control">
                                    <option value="0" hidden>&#9660;全て</option>
                                    @foreach ($secondaryCategoryList as $index => $name)
                                    <option value="{{ $index }}" @if(isset($inputs['secondary_category'])) @selected(old('secondary_category', $inputs['secondary_category']) == $index) @endif>{{ $name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-outline-secondary" form="filter">検索</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @foreach ($users as $person)
            @include('users.person')
        @endforeach
        @include('users.pagination')
    </div>
@endsection
