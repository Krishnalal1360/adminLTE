@extends('admin.cms.layouts.master')

@php
    $currentPage = 'home';
@endphp

@section('title', 'Home - My CMS')

@section('content')
    <h1>Welcome to My CMS</h1>
    <p>
        <pre>
This CMS showcases blogs, their details, and allows you to contact us.
Here you will find a collection of interesting blog posts on various topics.
        </pre>
    </p>
@endsection
