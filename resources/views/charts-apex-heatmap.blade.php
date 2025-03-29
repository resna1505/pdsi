@extends('layouts.master-components')
@section('title')
@lang('translation.Apex_Heatmap_Chart')
@endsection
@section('content')
@component('components.breadcrumb')
@slot('li_1')
Apexcharts
@endslot
@slot('title')
Heatmap Charts
@endslot
@endcomponent
<div class="row">
    <div class="col-xl-6">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-0">Basic Heatmap Chart</h4>
            </div><!-- end card header -->

            <div class="card-body">
                <div class="live-preview">
                    <div id="basic_heatmap" data-colors='["--tb-success", "--tb-card-bg-custom"]' class="apex-charts" dir="ltr"></div>
                </div>
            </div><!-- end card-body -->
        </div><!-- end card -->
    </div>
    <!-- end col -->
    <div class="col-xl-6">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-0">Heatmap - Multiple Series</h4>
            </div><!-- end card header -->

            <div class="card-body">
                <div id="multiple_heatmap" data-colors='["--tb-primary", "--tb-secondary", "--tb-success", "--tb-info", "--tb-warning", "--tb-danger", "--tb-dark", "--tb-primary", "--tb-card-bg-custom"]' class="apex-charts" dir="ltr"></div>
            </div><!-- end card-body -->
        </div><!-- end card -->
    </div>
    <!-- end col -->
</div>
<!-- end row -->

<div class="row">
    <div class="col-xl-6">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-0">Heatmap Color Range</h4>
            </div><!-- end card header -->

            <div class="card-body">
                <div id="color_heatmap" data-colors='["--tb-info", "--tb-success", "--tb-primary", "--tb-warning"]' class="apex-charts" dir="ltr"></div>
            </div><!-- end card-body -->
        </div><!-- end card -->
    </div>
    <!-- end col -->
    <div class="col-xl-6">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-0">Heatmap - Range Without Shades</h4>
            </div><!-- end card header -->

            <div class="card-body">
                <div id="shades_heatmap" data-colors='["--tb-info", "--tb-primary"]' class="apex-charts" dir="ltr"></div>
            </div><!-- end card-body -->
        </div><!-- end card -->
    </div>
    <!-- end col -->
</div>
<!-- end row -->

@endsection
@section('script')
<script src="{{ URL::asset('build/libs/apexcharts/apexcharts.min.js') }}"></script>
<script src="{{ URL::asset('build/js/pages/apexcharts-heatmap.init.js') }}"></script>
<script src="{{ URL::asset('build/js/app.js') }}"></script>
@endsection
