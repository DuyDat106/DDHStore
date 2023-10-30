@extends('layouts.app_frontend')
@section('title', $product->pro_name)
@section('')
@section('content')
    <div class="container">
        <div class="bsc-block">
            <section>
                <ul class="breadcrumb">
                    <li><a href="{{ route('get.product') }}" title="Sản phẩm">Sản phẩm</a></li>
                    @if (isset($product->category->c_name))
                        <li>
                            <a href="{{ route('get.category', $product->category->c_slug) }}"
                               title="{{ $product->category->c_name }}">{{ $product->category->c_name }}</a>
                            <meta property="position" content="1">
                        </li>
                    @endif
                    <li>
                        <a href="#" title="{{ $product->pro_name }}">{{ $product->pro_name }}</a>
                        <meta property="position" content="2">
                    </li>
                </ul>
            </section>
        </div>
        <h1 class="title-heading">{{ $product->pro_name }}</h1>
        <div class="box02">
            <div class="box02__left">
                <div class="detail-rate">
                    <p>
                        <i class="icondetail-star"></i>
                        <i class="icondetail-star"></i>
                        <i class="icondetail-star"></i>
                        <i class="icondetail-star"></i>
                        <i class="icondetail-star-dark"></i>
                    </p>
                    <p class="detail-rate-total">100 <span>đánh giá</span></p>
                </div>
            </div>
        </div>
        <div class="box_main">
            <div class="box_left">
                <div class="box01">
                    <div class="box01__show">
                        <a href="">
                            <img src="{{ pare_url_file($product->pro_avatar) }}" alt="">
                        </a>
                    </div>
                </div>
                <div class="policy_intuitive cate42 scenarioNomal">
                    <div class="policy">
                        <ul class="policy__list">
                            <li>
                                <div class="iconl">
                                    <i class="icondetail-doimoi"></i>
                                </div>
                                <p>
                                    Hư gì đổi nấy <b>12 tháng</b> tại 2532 siêu thị toàn quốc (miễn phí tháng đầu)
                                </p>
                            </li>
                            <li data-field="IsSameBHAndDT">
                                <div class="iconl">
                                    <i class="icondetail-baohanh"></i>
                                </div>
                                <p>
                                    Bảo hành <b>chính hãng laptop 1 năm</b>
                                </p>
                            </li>
                            <li>
                                <div class="iconl"><i class="icondetail-sachhd"></i></div>
                                <p>Bộ sản phẩm gồm</p>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="box-available"></div>
                <div class="border7"></div>
                <div class="article content-t-wrap">
                    <div class="article__content short">
                        <h3>Nội dung sản phẩm</h3>
                        {!! $product->pro_content !!}
                    </div>
                </div>

            </div>
            <div class="box_right">
                <div class="box04 box_normal">
                    <div class="price-one">
                        <div class="box-price">
                            
                            
                        @if($product->pro_sale > 0)
                            <p class="box-price-present">{{ number_format(((100 - $product->pro_sale) * $product->pro_price) / 100, 0, ',', '.') }}₫ </p>
                            <p class="box-price-old">{{ number_format($product->pro_price, 0, ',', '.') }}₫</p>
                        @else    
                            <p class="box-price">{{ number_format($product->pro_price, 0, ',', '.') }}₫ </p>
                        @endif
                            <p class="box-price-percent">*{{ number_format($product->pro_sale)}}%</p>
                            <span class="label label--black">Trả góp 0%</span>
                        </div>
                    </div>

                    <div class="block block-price1">
                        <div class="block__promo">
                            <div class="pr-top">
                                <p class="pr-txtb">Khuyến mãi </p>
                                <i class="pr-txt">Giá và khuyến mãi dự kiến áp dụng đến 23:00 18/07</i>
                            </div>
                           </div>
                        </div>
                        <div class="spmarket"></div>
                        <div class="block-button normal">
                            <a href="{{ route('get_ajax.shopping.add', $product->id) }}" class="btn-buynow jsBuy js-add-cart">MUA NGAY</a>
                        </div>
                    </div>
                </div>
                <div class="border7"></div>
                <p class="parameter__title">Cấu hình {{ $product->pro_name }}</p>
                <div class="parameter">
                    <ul class="parameter__list 236085 active">
                        @if($cconfiguration =  json_decode($product->pro_configuration, true))
                            @foreach($cconfiguration['key'] ?? [] as $key => $value)
                                <li data-index="0" data-prop="0">
                                    <p class="lileft">{{ $value }}</p>
                                    <div class="liright">
                                        <span class="">{{ $cconfiguration['value'][$key] }}</span>
                                    </div>
                                </li>
                            @endforeach
                        @endif
                    </ul>
                </div>
            </div>
        </div>
        <div class="box-common">
            <div class="box-common__top clearfix">
                <h2 class="box-common__title">Sản phẩm liên quan</h2>
            </div>
            <div class="box-common__main">
                <div class="listproduct">
                    @foreach($productsRelated ?? []  as $item)
                        @include('frontend.home.include._inc_product_item')
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@stop

