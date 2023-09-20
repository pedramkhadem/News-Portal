<section class="pt-0 mt-5">
    <div class="popular__section-news">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-lg-8">
                    <div class="wrapper__list__article">
                        <h4 class="border_section">{{ __('recent post') }}</h4>
                    </div>

                        <div class="row ">
                            @foreach ($recentNews as $recent)
                                @if($loop->index <=1)
                                <div class="col-sm-12 col-md-6 mb-4">
                                    <!-- Post Article -->
                                        <div class="card__post ">
                                            <div class="card__post__body card__post__transition">
                                                <a href="{{route('news-detail' , $recent->slug) }}">
                                                    <img src="{{ asset($recent->image) }}" class="img-fluid" alt="">
                                                </a>
                                                <div class="card__post__content bg__post-cover">
                                                    <div class="card__post__category">
                                                        {{ $recent->category->name }}
                                                    </div>
                                                    <div class="card__post__title">
                                                        <h5>
                                                            <a href="{{route('news-detail' , $recent->slug) }}">
                                                                {!! truncate($recent->title) !!}.</a>
                                                        </h5>
                                                    </div>
                                                    <div class="card__post__author-info">
                                                        <ul class="list-inline">
                                                            <li class="list-inline-item">
                                                                <a href="{{route('news-detail' , $recent->slug) }}">
                                                                    {{ __('by') }}{{ $recent->auther->name }}
                                                                </a>
                                                            </li>
                                                            <li class="list-inline-item">
                                                                <span>
                                                                    {{ date('d M ,Y' , strtotime($recent->created_at)) }}
                                                                </span>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                </div>
                                @endif
                            @endforeach
                        </div>
                    <div class="row ">

                            <div class="col-sm-12 col-md-6">
                                <div class="wrapp__list__article-responsive">
                                    @foreach ($recentNews as $news )
                                        @if($loop->index >1 && $loop->index <=3)
                                            <div class="mb-3">
                                                <!-- Post Article -->
                                                <div class="card__post card__post-list">
                                                    <div class="image-sm">
                                                        <a href="{{ route('news-detail', $news->slug) }}">
                                                            <img src="{{ asset($news->image) }}" class="img-fluid" alt="">
                                                        </a>
                                                    </div>
                                                    <div class="card__post__body ">
                                                        <div class="card__post__content">

                                                            <div class="card__post__author-info mb-2">
                                                                <ul class="list-inline">
                                                                    <li class="list-inline-item">
                                                                        <span class="text-primary">
                                                                            {{ __('by') }}{{ $news->auther->name }}
                                                                        </span>
                                                                    </li>
                                                                    <li class="list-inline-item">
                                                                        <span class="text-dark text-capitalize">
                                                                            {{ date('d M ,Y' ,strtotime($news->created_at)) }}
                                                                        </span>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                            <div class="card__post__title">
                                                                <h6>
                                                                    <a href="{{ route('news-detail', $news->slug) }}">
                                                                        {{ truncate($news->title , 40) }}
                                                                    </a>
                                                                </h6>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="wrapp__list__article-responsive">
                                    @foreach ($recentNews as $news )
                                        @if($loop->index >3 && $loop->index <=5)
                                            <div class="mb-3">
                                                <!-- Post Article -->
                                                <div class="card__post card__post-list">
                                                    <div class="image-sm">
                                                        <a href="{{ route('news-detail', $news->slug) }}">
                                                            <img src="{{ asset($news->image) }}" class="img-fluid" alt="">
                                                        </a>
                                                    </div>
                                                    <div class="card__post__body ">
                                                        <div class="card__post__content">

                                                            <div class="card__post__author-info mb-2">
                                                                <ul class="list-inline">
                                                                    <li class="list-inline-item">
                                                                        <span class="text-primary">
                                                                            {{ __('by') }}{{ $news->auther->name }}
                                                                        </span>
                                                                    </li>
                                                                    <li class="list-inline-item">
                                                                        <span class="text-dark text-capitalize">
                                                                            {{ date('d M ,Y' ,strtotime($news->created_at)) }}
                                                                        </span>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                            <div class="card__post__title">
                                                                <h6>
                                                                    <a href="{{ route('news-detail', $news->slug) }}">
                                                                        {{ truncate($news->title , 40) }}
                                                                    </a>
                                                                </h6>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>

                    </div>
                </div>


                <div class="col-md-12 col-lg-4">
                    <aside class="wrapper__list__article">
                        <h4 class="border_section">popular post</h4>
                        <div class="wrapper__list-number">
                            <!-- List Article -->
                            @foreach ($popularNews as $popular )

                                <div class="card__post__list">
                                    <div class="list-number">
                                        <span>
                                            {{ ++$loop->index }}
                                        </span>
                                    </div>
                                    <a href="{{ route('news-detail', $news->slug) }}" class="category">
                                        {{ $popular->category->name }}
                                    </a>
                                    <ul class="list-inline">
                                        <li class="list-inline-item">
                                            <h5>
                                                <a href="{{ route('news-detail', $news->slug) }}">
                                                    {!! truncate($popular->title , 100) !!}
                                                </a>
                                            </h5>
                                        </li>
                                    </ul>
                                </div>
                            @endforeach
                        </div>
                    </aside>
                </div>
            </div>
        </div>
    </div>

    <!-- Post news carousel -->
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <aside class="wrapper__list__article">
                    <h4 class="border_section">{{ @$CategorySectionOne->first()->category->name}}</h4>
                </aside>
            </div>
            <div class="col-md-12">
                <div class="article__entry-carousel">
                    @foreach ($CategorySectionOne as $SectionOne)

                    <div class="item">
                        <!-- Post Article -->
                        <div class="article__entry">
                            <div class="article__image">
                                <a href="{{ route('news-detail' , $SectionOne->slug) }}">
                                    <img src="{{ asset($SectionOne->image) }}" alt="" class="img-fluid">
                                </a>
                            </div>
                            <div class="article__content">
                                <ul class="list-inline">
                                    <li class="list-inline-item">
                                        <span class="text-primary">
                                            {{ __('by') }} {{ $SectionOne->auther->name }}
                                        </span>
                                    </li>
                                    <li class="list-inline-item">
                                        <span>
                                            {{ date('M d ,Y' , strtotime($SectionOne->created_at)) }}
                                        </span>
                                    </li>

                                </ul>
                                <h5>
                                    <a href="{{ route('news-detail' , $SectionOne->slug) }}">
                                        {!! truncate($SectionOne->title ,40) !!}
                                    </a>
                                </h5>

                            </div>
                        </div>
                    </div>
                    @endforeach

                </div>
            </div>
        </div>

    </div>
     <!-- End Popular news category -->

    <!-- Post news carousel -->
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <aside class="wrapper__list__article">
                    <h4 class="border_section">{{ @$CategorySectionTwo->first()->category->name }}</h4>
                </aside>
            </div>
            <div class="col-md-12">
                <div class="article__entry-carousel">
                    @foreach($CategorySectionTwo as $SectionTwo)

                    <div class="item">
                        <!-- Post Article -->
                        <div class="article__entry">
                            <div class="article__image">
                                <a href="{{ route('news-detail' ,$SectionTwo->slug) }}">
                                    <img src="{{ asset($SectionTwo->image) }}" alt="" class="img-fluid">
                                </a>
                            </div>
                            <div class="article__content">
                                <ul class="list-inline">
                                    <li class="list-inline-item">
                                        <span class="text-primary">
                                            {{ __('by') }} {{ $SectionTwo->auther->name }}
                                        </span>
                                    </li>
                                    <li class="list-inline-item">
                                        <span>
                                            {{ date('M d ,Y' , strtotime($SectionTwo->created_at)) }}
                                        </span>
                                    </li>

                                </ul>
                                <h5>
                                    <a href="{{ route('news-detail' , $SectionTwo->slug) }}">
                                        {!! truncate($SectionTwo->title ,40) !!}
                                    </a>
                                </h5>

                            </div>
                        </div>
                    </div>
                    @endforeach

                </div>
            </div>
        </div>

    </div>
    <!-- End Popular news category -->



    <!-- Popular news category -->
    <div class="mt-4">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <aside class="wrapper__list__article mb-0">
                        <h4 class="border_section">{{ @$CategorySectionThree->first()->category->name }}</h4>
                        <div class="row">
                            <div class="col-md-6">
                                @foreach ($CategorySectionThree as $sectionThree)
                                @if ($loop->index <=2)
                                <div class="mb-4">
                                    <!-- Post Article -->
                                    <div class="article__entry">
                                        <div class="article__image">
                                            <a href="{{ route('news-detail' , $sectionThree->slug) }}">
                                                <img src="{{ asset($sectionThree->image) }}" alt="" class="img-fluid">
                                            </a>
                                        </div>
                                        <div class="article__content">
                                            <ul class="list-inline">
                                                <li class="list-inline-item">
                                                    <span class="text-primary">
                                                        {{ __('by') }} {{ $sectionThree->auther->name }}
                                                    </span>
                                                </li>
                                                <li class="list-inline-item">
                                                    <span>
                                                       {{ date('M d , Y' , strtotime($sectionThree->created_at)) }}
                                                    </span>
                                                </li>

                                            </ul>
                                            <h5>
                                                <a href="{{ route('news-detail' , $sectionThree->slug) }}">
                                                    {!! truncate($sectionThree->title , 50) !!}
                                                </a>
                                            </h5>

                                        </div>
                                    </div>
                                </div>
                                @endif
                                @endforeach

                            </div>
                            <div class="col-md-6">
                                @foreach ($CategorySectionThree as $sctionThree)
                                @if ($loop->index >2 && $loop->index <=5 )
                                <div class="mb-4">
                                    <!-- Post Article -->
                                    <div class="article__entry">
                                        <div class="article__image">
                                            <a href="{{ route('news-detail' , $sectionThree->slug) }}">
                                                <img src="{{ asset($sectionThree->image) }}" alt="" class="img-fluid">
                                            </a>
                                        </div>
                                        <div class="article__content">
                                            <ul class="list-inline">
                                                <li class="list-inline-item">
                                                    <span class="text-primary">
                                                        {{ __('by') }} {{ $sectionThree->auther->name }}
                                                    </span>
                                                </li>
                                                <li class="list-inline-item">
                                                    <span>
                                                       {{ date('M d , Y' , strtotime($sectionThree->created_at)) }}
                                                    </span>
                                                </li>

                                            </ul>
                                            <h5>
                                                <a href="{{ route('news-detail' , $sectionThree->slug) }}">
                                                    {!! truncate($sectionThree->title , 50) !!}
                                                </a>
                                            </h5>

                                        </div>
                                    </div>
                                </div>
                                @endif
                                @endforeach

                            </div>
                        </div>
                    </aside>

                    <div class="small_add_banner">
                        <div class="small_add_banner_img">
                            <img src="images/placeholder_large.jpg" alt="adds">
                        </div>
                    </div>

                    <aside class="wrapper__list__article mt-5">
                        <h4 class="border_section">{{ @$CategorySectionFour->first()->category->name }}</h4>

                        <div class="wrapp__list__article-responsive">
                            <!-- Post Article List -->
                            @foreach ($CategorySectionFour as $sectionFour )

                            <div class="card__post card__post-list card__post__transition mt-30">
                                <div class="row ">
                                    <div class="col-md-5">
                                        <div class="card__post__transition">
                                            <a href="{{ route('news-detail' , $sectionFour->slug) }}">
                                                <img src="{{ asset($sectionFour->image) }}" class="img-fluid w-100" alt="">
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-md-7 my-auto pl-0">
                                        <div class="card__post__body ">
                                            <div class="card__post__content  ">
                                                <div class="card__post__category ">
                                                    {{ $sectionFour->category->name }}
                                                </div>
                                                <div class="card__post__author-info mb-2">
                                                    <ul class="list-inline">
                                                        <li class="list-inline-item">
                                                            <span class="text-primary">
                                                                {{ __('by') }} {{ $sectionFour->auther->name }}
                                                            </span>
                                                        </li>
                                                        <li class="list-inline-item">
                                                            <span class="text-dark text-capitalize">
                                                                {{ date('M d ,Y' , strtotime($sectionFour->created_at)) }}
                                                            </span>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="card__post__title">
                                                    <h5>
                                                        <a href="{{ route('news-detail' , $sectionFour->slug) }}">
                                                            {!! truncate($sectionFour->title , 50) !!}
                                                        </a>
                                                    </h5>
                                                    <p class="d-none d-lg-block d-xl-block mb-0">
                                                        {!! truncate($sectionFour->title, 100) !!}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            @endforeach

                    </aside>
                </div>

                <div class="col-md-4">
                    <div class="sticky-top">
                        <aside class="wrapper__list__article">
                            <h4 class="border_section">
                                Latest post</h4>
                            <div class="wrapper__list__article-small">

                                <!-- Post Article -->
                                <div class="article__entry">
                                    <div class="article__image">
                                        <a href="#">
                                            <img src="images/newsimage2.png" alt="" class="img-fluid">
                                        </a>
                                    </div>
                                    <div class="article__content">
                                        <div class="article__category">
                                            travel
                                        </div>
                                        <ul class="list-inline">
                                            <li class="list-inline-item">
                                                <span class="text-primary">
                                                    by david hall
                                                </span>
                                            </li>
                                            <li class="list-inline-item">
                                                <span class="text-dark text-capitalize">
                                                    descember 09, 2016
                                                </span>
                                            </li>

                                        </ul>
                                        <h5>
                                            <a href="#">
                                                Proin eu nisl et arcu iaculis placerat sollicitudin ut est
                                            </a>
                                        </h5>
                                        <p>
                                            Maecenas accumsan tortor ut velit pharetra mollis. Proin eu nisl et arcu
                                            iaculis placerat sollicitudin ut
                                            est. In fringilla dui dui.
                                        </p>
                                        <a href="#" class="btn btn-outline-primary mb-4 text-capitalize"> read
                                            more</a>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <!-- Post Article -->
                                    <div class="card__post card__post-list">
                                        <div class="image-sm">
                                            <a href="blog_details.html">
                                                <img src="images/news1.jpg" class="img-fluid" alt="">
                                            </a>
                                        </div>

                                        <div class="card__post__body ">
                                            <div class="card__post__content">
                                                <div class="card__post__author-info mb-2">
                                                    <ul class="list-inline">
                                                        <li class="list-inline-item">
                                                            <span class="text-primary">
                                                                by david hall
                                                            </span>
                                                        </li>
                                                        <li class="list-inline-item">
                                                            <span class="text-dark text-capitalize">
                                                                descember 09, 2016
                                                            </span>
                                                        </li>

                                                    </ul>
                                                </div>
                                                <div class="card__post__title">
                                                    <h6>
                                                        <a href="blog_details.html">
                                                            6 Best Tips for Building a Good Shipping Boat
                                                        </a>
                                                    </h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <!-- Post Article -->
                                    <div class="card__post card__post-list">
                                        <div class="image-sm">
                                            <a href="blog_details.html">
                                                <img src="images/news2.jpg" class="img-fluid" alt="">
                                            </a>
                                        </div>

                                        <div class="card__post__body ">
                                            <div class="card__post__content">

                                                <div class="card__post__author-info mb-2">
                                                    <ul class="list-inline">
                                                        <li class="list-inline-item">
                                                            <span class="text-primary">
                                                                by david hall
                                                            </span>
                                                        </li>
                                                        <li class="list-inline-item">
                                                            <span class="text-dark text-capitalize">
                                                                descember 09, 2016
                                                            </span>
                                                        </li>

                                                    </ul>
                                                </div>
                                                <div class="card__post__title">
                                                    <h6>
                                                        <a href="blog_details.html">
                                                            6 Best Tips for Building a Good Shipping Boat
                                                        </a>
                                                    </h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </aside>

                        <aside class="wrapper__list__article">
                            <h4 class="border_section">stay conected</h4>
                            <!-- widget Social media -->
                            <div class="wrap__social__media">
                                <a href="#" target="_blank">
                                    <div class="social__media__widget facebook">
                                        <span class="social__media__widget-icon">
                                            <i class="fa fa-facebook"></i>
                                        </span>
                                        <span class="social__media__widget-counter">
                                            19,243 fans
                                        </span>
                                        <span class="social__media__widget-name">
                                            like
                                        </span>
                                    </div>
                                </a>
                                <a href="#" target="_blank">
                                    <div class="social__media__widget twitter">
                                        <span class="social__media__widget-icon">
                                            <i class="fa fa-twitter"></i>
                                        </span>
                                        <span class="social__media__widget-counter">
                                            2.076 followers
                                        </span>
                                        <span class="social__media__widget-name">
                                            follow
                                        </span>
                                    </div>
                                </a>
                                <a href="#" target="_blank">
                                    <div class="social__media__widget youtube">
                                        <span class="social__media__widget-icon">
                                            <i class="fa fa-youtube"></i>
                                        </span>
                                        <span class="social__media__widget-counter">
                                            15,200 followers
                                        </span>
                                        <span class="social__media__widget-name">
                                            subscribe
                                        </span>
                                    </div>
                                </a>

                            </div>
                        </aside>

                        <aside class="wrapper__list__article">
                            <h4 class="border_section">tags</h4>
                            <div class="blog-tags p-0">
                                <ul class="list-inline">

                                    <li class="list-inline-item">
                                        <a href="#">
                                            #property
                                        </a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a href="#">
                                            #sea
                                        </a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a href="#">
                                            #programming
                                        </a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a href="#">
                                            #sea
                                        </a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a href="#">
                                            #property
                                        </a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a href="#">
                                            #life style
                                        </a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a href="#">
                                            #technology
                                        </a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a href="#">
                                            #framework
                                        </a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a href="#">
                                            #sport
                                        </a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a href="#">
                                            #game
                                        </a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a href="#">
                                            #wfh
                                        </a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a href="#">
                                            #sport
                                        </a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a href="#">
                                            #game
                                        </a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a href="#">
                                            #wfh
                                        </a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a href="#">
                                            #framework
                                        </a>
                                    </li>

                                </ul>
                            </div>
                        </aside>

                        <aside class="wrapper__list__article">
                            <h4 class="border_section">Advertise</h4>
                            <a href="#">
                                <figure>
                                    <img src="images/newsimage3.png" alt="" class="img-fluid">
                                </figure>
                            </a>
                        </aside>

                        <aside class="wrapper__list__article">
                            <h4 class="border_section">newsletter</h4>
                            <!-- Form Subscribe -->
                            <div class="widget__form-subscribe bg__card-shadow">
                                <h6>
                                    The most important world news and events of the day.
                                </h6>
                                <p><small>Get magzrenvi daily newsletter on your inbox.</small></p>
                                <div class="input-group ">
                                    <input type="text" class="form-control" placeholder="Your email address">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="button">sign up</button>
                                    </div>
                                </div>
                            </div>
                        </aside>
                    </div>
                </div>

                <div class="clearfix"></div>
            </div>
        </div>
    </div>
</section>
