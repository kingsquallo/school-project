@extends('frontend.master')
@section('title',$post->title)
@push('css')
<link rel="stylesheet" href="{{ asset('layout/frontend/plugins/fotorama-4.6.4/fotorama.css') }}">
@endpush
@section('content')
<div class="modern-single-ad-top-description-wrap">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="modern-single-ad-breadcrumb">
                    <ol class="breadcrumb">
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li>{{ $post->title }}</li>
                    </ol><!-- breadcrumb -->
                    <h2 class="modern-single-ad-top-title">{{ $post->title }}</h2>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="modern-single-ad-top-description">
                <div class="col-sm-7 col-xs-12">
                    <div class="ads-gallery">
                        <div class="fotorama" data-nav="thumbs">
                            <img src="{{ $post->image_url }}" class="img-responsive" >
                            @foreach ($post->images as $image)
                            <img src="{{ $post->imageDetail($image->path) }}" class="img-responsive" >
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="col-sm-5 col-xs-12">
                    <h2>
                        <a href="{{ $post->url }}">{{$post->title }}</a>
                    </h2>
                    <h2 class="modern-single-ad-price">{!! $post->priceFormat !!}</h2>

                    <h3>Thông tin cơ bản:</h3>
                    <p>
                        <strong><i class="fa fa-money"></i> Giá : {!! $post->priceFormat !!}
                            @if ($post->negotiable == 1)
                            (Có thể thỏa thuận)
                            @endif
                        </strong>
                    </p>
                    <p>
                        <strong><i class="fa fa-map-marker"></i> Địa điểm :</strong> {{ $post->address }} , {{ $post->district->name.", ".$post->district->city->name }}
                    </p>
                    <p>
                        <strong> <i class="fa fa-eye"></i> Lượt xem :</strong> {{ $post->views }}
                    </p>
                    {{-- <p><strong><i class="fa fa-check-circle-o"></i> Điều kiện</strong> </p> --}}

                    {{-- <div class="modern-social-share-btn-group">
                        <h4>Chia sẻ</h4>
                        <a href="javascript:;" class="btn btn-default shareEmbedded" data-toggle="modal" data-target="#shareEmbedded"><i
                                class="fa fa-code"></i> </a>
                        <a href="#" class="btn btn-default share s_facebook"><i class="fa fa-facebook"></i> </a>
                        <a href="#" class="btn btn-default share s_plus"><i class="fa fa-google-plus"></i> </a>
                        <a href="#" class="btn btn-default share s_twitter"><i class="fa fa-twitter"></i> </a>
                        <a href="#" class="btn btn-default share s_linkedin"><i class="fa fa-linkedin"></i> </a>
                    </div> --}}
                </div>
                <div class="clearfix"></div>
            </div>
        </div>

    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-sm-8 col-xs-12">
            <div class="ads-detail bg-white">
                <div class="single-at-a-glance">
                    <ul class="list-group ">
                        <li class="list-group-item col-sm-4 col-xs-6"><i class="fa fa-building-o"></i>
                            {{ $post->property_type->name }}
                        </li>
                        <li class="list-group-item col-sm-4 col-xs-6"><i class="fa fa-arrows-alt "></i>
                            Diện tích : {{ $post->area }} m<sup>2</sup>
                        </li>
                        <li class="list-group-item col-sm-4 col-xs-6"><i class="fa fa-bed"></i>
                            {{ $post->detail->bed_room}} Phòng ngủ
                        </li>
                        <li class="list-group-item col-sm-4 col-xs-6"><i class="fa fa-bath"></i>
                            {{ $post->detail->bath }} Bồn tắm
                        </li>

                        <li class="list-group-item col-sm-4 col-xs-6"><i class="fa fa-shower"></i>
                             {{ $post->detail->toilet }} Toilet
                        </li>

                        <li class="list-group-item col-sm-4 col-xs-6"><i class="fa fa-building-o"></i> {{ $post->detail->floor }} Tầng
                        </li>

                        <li class="list-group-item col-sm-4 col-xs-6"><i class="fa fa-briefcase"></i> Mục đích : {{ $post->purpose_format }} </li>

                        <li class="list-group-item col-sm-4 col-xs-6"><i class="fa fa-window-maximize"></i> {{ $post->detail->balcony }} Ban công
                        </li>
                        @if ($post->detail->dinning_room)
                        <li class="list-group-item col-sm-4 col-xs-6"><i class="fa fa-cutlery"></i> Phòng ăn
                        </li>
                        @endif
                        @if ($post->detail->living_room)
                        <li class="list-group-item col-sm-4 col-xs-6"><i class="fa fa-folder-o"></i> Phòng khách
                        </li>
                        @endif
                        <li class="list-group-item col-sm-4 col-xs-6"><i class="fa fa-money"></i>
                          {!! $post->price_format !!}
                        </li>

                    </ul>
                    <div class="clearfix"></div>
                </div>
                <h4 class="ads-detail-title">Mô tả</h4>
                    {!! $post->description_html !!}
            </div>
            @if ($post->conveniences->isNotEmpty())
            <div class="ads-detail bg-white">
                @if ($post->conveniences->contains('type','interior'))
                <legend>Nội thất</legend>
                <div class="single-at-a-glance">
                    <ul class="list-group ">
                        @foreach ($post->conveniences as $convenience)
                            @if ($convenience->type == "interior")
                            <li class="list-group-item col-sm-4 col-xs-6">
                                <i class="fa fa-check-circle-o"></i> {{ $convenience->name }}
                            </li>
                            @endif
                        @endforeach
                    </ul>
                    <div class="clearfix"></div>
                </div>
                @endif
                @if ($post->conveniences->contains('type','exterior'))
                <legend>Ngoại thất</legend>
                <div class="single-at-a-glance">
                    <ul class="list-group ">
                        @foreach ($post->conveniences as $convenience)
                            @if ($convenience->type == 'exterior')
                            <li class="list-group-item col-sm-4 col-xs-6">
                                <i class="fa fa-check-circle-o"></i> {{ $convenience->name }}
                            </li>
                            @endif
                        @endforeach
                    </ul>
                    <div class="clearfix"></div>
                </div>
                @endif

            </div>
            @endif
            <div class="ads-detail bg-white">
                <legend>Khoảng cách</legend>
                <div class="single-at-a-glance">
                    <ul class="list-group ">
                       @foreach ($post->distances as $distance)
                        @if ($distance->pivot->meters > 0)
                        <li class="list-group-item col-sm-4 col-xs-6">
                            <i class="fa fa-road"></i> {{ $distance->name }} <i class="fa fa-arrow-right"></i> {{ $distance->pivot->meters }} M
                        </li>
                        @endif
                       @endforeach
                    </ul>
                    <div class="clearfix"></div>
                </div>
            </div>


            <div class="ads-detail bg-white">
                <legend>Bản đồ</legend>
                <div id="map" style="width: 100%; height: 400px; margin: 20px 0;"></div>
                <button onclick="getGeolocation()" class="btn btn-primary">Dẫn đường</button>
                <input type="hidden" id="longitude" value="{{ $post->longitude }}" name="longitude">
                <input type="hidden" id="latitude" value="{{ $post->latitude }}" name="latitude">
                <div id="panel" style="width:100%;height:auto;"></div>
            </div>

        </div>

        <div class="col-sm-4 col-xs-12">
            <div class="sidebar-widget">

                <h3>Thông tin chủ BĐS</h3>
                <div class="sidebar-user-info">
                    <div class="row">
                        <div class="col-xs-3">
                            <img src="{{ asset('layout/user-icon.jpg') }}" class="img-circle img-responsive" />
                        </div>
                        <div class="col-xs-9">
                            <h5>{{ $post->user->name }}</h5>
                            <p class="text-muted"><i class="fas fa-map-marker-alt"></i>{{ $post->user->address }}</p>
                        </div>
                    </div>
                </div>

                <div class="sidebar-user-link">
                    <ul class="ad-action-list">
                        <li>
                            <a href="javascript:void(0)" data-slug="{{ $post->slug }}" id="save_as_favorite">
                                <i class="{{ Auth::guest() ? 'fa fa-star-o' : ($post->is_favorited ? 'fa fa-star' : 'fa fa-star-o' ) }}"></i>
                                {{ Auth::guest() ? 'Thêm vào yêu thích' : ($post->is_favorited ? 'Xóa khỏi yêu thích' : 'Thêm vào yêu thích') }}
                            </a>
                        </li>
                        <li>
                            <a href="#" data-toggle="modal" data-target="#reportAdModal"><i class="fa fa-ban"></i>
                                Báo cáo bài viết
                            </a>
                        </li>
                    </ul>
                </div>

            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="reportAdModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Có điều gì sai với quảng cáo này??</h4>
            </div>
            <div class="modal-body">
                <p>Chúng tôi liên tục làm việc chăm chỉ để đảm bảo rằng quảng cáo của chúng tôi đáp ứng các tiêu chuẩn cao và chúng tôi rất biết ơn về bất kỳ loại phản hồi nào từ người dùng của chúng tôi.</p>
                <form id="form-report" method="post" action="{{ route('ajax.report-post') }}" >
                    @csrf
                    <div class="form-group">
                        <input type="hidden" value="{{ $post->id }}" name="post_id">
                        <label class="control-label">Reason:</label>
                        <select class="form-control" name="reason" id="reason">
                            <option value="">Chọn nguyên nhân</option>
                            <option value="unavailable">Đã bán / Không có</option>
                            <option value="duplicate">Trùng bài viết</option>
                            <option value="spam">Spam</option>
                            <option value="others">Khác</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="email" class="control-label">Email:</label>
                        <input type="email" class="form-control" name="email" value="{{ Auth::user()->email ?? null }}" id="email" autofocus>
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="control-label">Tin nhắn:</label>
                        <textarea class="form-control" name="message" id="message"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" id="report_button">Report Ad</button>
            </div>
        </div>
    </div>
</div>
@endsection
@push('js')
<script src="{{ asset('layout/frontend/js/myscript/map.js') }}"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCQuDQmtiHkS7CcriyEiYXWja3ODrG4vFI&callback=initMap"></script>
<script src="{{ asset('layout/frontend/plugins/fotorama-4.6.4/fotorama.js') }}"></script>
<script>
$(document).ready(function () {
    $("#save_as_favorite").click(function(){
        var selector = $(this);
        var slug = selector.data('slug');
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "post",
            url : "{{ route('posts.favorite') }}",
            data : {
                "slug" : slug
            },
            success: function (data) {
                if (data == 1) {
                    selector.html("<i class='fa fa-star'></i> Xóa khỏi yêu thích");
                }else{
                    selector.html("<i class='fa fa-star-o'></i> Thêm vào yêu thích");
                }
            },
            error:function(xhr){
                var res = xhr.responseJSON;
                if (res.error) {
                    toastr.options.progressBar = true;
                    toastr.warning(res.error);
                }
            }
        });
    });
});
</script>

<script>
$(document).ready(function () {
    $("#report_button").click(function (e) {
        e.preventDefault();
        var form = $("#form-report");
        var url = form.attr("action");
        form.find('.help-block').remove();
        form.find('.form-group').removeClass('has-error');
        $.ajax({
            type: "post",
            url: url,
            data: form.serialize(),
            success: function (response) {
                $("#reportAdModal").modal("hide");
                toastr.success("Gửi báo cáo thành công!","Success");
                form[0].reset();
                form.find('.help-block').remove();
                form.find('.form-group').removeClass('has-error');
            },
            error: function (xhr) {
                var res = xhr.responseJSON;
                if ($.isEmptyObject(res) == false) {
                    $.each(res.errors,function (key,value) {
                        $("#"+key).closest(".form-group")
                                    .addClass("has-error")
                                    .append('<strong class="help-block with-errors">'+value+'</strong>');
                    })
                }else{
                    alert("Error!!")
                }
            },
        });
    });
});
</script>
@endpush
