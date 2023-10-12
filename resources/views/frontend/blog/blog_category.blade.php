@extends('frontend.main_master')
@section('main')
@section('title')
    {{ $category->name }} Category
@endsection
    <div class="page-header mt-30 mb-75">
        <div class="container">
            <div class="archive-header">
                <div class="row align-items-center">
                    <div class="col-xl-3">
                        <h1 class="mb-15">Blog & News</h1>
                        <div class="breadcrumb">
                            <a href="#" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                            <span></span> Blog & News
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="page-content mb-50">
        <div class="container">
            <div class="row">
                <div class="col-lg-9">
                    <div class="shop-product-fillter mb-50 pr-30">
                        <div class="totall-product">

                        </div>
                        <div class="sort-by-product-area">
                            <div class="sort-by-cover mr-10">

                            </div>
                            <div class="sort-by-cover">

                            </div>
                        </div>
                    </div>

                    <div class="loop-grid loop-list pr-30 mb-50">

                        @foreach($posts as $post)
                            <article class="wow fadeIn animated hover-up mb-30 animated">
                                <div class="post-thumb" style="background-image: url({{ asset('uploads/blog/'.$post->photo) }})">
                                    <div class="entry-meta">
                                        <a class="entry-meta meta-2" href="#"><i class="fi-rs-play-alt"></i></a>
                                    </div>
                                </div>
                                <div class="entry-content-2 pl-50">
                                    <h3 class="post-title mb-20">
                                        <a href="{{ route('blog.details',$post->id) }}">{{ $post->blog_title }}</a>
                                    </h3>
                                    <p class="post-exerpt mb-40">{{ $post->short_des }}</p>
                                    <div class="entry-meta meta-1 font-xs color-grey mt-10 pb-10">
                                        <div>
                                            <span class="post-on">{{ date('d,M Y', strtotime($post->created_at)) }}</span>
                                            <span class="hit-count has-dot">{{ $post->views }} Views</span>
                                        </div>
                                        <a href="{{ route('blog.details',$post->id) }}" class="text-brand font-heading font-weight-bold">Read more <i class="fi-rs-arrow-right"></i></a>
                                    </div>
                                </div>
                            </article>
                        @endforeach
                    </div>
                </div>
                <div class="col-lg-3 primary-sidebar sticky-sidebar">
                    <div class="widget-area">
                        <div class="sidebar-widget-2 widget_search mb-50">
                            <div class="search-form">
                                <form action="#">
                                    <input type="text" placeholder="Search…" />
                                    <button type="submit"><i class="fi-rs-search"></i></button>
                                </form>
                            </div>
                        </div>
                        <div class="sidebar-widget widget-category-2 mb-50">
                            <h5 class="section-title style-1 mb-30">Category</h5>
                            <ul>
                                @foreach($categories as $cat)
                                    @php
                                        $post = \App\Models\BlogPost::where('blog_category_id',$cat->id)->count();
                                    @endphp
                                    <li>
                                        <a href="{{ route('blog.post.cat',$cat->id) }}"> <img src="{{ URL::to('') }}/uploads/blog/category/{{ $cat->photo }}" alt="" />{{ $cat->name }}</a><span class="count">{{ $post }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <!-- Product sidebar Widget -->
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
