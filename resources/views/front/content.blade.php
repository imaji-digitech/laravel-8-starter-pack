@extends('layouts.master')
@section('content')
    <!--================Blog Area =================-->
    <section class="blog_area section-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mb-5 mb-lg-0">
                    <div class="blog_left_sidebar">

                        @foreach($contents as $c)

                        <article class="blog_item">
                            <div class="blog_item_img">
                                <img class="card-img rounded-0" src="{{asset('storage/content/'.$c->thumbnail)}}" alt="">
                                <a href="#" class="blog_item_date">
                                    <h3>{{$c->created_at->format('d')}}</h3>
                                    <p>{{$c->created_at->format('M')}}</p>
                                </a>
                            </div>

                            <div class="blog_details">
                                <a class="d-inline-block" href="{{route('detail',$c->slug)}}">
                                    <h2>{{$c->title}}</h2>
                                </a>
                                <p>{!! Str::limit($c->contents, 800, '') !!}</p>
                                <ul class="blog-info-link">
                                    <li><a href="#"><i class="fa fa-user"></i>
                                            -
                                            @foreach($c->contentTags as $t)
                                                {{$t->tag->tag}} -
                                            @endforeach

                                        </a></li>
                                    <li><a href="#"><i class="fa fa-comments"></i> 03 Comments</a></li>
                                </ul>
                            </div>
                        </article>

                        @endforeach


                        <nav class="blog-pagination justify-content-center d-flex">
                            <ul class="pagination">
                                <li class="page-item">
                                    <a href="#" class="page-link" aria-label="Previous">
                                        <i class="ti-angle-left"></i>
                                    </a>
                                </li>
                                <li class="page-item">
                                    <a href="#" class="page-link">1</a>
                                </li>
                                <li class="page-item active">
                                    <a href="#" class="page-link">2</a>
                                </li>
                                <li class="page-item">
                                    <a href="#" class="page-link" aria-label="Next">
                                        <i class="ti-angle-right"></i>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <div class="col-lg-4">
                    @include('components.front-sidebar')
                </div>
            </div>
        </div>
    </section>
    <!--================Blog Area =================-->
@endsection
