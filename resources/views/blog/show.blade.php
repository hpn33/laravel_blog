@extends('layouts.main')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <article class="post-item post-detail">

                    @if($post->image_url)
                        <div class="post-item-image">
                            <img src="{{ $post->image_url }}" alt="{{ $post->title }}">
                        </div>
                    @endif

                    <div class="post-item-body">
                        <div class="padding-10">
                            <h1>{{ $post->title }}</h1>

                            <div class="post-meta no-border">
                                <ul class="post-meta-group">
                                    <li><i class="fa fa-user"></i>
                                        <a
                                            href="{{ $post->author->path() }}"> {{ $post->author->name }}</a>
                                    </li>
                                    <li><i class="fa fa-clock-o"></i>
                                        <time> {{ $post->date }}</time>
                                    </li>
                                    <li><i class="fa fa-tags"></i>
                                        <a href="{{ $post->category->path() }}"> {{ $post->category->title }}</a>
                                    </li>
                                    <li><i class="fa fa-comments"></i><a href="#">4 Comments</a></li>
                                </ul>
                            </div>

                            <div>

                                @markdown($post->body)

                            </div>
                        </div>
                    </div>
                </article>

                <?php $author = $post->author; ?>
                <article class="post-author padding-10">
                    <div class="media">
                        <div class="media-left">
                            <a href="{{ $author->path() }}">
                                <img alt="{{ $author->name }}" src="{{ $author->gravatar() }}" class="media-object">
                            </a>
                        </div>
                        <div class="media-body">
                            <h4 class="media-heading"><a href="{{ $author->path() }}">{{ $author->name }}</a></h4>
                            <div class="post-author-count">
                                <a href="#">
                                    <i class="fa fa-clone"></i>
                                    <?php $postCount = $author->posts->count() ?>
                                    {{ $postCount }} {{ \Illuminate\Support\Str::plural('post', $postCount) }}
                                </a>
                            </div>
                            <div>
                                {{ $author->bio }}
                            </div>
                        </div>
                    </div>
                </article>

                <!-- comments here -->
            </div>

            @include('layouts.sidebar')
        </div>
    </div>

@endsection
