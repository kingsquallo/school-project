@extends('frontend.master')
@section('title','Search')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-3">
            @include('frontend.search._sidebar')
        </div>
        <div class="col-md-9 filter-data">
        </div>
    </div>
</div>
@endsection
@push('js')
<script>
    $(document).ready(function () {
        $('select[name="city_id"]').change(function () {
            $('select[name="district_id"]').select2('val',"");
            var city_id = $(this).val();
            getDistrict(city_id);
        });
        if($('select[name="city_id"]').val()) {
            var city_id = $('select[name="city_id"]').val();
            var district_id = '{{ request()->district_id ?? null }}';
            getDistrict(city_id,district_id);
        }
    });
</script>
<script>
    $(document).ready(function () {
        var gridView = true;
        var sort ;
        filter_data();
        $(document).on('click','#showGridView',function (e) {
            e.preventDefault();
            gridView = true;
            $(".ad-box-grid-view").show();
            $(".ad-box-list-view").hide();
        });
        $(document).on('click','#showListView',function (e) {
            e.preventDefault();
            gridView = false;
            $(".ad-box-grid-view").hide();
            $(".ad-box-list-view").show();
        });

        $(".selector").change(function () {
            filter_data();
        });
        $(".input-selector").keyup(function(){
            filter_data();
        });
        $('#reset-button').click(function() {
            $('#listingFilterForm')[0].reset();
            $(".select2").select2("val", "");
            filter_data();
        });

        $(document).on('click', '.dropdown-menu li a', function() {
            sort = $(this).attr('data-sort');
            filter_data(1,sort);
        });

        function filter_data(page = 1,sort = null) {
            var convenience   = $("#convenience" ).val();
            var city          = $("#city" ).select2("val");
            var district      = $("#district" ).select2("val");
            var property_type = $("input[name=property_type]:checked").val();
            var purpose       = $(".purpose:checked").val();
            var q             = $("#q").val();
            var min           = $("#min").val();
            var max           = $("#max").val();
            var url           = "{{ route('postSearch') }}";
            window.history.pushState({path:url},'',url);
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "post",
                url: url,
                data: {
                    'sort' : sort,
                    'purpose' : purpose,
                    'gridView' : gridView,
                    'page' : page,
                    'q': q,
                    'min': min,
                    'max': max,
                    'convenience': convenience,
                    'property_type': property_type,
                    'district_id': district,
                    'city_id': city,
                },
                beforeSend: function() {
                    $("#loaderListingIcon").show();
                },
                success: function (data) {
                    $(".filter-data").html(data);
                    $("#loaderListingIcon").hide();
                }
            });
        }
        $(document).on('click','.pagination a',function (e) {
            e.preventDefault();
            var page = $(this).attr("href").split("page=")[1];
            filter_data(page);
        });
    });
</script>
@endpush
