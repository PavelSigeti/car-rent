@extends('layouts.user.page')

@section('title', 'Блог - FoxRent')
@section('h1', 'Блог')
@section('description', 'Полезные статить для путишесвтвий по Крыму. FoxRent')

@section('content')
    <section class="section-item">
        <div class="container">
            <div class="row text-section">
                @foreach($postImages as $key => $image)
                    <div class="col-lg-4">
                        <a href="{{route('user.post.show', [$posts[$key]['slug']])}}" class="post-link">
                            <div class="post-container">
                                <picture>
                                    <source srcset="{{ asset($image[1]['uri']) }}" media="(max-width: 575.98px)" type="image/webp">
                                    <source srcset="{{ asset($image[0]['uri']) }}" type="image/webp">
                                    <img itemprop="image" src="{{asset($image[0]['uri'])}}" alt="{{$posts[$key]['title']}}">
                                </picture>
                                <div class="post-title">{{$posts[$key]['title']}}</div>
                                <div class="post-date">{{date('d.m.Y', strtotime($posts[$key]['created_at']))}}</div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
            <div class="row">
                <div class="col-12">
                    {!! $links !!}
                </div>
            </div>
        </div>
    </section>
@endsection


