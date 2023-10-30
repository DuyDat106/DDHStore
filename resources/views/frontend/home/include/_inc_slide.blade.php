<div class="row" style="margin-top: 50px">
    <div class="col-sm-8">
        @if (isset($slides))
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel" style="height: 470px;">
                <ol class="carousel-indicators">
                    @for($i = 0 ; $i < count($slides); $i ++)
                        <li data-target="#{{ $i }}" data-slide-to="{{ $i }}" class="{{ $i == 0 ? 'active' : '' }}"></li>
                    @endfor
                </ol>
                <div class="carousel-inner">
                    @foreach($slides as $key =>  $item)
                        <div class="carousel-item {{ $key == 0  ? 'active' : '' }}">
                            <img class="d-block w-100" style="height: 470px;object-fit: cover" src="{{ pare_url_file($item->s_banner) }}" alt="{{ $item->s_text }}">
                        </div>
                    @endforeach
                </div>
{{--                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">--}}
{{--                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>--}}
{{--                    <span class="sr-only">Previous</span>--}}
{{--                </a>--}}
{{--                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">--}}
{{--                    <span class="carousel-control-next-icon" aria-hidden="true"></span>--}}
{{--                    <span class="sr-only">Next</span>--}}
{{--                </a>--}}
            </div>
            <div class="slide-lists-text">
                @foreach($slides as $item)
                    <div class="item">
                        <p>{{ $item->s_description }}</p>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
    <div class="col-sm-4">
        <div class="slide-right">
            <div class="item">
                <a href="">
                    <img src="{{ asset('images/s1.jpg') }}" alt="" class="img-laptop">
                </a>
            </div>
            <div class="item">
                <a href="">
                    <img src="{{ asset('images/s4.jpg') }}" alt="" class="img-laptop">
                </a>
            </div>
            <div class="item">
                <a href="">
                    <img src="{{ asset('images/s-3.jpeg') }}" alt="" class="">
                </a>
            </div>
            <div class="item">
                <a href="">
                    <img src="{{ asset('images/s2.jpg') }}" alt="" class="img-laptop">
                </a>
            </div>
            <style>
                .img-laptop{
                    border-radius: 5px
                }
            </style>
        </div>
    </div>
</div>
