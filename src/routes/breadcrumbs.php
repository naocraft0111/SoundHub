<?php

use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

// 投稿記事TOP 第1階層
Breadcrumbs::for('articles.index', function (BreadcrumbTrail $trail) {
    $trail->push('投稿記事TOP', route('articles.index'));
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


