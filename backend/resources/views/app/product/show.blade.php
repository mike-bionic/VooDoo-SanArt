@extends('layouts.base')

@section('javascripts')
    @parent
    <script src="https://api-maps.yandex.ru/2.1/?apikey=2486014f-5aa5-4ac7-a8b8-048d24bde293&lang=ru_RU" type="text/javascript">
    </script>
    <script>
        $(document).ready(function(){

            function init(lat, long){
                // Создание карты.
                var myMap = new ymaps.Map("map", {
                        center: [lat, long],
                        zoom: 15
                    }),
                    myGeoObject = new ymaps.GeoObject({
                        geometry: {
                            type: "Point",
                            coordinates: [lat, long]
                        },
                        properties: {
                            iconContent: 'Awtor şu ýerde'
                        }
                    },{
                        preset: 'islands#blackStretchyIcon',
                        draggable: true
                    });
                myMap.geoObjects
                    .add(myGeoObject)
            }
            var hardcoded = [37.929770, 58.367451]
            $('#latitude').val(hardcoded[0])
            $('#longitude').val(hardcoded[1])
            setTimeout(() => {
                init(hardcoded[0], hardcoded[1])
            }, 3000);

        });

    </script>

@endsection

@section('content')
    <div class="row">
        <div class="col-lg-9">
            <div class="product_details mt-50">
                <div class="product_image">
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="details-1" role="tabpanel" aria-labelledby="details-1-tab">
                            <img src="{{ asset($product->cover_path) }}" alt="product details">
                        </div>
                        @foreach($product->gallery as $imagePath)
                            <div class="tab-pane fade" id="details-2" role="tabpanel" aria-labelledby="details-2-tab">
                                <img src="{{ asset($imagePath) }}" alt="product details">
                            </div>
                        @endforeach
                    </div>
                    <ul class="nav" id="myTab" role="tablist">

                        @foreach($product->gallery as $imagePath)
                            <div class="tab-pane fade" id="details-2" role="tabpanel" aria-labelledby="details-2-tab">
                                <img src="" alt="product details">
                            </div>
                            <li class="nav-item">
                                <a class="active" id="details-1-tab" data-toggle="tab" href="#details-1" role="tab" aria-controls="details-1" aria-selected="true">
                                    <img src="{{ asset($imagePath) }}" alt="product details">
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="product_details_meta d-sm-flex justify-content-between align-items-end">
                    <div class="product_price">
                        <span class="price">{{ $product->priceText() }}</span>
{{--                        <p>Negotiable</p>--}}
                    </div>
                    <div class="product_date">
                        <ul class="meta">
                            <li>
                                <i class="fa fa-clock-o"></i>
                                <a href="#">{{ $product->updated_at->format('d M, Y') }}</a>
                                <a href="#">{{ $product->updated_at->format('H:i') }}</a>
                            </li>
                            <li><i class="fa fa-eye"></i><a href="#">{{ $product->viewed }}</a></li>
                        </ul>
                    </div>
                </div>
                <div class="product_details_features">
                    <div class="product_details_title">
                        <h5 class="title">Aýratynlyklar :</h5>
                    </div>
                    <div class="details_features_wrapper d-flex flex-wrap">
                        <div class="single_features d-flex">
                            <h6 class="features_title">Bölümi :</h6>
                            <p>
                                <a href="{{ route('app.product.list', ['category' => $product->category]) }}">
                                    {{ $product->category->title }}
                                </a>
                            </p>
                        </div>
                        @if($product->location)
                            <div class="single_features d-flex">
                                <h6 class="features_title">Ýeri :</h6>
                                <p>
                                    <a href="{{ route('app.product.list', ['location' => $product->location]) }}">
                                        {{ $product->location->title }}
                                    </a>
                                </p>
                            </div>
                        @endif
                        @if($product->weigh)
                            <div class="single_features d-flex">
                                <h6 class="features_title">Agramy (gr) :</h6>
                                <p>{{ $product->weigh }}</p>
                            </div>
                        @endif
                        @if($product->width)
                            <div class="single_features d-flex">
                                <h6 class="features_title">Ini (sm) :</h6>
                                <p>{{ $product->width }}</p>
                            </div>
                        @endif
                        @if($product->height)
                            <div class="single_features d-flex">
                                <h6 class="features_title">Beýikligi (sm):</h6>
                                <p>{{ $product->height }}</p>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="product_details_description">
                    <div class="product_details_title">
                        <h5 class="title">Barada :</h5>
                    </div>
                    <p>
                        {!! $product->description !!}
                    </p>
                </div>
            </div>


        </div>
        <div class="col-lg-3">
            <div class="product_details_sidebar pt-20">
                @if($product->user)
                    <div class="product_sidebar_owner mt-30">
                        <div class="product_details_title">
                            <h5 class="title">Awtory :</h5>
                        </div>
                        <div class="product_owner_wrapper mt-20">
                            <div class="owner_author d-flex align-items-center">
                                <div class="author_image">
                                    <img src="{{ asset($product->user->avatar_path) }}" alt="author">
                                </div>
                                <div class="author_content media-body">
                                    <h5 class="author_name">{{ $product->user->name }}</h5>
                                    <p>Member Since 2021</p>
                                </div>
                            </div>
                            @if($product->user->location)
                            <div class="owner_address d-flex">
                                <div class="address_icon">
                                    <i class="far fa-map-marker-alt"></i>
                                </div>
                                <div class="address_content media-body">
                                    <p>{{ optional($product->user->location)->title }}</p>
                                </div>
                            </div>
                            @endif
                            @if($product->user->phone)
                                <div class="owner_call">
                                    <a class="main-btn" href="tel:+993{{ $product->user->phone }}">
                                        <i class="fal fa-phone"></i> +993{{ $product->user->phone }}
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                @endif
                <div class="product_sidebar_contact mt-30">
                    <div class="product_details_title">
                        <h5 class="title">Satyjy bilen habarlaşmak :</h5>
                    </div>
                    <div class="sidebar_contact_form">
                        <form action="product-details.html#">
                            <div class="single_form">
                                <input type="text" placeholder="Name">
                            </div>
                            <div class="single_form">
                                <input type="email" placeholder="Mail address">
                            </div>
                            <div class="single_form">
                                <textarea placeholder="Type message"></textarea>
                            </div>
                            <div class="single_form">
                                <button class="main-btn"><i class="fal fa-paper-plane"></i>Send to Seller</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="product_sidebar_map mt-30">
                    <div class="product_details_title">
                        <h5 class="title">Geolokasiýasy:</h5>
                    </div>
                    <div class="gmap_canvas">
                        <div id="map" style="width:100%; height:250px"></div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
