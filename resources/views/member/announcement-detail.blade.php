@extends('layouts.master')

@section('title')
    @lang('translation.detail_article')
@endsection

@section('content')
    @component('components.breadcrumb')
        @slot('li_1') Pengumuman @endslot
        @slot('title') Detail Berita @endslot
    @endcomponent

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12">

                {{-- Video --}}
                <div class="mb-4 ratio ratio-16x9 rounded shadow-sm overflow-hidden">
                    <img src="{{ asset('storage/articles/' . $article->attachment) }}" alt="alt" class="rounded" />
                </div>

                {{-- Judul --}}
                <h2 class="fw-bold mb-3">
                    {{ $article->title }}
                </h2>

                <div class="text-muted d-flex align-items-center mb-4" style="font-size: 0.9rem;">
                    <i class="ri-user-line me-2"></i> {{ $article->author }}
                    <span class="mx-3">•</span>
                    <i class="ph-clock-bold me-2"></i> {{ $article->created_at->translatedFormat('d F Y') }}
                </div>

                <div class="mb-4" style="font-size: 1.05rem; line-height: 1.7;">
                    {!! $article->description !!}
                </div>                

                @if ($article->attachment)
                    <div class="alert alert-light border d-flex align-items-center justify-content-between p-3 rounded-3">
                        <div>
                            <i class="ri-attachment-2 me-2"></i>
                            <strong>Lampiran:</strong> {{ basename($article->attachment) }}
                        </div>
                        <a href="{{ asset('storage/articles/' . $article->attachment) }}" 
                            class="btn btn-sm btn-outline-primary" 
                            download="{{ basename($article->attachment) }}">
                             <i class="ri-download-2-line me-1"></i> Unduh
                         </a>
                    </div>
                @endif

            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ URL::asset('build/libs/tom-select/js/tom-select.base.min.js') }}"></script>
    <script src="{{ URL::asset('build/js/app.js') }}"></script>
@endsection
