<?php

use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

// マイページ 第1階層
Breadcrumbs::for('users.detail', function (BreadcrumbTrail $trail, $user) {
    $trail->push('マイページ', route('users.detail', $user->name));
});

// プロフィール編集 第2階層
Breadcrumbs::for('users.edit', function (BreadcrumbTrail $trail, $user) {
    $trail->parent('users.detail', $user);
    $trail->push('プロフィール編集', route('users.edit', $user->name));
});

// パスワード変更 第3階層
Breadcrumbs::for('users.password.edit', function (BreadcrumbTrail $trail, $user) {
    $trail->parent('users.edit', $user);
    $trail->push('パスワード変更', route('users.password.edit', $user->name));
});

// ホーム 第1階層
Breadcrumbs::for('articles.index', function (BreadcrumbTrail $trail) {
    $trail->push('ホーム', route('articles.index'));
});

// 新規投稿 第2階層
Breadcrumbs::for('articles.create', function (BreadcrumbTrail $trail) {
    $trail->parent('articles.index');
    $trail->push('新規投稿', route('articles.create'));
});

// 記事編集 第2階層
Breadcrumbs::for('articles.edit', function (BreadcrumbTrail $trail, $article) {
    $trail->parent('articles.index');
    $trail->push('記事編集', route('articles.edit', $article->id));
});

// 記事詳細 第2階層
Breadcrumbs::for('articles.show', function (BreadcrumbTrail $trail, $article) {
    $trail->parent('articles.index');
    $trail->push('記事詳細', route('articles.show', $article->id));
});


