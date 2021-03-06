<div class="row">
    <div class="col-sm-12">
        <div class="listingTopFilterBar">
            <span class="totalFoundListingTop">
                @if (isset($keyword))
                Tìm thấy <strong>{{ $posts->total() }}</strong> kết quả với từ khóa <span class="badge badge-info">
                    {{ $keyword }}</span>
                @else
                Tổng <strong>{{ $posts->total() }}</strong> bài viết được tìm thấy
                @endif
                @if (isset($min))
                    <span class="badge badge-info">Min : {{ number_format($min,0,',','.') }}</span>
                @endif
                @if ($max > $min)
                    <span class="badge badge-info">Max : {{ number_format($max,0,',','.') }}</span>
                @endif
            </span>

            <ul class="listingViewIcon pull-right">
                <li class="dropdown shortByListingLi">
                    <a aria-expanded="false" aria-haspopup="true" role="button" data-toggle="dropdown"
                        class="dropdown-toggle" href="#">Sắp xếp <span class="caret"></span></a>
                    <ul class="dropdown-menu" id="sortList">
                        <li class="{{ $sort == 'price_desc' ? 'active' : ''}}"><a href="javascript:void(0)"
                                data-sort="price_desc">Giá cao xuống thấp</a></li>
                        <li class="{{ $sort == 'price_asc' ? 'active' : ''}}"><a href="javascript:void(0)"
                                data-sort="price_asc">Giá thấp lên cao</a></li>
                        <li class="{{ $sort == 'latest' ? 'active' : ''}}"><a href="javascript:void(0)"
                                data-sort="latest">Mới nhất</a>
                        </li>
                    </ul>
                </li>

                <li><a href="javascript:void(0)" id="showGridView">
                        <i class="fa fa-th-large"></i> </a> </li>
                <li><a href="javascript:void(0)" id="showListView">
                        <i class="fa fa-list"></i> </a> </li>
            </ul>
        </div>
    </div>
</div>
<div class="ad-box-wrap">
    <h3>Danh sách kết quả</h3>
    @if (count($posts)>0)
    <div class="ad-box-grid-view" style="display: {{ $grid  ? 'block' : 'none' }}; ">
        <div class="row">
            @foreach ($posts as $post)
            <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="ads-item-thumbnail {{ $post->type->slug == "tin-vip" ? 'ad-box-premium' : 'ad-box-regular' }}">
                    <div class="ads-thumbnail">
                        <a href="{{ $post->url }}">
                            <img src="{{ $post->image_url }}" height="400px" class="img-bordered" alt="{{ $post->title }}">
                            <span class="modern-sale-rent-indicator">
                                {{ $post->purpose_format }}
                            </span>
                        </a>
                    </div>
                    <div class="caption">
                        <h4>
                            <a style="color : {{ $post->type->slug == 'tin-vip' ? 'red' : ($post->type->slug == 'tin-cao-cap' ? 'green' : '')}};" href="{{ $post->url }}" title="{{ $post->title }}">
                                <span>{{ str_limit($post->title, 30) }} </span>
                            </a>
                        </h4>

                        <p class="price">
                            <span class="text-warning">{!! $post->priceFormat !!} </span>
                            @if ($post->negotiable == 1)
                            <span class="badge badge-primary">Thỏa thuận</span>
                            @endif
                        </p>

                        <table class="table table-responsive property-box-info">
                            <tr>
                                <td>
                                    <a class="location text-muted" title="{{ $post->district->city->name ." / ".$post->district->name }}" href="javascript:void(0)">
                                        <i class="fa fa-map-marker"></i>
                                        {{ str_limit($post->district->city->name ." / ".$post->district->name, 16) }}
                                    </a>
                                </td>
                                <td>
                                    <p class="date-posted text-muted"> <i class="fa fa-clock-o"></i>
                                        {{ $post->created_at->diffForHumans() }}</p>
                                </td>
                            </tr>

                            <tr>
                                <td> <i class="fa fa-building"></i> {{ $post->property_type->name }} </td>
                                <td><i class="fa fa-arrows-alt "></i> {{ $post->area }} m<sup>2</sup></td>
                            </tr>

                            <tr>
                                <td><i class="fa fa-bed"></i> {{ $post->detail->bed_room }} Phòng ngủ</td>
                                <td> {{ $post->detail->floor }} Tầng </td>
                            </tr>

                        </table>

                        @if ($post->type->slug == "tin-cao-cap")
                        <div class="ribbon-wrapper-green">
                            <div class="ribbon-green">Premium</div>
                        </div>
                        @endif
                        @if ($post->type->slug == "tin-vip")
                        <div class="ribbon-wrapper-red">
                            <div class="ribbon-red"><i class="fa fa-star"></i></div>
                        </div>
                        <div class="ribbon-wrapper-green">
                            <div class="ribbon-green">VIP</div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

<div class="ad-box-list-view" style="display: {{ $grid === false ? 'block' : 'none' }};">
    <div class="row">
        <div class="col-md-12">
            <table class="table table-bordered table-responsive">
                @foreach ($posts as $post)
                <tr class="ad-{{ $post->type->slug == "tin-vip" ? 'premium' : 'regular' }}">
                    <td width="200px">
                        <a  href="{{ $post->url }}">
                            <img src="{{ $post->image_url }}" class="img-responsive"
                                alt="{{ $post->title }}">
                            <span class="modern-sale-rent-indicator">
                                {{ $post->purpose_format }}
                            </span>
                        </a>
                    </td>
                    <td>
                        <h4><a style="color : {{ $post->type->slug == 'tin-vip' ? 'red' : ($post->type->slug == 'tin-cao-cap' ? 'green' : '')}};" href="{{ $post->url }}">{{ $post->title }}</a> </h4>
                        <p class="price">
                            <span class="text-warning">{!! $post->priceFormat !!} </span>
                            @if ($post->negotiable == 1)
                                 <span class="badge badge-primary">Thỏa thuận</span>
                            @endif
                        </p>
                        <p class="text-muted">
                            <i class="fa fa-map-marker"></i> <a class="location text-muted">
                                {{ $post->district->city->name }} / {{ $post->district->name }}</a> ,
                            <i class="fa fa-clock-o"></i> {{ $post->created_at->diffForHumans() }}
                        </p>

                        <p class="listViewItemFooter m-b-05">
                            <span> <i class="fa fa-building"></i> {{ $post->property_type->name }} </span>

                            <span> <i class="fa fa-arrows-alt "></i> {{ $post->area }} m<sup>2</sup> </span>

                            <span>
                                <i class="fa fa-bed"></i> {{ $post->detail->bed_room }} Phòng ngủ </span>
                            <span>{{ $post->detail->floor }} Tầng</span>
                        </p>
                        @if ($post->type->slug == "tin-cao-cap")
                            <div class="ribbon-green-bar">Premium</div>
                        @endif
                        @if ($post->type->slug == "tin-vip")
                            <div class="ribbon-red-bar"><i class="fa fa-star"></i></div>
                            <div class="ribbon-green-bar">VIP</div>
                        @endif
                    </td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>
</div>
@else
<div class="row">
    <div class="col-md-12 col-sm-6 col-xs-12">
        <h1>No data found</h1>
    </div>
</div>
@endif
</div>
<div class="text-center">
    {{ $posts->appends(request()->except(['page','district_id','city_id','q']))->links() }}
</div>
