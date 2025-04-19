@extends('layouts.master')
@section('title')
    @lang('translation.starter')
@endsection
@section('content')
    <div class="row g-3">
        <div class="mb-4">
            <h2 class="fw-bold d-flex align-items-center">
                <i class="ri-graduation-cap-line me-2 text-primary fs-3"></i> Pelatihan
            </h2>
            <p class="text-muted mb-0">Temukan pelatihan terbaru untuk meningkatkan kompetensimu.</p>
        </div>
        
        <div class="row justify-content-start mb-4">
            <div class="col-md-5">
                <div class="position-relative flex-grow-1">
                    <input type="text" id="searchInput" class="form-control pe-5" placeholder="Search ...">
                    <a class="btn btn-link link-secondary position-absolute end-0 top-50 translate-middle-y me-2">
                        <i class="ri-search-2-line"></i>
                    </a>
                </div>
            </div>
        </div>
        
        <div class="col-xl-4 col-md-6 col-sm-12 mb-4 training-card">
            <div class="card d-flex flex-column">
                <img class="card-img-top img-fluid" style="height: 200px;object-fit: cover; object-position: center;" src="{{ URL::asset('build/images/small/seminar.jpeg') }}" alt="Card image cap" />
                <div class="card-body d-flex flex-column justify-content-between">
                    <div>
                        <h3 class="fw-bold text-black">Peningkatan Kompetensi Dokter Umum dalam Pelayanan Primer</h3>
                        <p class="text-muted fs-18">Rp. 269,000</p>
                    </div>
        
                    <!-- RATING DI BAGIAN BAWAH -->
                    <div class="d-flex align-items-center justify-content-start gap-2 mt-auto">
                        <div class="rater" dir="ltr"></div>
                        <span class="text-muted">(78)</span>
                    </div>
                </div>
        
                <div class="card-footer">
                    <p class="card-text">
                        <small class="text-muted">
                            <i class="ri-calendar-event-line me-1"></i> Sabtu, 12 April 2025 • 09:00 WIB
                        </small>
                    </p>
                </div>
            </div>
        </div>
        
        <!--end col-->
        <div class="col-xl-4 col-md-6 col-sm-12 mb-4 training-card">
            <div class="card d-flex flex-column">
                <img class="card-img-top img-fluid" style="height: 200px;object-fit: cover; object-position: center;" src="{{ URL::asset('build/images/small/seminar2.jpeg') }}" alt="Card image cap" />
                <div class="card-body d-flex flex-column justify-content-between">
                    <div>
                        <h3 class="fw-bold text-black">Endocrinology Today: Tantangan Diabetes Modern</h3>
                        <p class="text-muted fs-18">Rp. 89,000</p>
                    </div>
        
                    <!-- RATING DI BAGIAN BAWAH -->
                    <div class="d-flex align-items-center justify-content-start gap-2 mt-auto">
                        <div class="rater" dir="ltr"></div>
                        <span class="text-muted">(321)</span>
                    </div>
                </div>
        
                <div class="card-footer">
                    <p class="card-text">
                        <small class="text-muted">
                            <i class="ri-calendar-event-line me-1"></i> Sabtu, 26 April 2025 • 12:00 WIB
                        </small>
                    </p>
                </div>
            </div>
        </div>
        <!--end col-->
        <div class="col-xl-4 col-md-6 col-sm-12 mb-4 training-card">
            <div class="card d-flex flex-column">
                <img class="card-img-top img-fluid" style="height: 200px;object-fit: cover; object-position: center;" src="{{ URL::asset('build/images/small/seminar3.jpeg') }}" alt="Card image cap" />
                <div class="card-body d-flex flex-column justify-content-between">
                    <div>
                        <h3 class="fw-bold text-black">Pediatrics Forum: Gizi, Vaksinasi & Tumbuh Kembang</h3>
                        <p class="text-muted fs-18">Rp. 169,000</p>
                    </div>
        
                    <!-- RATING DI BAGIAN BAWAH -->
                    <div class="d-flex align-items-center justify-content-start gap-2 mt-auto">
                        <div class="rater" dir="ltr"></div>
                        <span class="text-muted">(192)</span>
                    </div>
                </div>
        
                <div class="card-footer">
                    <p class="card-text">
                        <small class="text-muted">
                            <i class="ri-calendar-event-line me-1"></i> Kamis, 1 Mei 2025 • 08:30 WIB
                        </small>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-md-6 col-sm-12 mb-4 training-card">
            <div class="card d-flex flex-column">
                <img class="card-img-top img-fluid" style="height: 200px;object-fit: cover; object-position: center;" src="{{ URL::asset('build/images/small/seminar4.jpeg') }}" alt="Card image cap" />
                <div class="card-body d-flex flex-column justify-content-between">
                    <div>
                        <h3 class="fw-bold text-black">Innovative Surgery Techniques & Future Tools</h3>
                        <p class="text-muted fs-18">Rp. 169,000</p>
                    </div>
        
                    <!-- RATING DI BAGIAN BAWAH -->
                    <div class="d-flex align-items-center justify-content-start gap-2 mt-auto">
                        <div class="rater" dir="ltr"></div>
                        <span class="text-muted">(258)</span>
                    </div>
                </div>
        
                <div class="card-footer">
                    <p class="card-text">
                        <small class="text-muted">
                            <i class="ri-calendar-event-line me-1"></i> Jumat, 2 Mei 2025 • 09:30 WIB
                        </small>
                    </p>
                </div>
            </div>
        </div>
        
    </div>
    
@endsection
@section('script')
    <script src="{{ URL::asset('build/libs/tom-select/js/tom-select.base.min.js') }}"></script>
    <script src="{{ URL::asset('build/js/app.js') }}"></script>
    <script src="{{ URL::asset('build/libs/prismjs/prism.js') }}"></script>
    {{-- <script src="{{ URL::asset('build/libs/rater-js/index.js') }}"></script> --}}
    <script src="{{ URL::asset('build/js/pages/rating.init.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/rater-js@1.0.0/index.min.js"></script>
    <script>
        document.querySelectorAll('.rater').forEach((el) => {
            const rater = raterJs({
                element: el,
                starSize: 20,
                rateCallback: function (rating, done) {
                    console.log('Rating:', rating);
                    done();
                }
            });

            rater.setRating(5);
            rater.disable();
        });

        const searchInput = document.getElementById('searchInput');
        const cards = document.querySelectorAll('.training-card');
    
        searchInput.addEventListener('input', function () {
            const query = this.value.toLowerCase();
    
            cards.forEach(card => {
                const title = card.querySelector('h3').innerText.toLowerCase();
                card.style.display = title.includes(query) ? 'block' : 'none';
            });
        });
    </script>
@endsection
