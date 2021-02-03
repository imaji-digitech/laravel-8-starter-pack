<div class="blog_right_sidebar">
    <aside class="single_sidebar_widget search_widget">
        <form action="#">
            <div class="form-group">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder='Cari Kata'
                           onfocus="this.placeholder = ''"
                           onblur="this.placeholder = 'Search Keyword'">
                    <div class="input-group-append">
                        <button class="btns" type="button"><i class="ti-search"></i></button>
                    </div>
                </div>
            </div>
            <button class="button rounded-0 primary-bg text-white w-100 btn_1 boxed-btn"
                    type="submit">Cari</button>
        </form>
    </aside>

    <aside class="single_sidebar_widget post_category_widget">
        <h4 class="widget_title">Kategori</h4>
        <ul class="list cat-list">
            @foreach(Helper::getCategory() as $c)
                <li>
                    <a href="#" class="d-flex">
                        <p>{{$c->tag}}</p>
                        <p>({{$c->contentTags->count()}})</p>
                    </a>
                </li>
            @endforeach

        </ul>
    </aside>

    <aside class="single_sidebar_widget popular_post_widget">
        <h3 class="widget_title">Post Terbaru</h3>
        <div class="media post_item">
            @foreach(Helper::getRecentPost() as $c)
            <img src="{{asset('storage/content/'.$c->thumbnail)}}" alt="post" style="max-height: 100px">
            <div class="media-body">
                <a href="single-blog.html">
                    <h3>{{$c->title}}</h3>
                </a>
                <p>{{$c->created_at->format('d M Y')}}</p>
            </div>
            @endforeach
        </div>
    </aside>
{{--    <aside class="single_sidebar_widget tag_cloud_widget">--}}
{{--        <h4 class="widget_title">Tag</h4>--}}
{{--        <ul class="list">--}}
{{--            @foreach(Helper::getTag() as $c)--}}
{{--            <li>--}}
{{--                <a href="#">{{$c->contentTags}}</a>--}}
{{--            </li>--}}
{{--            @endforeach--}}
{{--        </ul>--}}
{{--    </aside>--}}


{{--    <aside class="single_sidebar_widget instagram_feeds">--}}
{{--        <h4 class="widget_title">Instagram Feeds</h4>--}}
{{--        <ul class="instagram_row flex-wrap">--}}
{{--            <li>--}}
{{--                <a href="#">--}}
{{--                    <img class="img-fluid" src="{{asset('front/img/post/post_5.png')}}" alt="">--}}
{{--                </a>--}}
{{--            </li>--}}
{{--            <li>--}}
{{--                <a href="#">--}}
{{--                    <img class="img-fluid" src="{{asset('front/img/post/post_6.png')}}" alt="">--}}
{{--                </a>--}}
{{--            </li>--}}
{{--            <li>--}}
{{--                <a href="#">--}}
{{--                    <img class="img-fluid" src="{{asset('front/img/post/post_7.png')}}" alt="">--}}
{{--                </a>--}}
{{--            </li>--}}
{{--            <li>--}}
{{--                <a href="#">--}}
{{--                    <img class="img-fluid" src="{{asset('front/img/post/post_8.png')}}" alt="">--}}
{{--                </a>--}}
{{--            </li>--}}
{{--            <li>--}}
{{--                <a href="#">--}}
{{--                    <img class="img-fluid" src="{{asset('front/img/post/post_9.png')}}" alt="">--}}
{{--                </a>--}}
{{--            </li>--}}
{{--            <li>--}}
{{--                <a href="#">--}}
{{--                    <img class="img-fluid" src="{{asset('front/img/post/post_10.png')}}" alt="">--}}
{{--                </a>--}}
{{--            </li>--}}
{{--        </ul>--}}
{{--    </aside>--}}


{{--    <aside class="single_sidebar_widget newsletter_widget">--}}
{{--        <h4 class="widget_title">Newsletter</h4>--}}

{{--        <form action="#">--}}
{{--            <div class="form-group">--}}
{{--                <input type="email" class="form-control" onfocus="this.placeholder = ''"--}}
{{--                       onblur="this.placeholder = 'Enter email'" placeholder='Enter email' required>--}}
{{--            </div>--}}
{{--            <button class="button rounded-0 primary-bg text-white w-100 btn_1 boxed-btn"--}}
{{--                    type="submit">Subscribe</button>--}}
{{--        </form>--}}
{{--    </aside>--}}
</div>
