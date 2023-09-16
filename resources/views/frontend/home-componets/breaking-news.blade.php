<section class="bg-light">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="wrapp__list__article-responsive wrapp__list__article-responsive-carousel">
                    @foreach ($breakingnews as $news )
                    <div class="item">
                        <!-- Post Article -->
                        <div class="card__post card__post-list">
                            <div class="image-sm">
                                <a href="{{ route('news-detail' , $news->slug) }}">
                                    <img src="{{ asset($news->image) }}" class="img-fluid" alt="">
                                </a>
                            </div>

                            <div class="card__post__body ">
                                <div class="card__post__content">

                                    <div class="card__post__author-info mb-2">
                                        <ul class="list-inline">
                                            <li class="list-inline-item">
                                                <span class="text-primary">
                                                    {{ __('by') }} {{ $news->auther->name }}
                                                </span>
                                            </li>
                                            <li class="list-inline-item">
                                                <span class="text-dark text-capitalize">
                                                    {{ date('d M , Y' , strtotime($news->created_at)) }}
                                                </span>
                                            </li>

                                        </ul>
                                    </div>
                                    <div class="card__post__title">
                                        <h6>
                                            <a href="{{ route('news-detail' , $news->slug) }}">
                                                {!! truncate($news->title , 45) !!}
                                            </a>
                                        </h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
