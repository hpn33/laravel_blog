@extends('layouts.main')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-8">

                <div>

                    @if(isset($categoryName))

                        <div>
                            <h2>Category: {{ $categoryName }}</h2>
                        </div>

                    @endif

                    @if(isset($authorName))

                        <div>
                            <h2>Author: {{ $authorName }}</h2>
                        </div>

                    @endif

                    @if(!$posts->count())

                        <div class="alert alert-info">
                            <p>Nothing Found</p>
                        </div>

                    @endif

                </div>


                @foreach($posts as $post)

                    <article class="post-item">

                        @if($post->image_url)

                            <div class="post-item-image">
                                <a href="{{ $post->path() }}">
                                    <img src="{{ $post->image_url }}" alt="">
                                </a>
                            </div>

                        @endif

                        <div class="post-item-body">
                            <div class="padding-10">
                                <h2><a href="{{ $post->path() }}">{{ $post->title }}</a></h2>
                                <div>
                                    @markdown($post->excerpt)
                                </div>
                            </div>

                            <div class="post-meta padding-10 clearfix">
                                <div class="pull-left">
                                    <ul class="post-meta-group">
                                        <li>
                                            <i class="fa fa-user"></i>
                                            <a
                                                href="{{$post->author->path()}}"> {{ $post->author->name }}</a>
                                        </li>
                                        <li>
                                            <i class="fa fa-clock-o"></i>
                                            <time> {{ $post->date }}</time>
                                        </li>

                                        @if($post->category)
                                            <li><i class="fa fa-tags"></i>
                                                <a href="{{ $post->category->path() }}"> {{ $post->category->title }}</a>
                                            </li>
                                        @endif

                                        <li><i class="fa fa-comments"></i><a href="#">4 Comments</a></li>
                                    </ul>
                                </div>
                                <div class="pull-right">
                                    <a href="{{ $post->path() }}">Continue Reading &raquo;</a>
                                </div>
                            </div>
                        </div>
                    </article>

                @endforeach

                <nav>
                    {{ $posts->links() }}
                </nav>
            </div>

            @include('layouts.sidebar')
        </div>
    </div>

@endsection
