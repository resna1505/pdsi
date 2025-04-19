@extends('layouts.master')
@section('title')
@lang('translation.faqs')
@endsection
@section('content')

<div class="row mt-n1">
    <div class="col-lg-12">
        <div class="card rounded-0 bg-light mx-n4 mt-n4 border-0 shadow-none border-top">
            <div class="card-body px-4 py-5">
                <div class="row justify-content-center">
                    <div class="col-xxl-5 align-self-center">
                        <div class="text-center py-4">
                            <h2 class="mb-3">Frequently Asked Questions</h2>
                            <p class="text-muted fs-15 mb-0">If you can not find answer to your question in our FAQ, you can always contact us or email us. We will answer you shortly!</p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end card body -->
        </div>
        <!-- end card -->
    </div>
    <!--end col-->
</div>
<!--end row-->

<div class="row gy-4">
    <div class="col-xxl-4 col-lg-6">
        <div>
            @foreach ($categories->where('id', 1) as $category)
                <div class="mb-3">
                    <h5 class="fs-16 mb-0 fw-semibold">{{ $category->name }}</h5>
                </div>

                <div class="accordion accordion-border-box mb-4" id="accordion-{{ $category->id }}">
                    @foreach ($category->items as $index => $item)
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="heading-{{ $item->id }}">
                                <button class="accordion-button {{ $index !== 0 ? 'collapsed' : '' }}" type="button"
                                        data-bs-toggle="collapse"
                                        data-bs-target="#collapse-{{ $item->id }}"
                                        aria-expanded="{{ $index === 0 ? 'true' : 'false' }}"
                                        aria-controls="collapse-{{ $item->id }}">
                                    {{ $item->question }}
                                </button>
                            </h2>
                            <div id="collapse-{{ $item->id }}"
                                class="accordion-collapse collapse {{ $index === 0 ? 'show' : '' }}"
                                aria-labelledby="heading-{{ $item->id }}"
                                data-bs-parent="#accordion-{{ $category->id }}">
                                <div class="accordion-body">
                                    {!! $item->answer !!}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endforeach
            <!--end accordion-->
        </div>
    </div>
    <!--end col-->

    <div class="col-xxl-4 col-lg-6">
        <div>
            @foreach ($categories->where('id', 2) as $category)
                <div class="mb-3">
                    <h5 class="fs-16 mb-0 fw-semibold">{{ $category->name }}</h5>
                </div>

                <div class="accordion accordion-border-box mb-4" id="accordion-{{ $category->id }}">
                    @foreach ($category->items as $index => $item)
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="heading-{{ $item->id }}">
                                <button class="accordion-button {{ $index !== 0 ? 'collapsed' : '' }}" type="button"
                                        data-bs-toggle="collapse"
                                        data-bs-target="#collapse-{{ $item->id }}"
                                        aria-expanded="{{ $index === 0 ? 'true' : 'false' }}"
                                        aria-controls="collapse-{{ $item->id }}">
                                    {{ $item->question }}
                                </button>
                            </h2>
                            <div id="collapse-{{ $item->id }}"
                                class="accordion-collapse collapse {{ $index === 0 ? 'show' : '' }}"
                                aria-labelledby="heading-{{ $item->id }}"
                                data-bs-parent="#accordion-{{ $category->id }}">
                                <div class="accordion-body">
                                    {!! $item->answer !!}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endforeach
            <!--end accordion-->
        </div>
    </div>
    <!--end col-->

    <div class="col-xxl-4 col-lg-6 align-self-center">
        <div class="text-center">
            <div class="mb-4">
                <img src="{{ URL::asset('build/images/faq.png') }}" alt="" height="200">
            </div>
            <h4>Any Questions ?</h4>
            <p class="text-muted mb-4">You can ask anything you want to know about Feedback.</p>
            <div class="hstack flex-wrap gap-2 justify-content-center">
                <button type="button" class="btn btn-primary btn-label rounded-pill"><i class="ri-mail-line label-icon align-middle rounded-pill fs-16"></i> Email Us</button>
            </div>
        </div>
    </div>
    <!--end col-->

    <div class="col-xxl-12 col-lg-6">
        <div>
            @foreach ($categories->where('id', 3) as $category)
                <div class="mb-3">
                    <h5 class="fs-16 mb-0 fw-semibold">{{ $category->name }}</h5>
                </div>

                <div class="accordion accordion-border-box mb-4" id="accordion-{{ $category->id }}">
                    @foreach ($category->items as $index => $item)
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="heading-{{ $item->id }}">
                                <button class="accordion-button {{ $index !== 0 ? 'collapsed' : '' }}" type="button"
                                        data-bs-toggle="collapse"
                                        data-bs-target="#collapse-{{ $item->id }}"
                                        aria-expanded="{{ $index === 0 ? 'true' : 'false' }}"
                                        aria-controls="collapse-{{ $item->id }}">
                                    {{ $item->question }}
                                </button>
                            </h2>
                            <div id="collapse-{{ $item->id }}"
                                class="accordion-collapse collapse {{ $index === 0 ? 'show' : '' }}"
                                aria-labelledby="heading-{{ $item->id }}"
                                data-bs-parent="#accordion-{{ $category->id }}">
                                <div class="accordion-body">
                                    {!! $item->answer !!}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endforeach
        </div>
    </div>
</div>
<!--end row-->
@endsection
@section('script')
<script src="{{ URL::asset('build/js/app.js') }}"></script>
@endsection
