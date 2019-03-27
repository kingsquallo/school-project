@extends('frontend.master')
@section('content')
<div class="container">
    <div id="wrapper">
        @include('frontend.partial._sidebar')
        <div class="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header"> Profile edit </h1>
                </div> <!-- /.col-lg-12 -->
            </div> <!-- /.row -->
            <div class="row">
                <div class="col-xs-12">
                    <form method="POST" action="{{ route('profile.update') }}" accept-charset="UTF-8"
                        class="form-horizontal" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group ">
                            <label for="name" class="col-sm-2 control-label">Name</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="name" value="{{ Auth::user()->name }}"
                                    name="name" placeholder="Name">
                            </div>
                        </div>
                        <div class="form-group ">
                            <label for="email" class="col-sm-2 control-label">Email</label>
                            <div class="col-sm-8">
                                <input type="email" class="form-control" disabled id="email"
                                    value="{{ Auth::user()->email }}" name="email" placeholder="Email">
                            </div>
                        </div>

                        <div class="form-group ">
                            <label for="phone" class="col-sm-2 control-label">Phone</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="phone" value="{{ Auth::user()->phone }}"
                                    name="phone" placeholder="Phone">
                            </div>
                        </div>

                        <div class="form-group ">
                            <label for="address" class="col-sm-2 control-label">Address</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="address" value="{{ Auth::user()->address }}"
                                    name="address" placeholder="Address">
                            </div>
                        </div>
                        <hr>
                        <div class="form-group">
                            <div class="col-sm-offset-8">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>
</div>
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('layout\frontend\css\admin.css') }}">
<link rel="stylesheet" href="{{ asset('layout\frontend\plugins\metisMenu\dist\metisMenu.min.css') }}">
@endsection
@section('js')
<script src="{{ asset('layout\frontend\plugins\metisMenu\dist\metisMenu.min.js') }}"></script>
<script>
    $(function () {
        $('#side-menu').metisMenu();
    });

</script>
@endsection
