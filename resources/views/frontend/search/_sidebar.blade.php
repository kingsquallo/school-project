<div class="bg-white">
    <div class="sidebar-filter-wrapper">
        <form method="GET" action="https://demo.themeqx.com/themeqxestate/listing" accept-charset="UTF-8"
            id="listingFilterForm">
            <div class="row">
                <div class="col-xs-12">
                    <p class="listingSidebarLeftHeader">Tìm kiếm nâng cao <span id="loaderListingIcon" class="pull-right"
                            style="display: none;"><i class="fa fa-spinner fa-spin"></i></span>
                            <span id="loaderListingIcon" class="pull-right" style="display: none;"><i class="fa fa-spinner fa-spin"></i></span>
                    </p>
                </div>
            </div>

            <div class="form-group">
                <input type="text" id="q" class="form-control selector" autofocus name="q" value="{{ request()->get('q') ?? '' }}" placeholder="Search keywords" />
            </div>
            <hr />

            <div class="form-group">
                <label>Nội thất</label>
                <select class="form-control select2 selector" name="convenience" data-placeholder="Select a Convenience"  multiple="multiple" id="convenience">
                    <optgroup label="Interior">
                    @foreach ($conveniences as $convenience)
                        @if ($convenience->type == "Nội thất")
                            <option value="{{ $convenience->id }}">{{ $convenience->name }}</option>
                        @endif
                    @endforeach
                    </optgroup>
                    <optgroup label="Ngoại thất">
                    @foreach ($conveniences as $convenience)
                        @if ($convenience->type == "exterior")
                            <option value="{{ $convenience->id }}">{{ $convenience->name }}</option>
                        @endif
                    @endforeach
                    </optgroup>
                </select>
            </div>

            <hr />
            <label>Địa điểm</label>
            <div class="form-group">
                <select class="form-control select2 selector" id="city" name="city_id">
                    <option value=""> Chọn thành phố </option>
                    @foreach ($cities as $city)
                        <option {{ request()->get('city_id')  == $city->id ? 'selected' : '' }} value="{{ $city->id }}">{{ $city->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <select class="form-control select2 selector" id="district" name="district_id">
                    <option value=""> Chọn Quận/huyện </option>
                </select>
            </div>

            {{-- <hr />
            <div class="form-group">
                <label>Price (Min-Max)</label>

                <div class="row">
                    <div class="col-xs-6">
                        <input type="number" class="form-control" name="min_price" value="" placeholder="Min price" />
                    </div>
                    <div class="col-xs-6">
                        <input type="number" class="form-control" name="max_price" value="" placeholder="Max price" />
                    </div>
                </div>
            </div> --}}
            <hr />
            <label>Mục đích</label>
            <div class="form-group">
                <div class="radio">
                    <label class="radio-inline">
                        <input type="radio" value="sale" class="purpose selector" name="purpose">
                        Bán
                    </label>
                    <label class="radio-inline">
                        <input type="radio" value="rent" class="purpose selector" name="purpose">
                        Cho thuê
                    </label>
                </div>
            </div>

            <hr />
            <label>Loại bất động sản</label>
            <div class="form-group">
                @foreach ($property_types as $type)
                <div class="radio">
                    <label class="radio-inline">
                        <input type="radio" value="{{ $type->slug }}" class="property_type selector" name="property_type">
                        {{ $type->name }} </label>
                </div>
                @endforeach
            </div>

            <hr />
            <div class="form-group">
                <div class="row">
                    <div class=" col-sm-6 col-xs-12">
                        <a href="javascript:void(0)" id="reset-button" class="btn btn-default btn-block"><i
                                class="fa fa-refresh"></i> Reset</a>
                    </div>
                </div>
            </div>

        </form>
        <div class="clearfix"></div>
    </div>
</div>
