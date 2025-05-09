@extends('layouts.master')
@section('title')
    @lang('translation.starter')
@endsection
@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Pages
        @endslot
        @slot('title')
            Iuran Anggota
        @endslot
    @endcomponent
    
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body form-steps">
                    <form class="vertical-navs-step">
                        <div class="row gy-5">
                            <div class="col-lg-3">
                                <div class="nav flex-column custom-nav nav-pills" role="tablist" aria-orientation="vertical">
                                    <button class="nav-link step-nav-tab active" id="v-pills-bill-info-tab" data-bs-toggle="pill" data-bs-target="#v-pills-bill-info" type="button" role="tab" aria-controls="v-pills-bill-info" aria-selected="true" disabled>
                                        <span class="step-title me-2">
                                            <i class="ri-close-circle-fill step-icon me-2"></i> Step 1
                                        </span>
                                        Billing Info
                                    </button>
                                    <button class="nav-link step-nav-tab" id="v-pills-bill-address-tab" data-bs-toggle="pill" data-bs-target="#v-pills-bill-address" type="button" role="tab" aria-controls="v-pills-bill-address" aria-selected="false" disabled>
                                        <span class="step-title me-2">
                                            <i class="ri-close-circle-fill step-icon me-2"></i> Step 2
                                        </span>
                                        Payment
                                    </button>
                                    <button class="nav-link step-nav-tab" id="v-pills-payment-tab" data-bs-toggle="pill" data-bs-target="#v-pills-payment" type="button" role="tab" aria-controls="v-pills-payment" aria-selected="false" disabled>
                                        <span class="step-title me-2">
                                            <i class="ri-close-circle-fill step-icon me-2"></i> Step 3
                                        </span>
                                        Verification
                                    </button>
                                    <button class="nav-link step-nav-tab" id="v-pills-finish-tab" data-bs-toggle="pill" data-bs-target="#v-pills-finish" type="button" role="tab" aria-controls="v-pills-finish" aria-selected="false" disabled>
                                        <span class="step-title me-2">
                                            <i class="ri-close-circle-fill step-icon me-2"></i> Step 4
                                        </span>
                                        Finish
                                    </button>
                                </div>
                                <!-- end nav -->
                            </div> <!-- end col-->
                            <div class="col-lg-6">
                                <div class="px-lg-4">
                                    <div class="tab-content">
                                        <div class="tab-pane fade show active" id="v-pills-bill-info" role="tabpanel" aria-labelledby="v-pills-bill-info-tab">
                                            <div>
                                                <h5>Billing Info</h5>
                                                <p class="text-muted">Fill all information below</p>
                                            </div>
    
                                            <ul class="list-group mb-3">
                                                <ul class="list-group mb-3">
                                                    @php $total = 0; @endphp
                                                    @foreach($iurans as $iuran)
                                                        <li class="list-group-item d-flex justify-content-between lh-sm">
                                                            <div>
                                                                <h6 class="my-0">{{ $iuran->masterIuran->nama_iuran }}</h6>
                                                                <small class="text-muted">{{ \Carbon\Carbon::parse($iuran->masterIuran->periode)->translatedFormat('F Y') }}</small>
                                                            </div>
                                                            <span class="text-muted">Rp {{ number_format($iuran->masterIuran->jumlah, 0, ',', '.') }}</span>
                                                        </li>
                                                        @php $total += $iuran->masterIuran->jumlah; @endphp
                                                    @endforeach
                                                </ul>
                                            </ul>
    
                                            <div class="d-flex align-items-start gap-3 mt-4">
                                                <button type="button" class="btn btn-success btn-label right ms-auto nexttab nexttab" data-nexttab="v-pills-bill-address-tab" data-iuranid="{{ $anggota->id }}" id="goToPaymentBtn">
                                                    <i class="ri-arrow-right-line label-icon align-middle fs-16 ms-2"></i>
                                                    Go to Payment
                                                </button>
                                                {{-- <button 
                                                    type="button" 
                                                    class="btn btn-success btn-label right ms-auto nexttab nexttab" 
                                                    data-iuranid="{{ $anggota->id }}" 
                                                    id="goToPaymentBtn">
                                                    <i class="ri-arrow-right-line label-icon align-middle fs-16 ms-2"></i>
                                                    Go to Payment
                                                </button> --}}
                                            </div>
                                        </div>
                                        <!-- end tab pane -->
                                        <div class="tab-pane fade" id="v-pills-bill-address" role="tabpanel" aria-labelledby="v-pills-bill-address-tab">
                                            <div>
                                                <h5>Payment</h5>
                                                <p class="text-muted">Fill all information below</p>
                                            </div>
    
                                            <div>
                                                <div class="row g-3">
                                                    <div class="col-12">
                                                        <label for="address" class="form-label">LEMBAGA PENDIDIKAN D</label>
                                                        <div>
                                                            <img src="{{ URL::asset('build/images/brands/mandiri.png') }}" height="80" alt="facebook">
                                                        </div>
                                                    </div>
                                                    <div class="col-12 position-relative">
                                                        <label class="form-check-label">No Rekening</label>      
                                                    
                                                        <p id="noRek" class="form-label fs-4 mb-0">1010099890889</p>
                                                    
                                                        <!-- Tombol ikon copy di pojok kanan -->
                                                        <button onclick="copyRekening()" 
                                                                class="btn btn-sm btn-outline-secondary position-absolute top-0 end-0 mt-1 me-1" 
                                                                title="Copy">
                                                            <i class="bi bi-clipboard"></i>
                                                        </button>
                                                    </div>

                                                    <div class="col-12">
                                                        <label for="country" class="form-label">Address</label>
                                                        <p class="form-label">Towe Vinsky Jl. Ciputat Raya No 22A RT 000 RW 000 Kebayoran Lama Pondok Pinang JAKARTA SELATAN 12310</p>
                                                    </div>

                                                    <div class="col-12">
                                                        <label for="formFile" class="form-label">Upload Bukti Bayar *</label>
                                                        <input class="form-control" type="file" id="formFile">
                                                    </div>
                                                    <div class="col-12">
                                                        <label class="form-label" for="des-info-description-input">Description</label>
                                                        <textarea class="form-control" placeholder="Enter Description" id="des-info-description-input" rows="3"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-start gap-3 mt-4">
                                                <button type="button" class="btn btn-light btn-label previestab" data-previous="v-pills-bill-info-tab"><i class="ri-arrow-left-line label-icon align-middle fs-16 me-2"></i> Back to Billing Info</button>
                                                <button type="button" class="btn btn-success btn-label right ms-auto nexttab nexttab" data-nexttab="v-pills-payment-tab"><i class="ri-arrow-right-line label-icon align-middle fs-16 ms-2"></i>Go to Verification</button>
                                            </div>
                                        </div>
                                        <!-- end tab pane -->
                                        <div class="tab-pane fade" id="v-pills-payment" role="tabpanel" aria-labelledby="v-pills-payment-tab">
                                            <div class="text-center pt-4 pb-2">
                                                <div class="mb-4">
                                                    <lord-icon
                                                      src="https://cdn.lordicon.com/egmlnyku.json"
                                                      trigger="loop"
                                                      colors="primary:#0ab39c,secondary:#405189"
                                                      style="width:120px;height:120px">
                                                    </lord-icon>
                                                  </div>
                                                  <h5>Verification in Progress</h5>
                                                  <p class="text-muted">Your proof of payment is being verified. Please wait.</p>                                                  
                                            </div>
    
                                            <div class="d-flex align-items-start gap-3 mt-4">
                                                <button type="button" class="btn btn-light btn-label previestab" data-previous="v-pills-bill-address-tab"><i class="ri-arrow-left-line label-icon align-middle fs-16 me-2"></i> Back to Payment Info</button>
                                                <button type="button" class="btn btn-success btn-label right ms-auto nexttab nexttab" data-nexttab="v-pills-finish-tab"><i class="ri-arrow-right-line label-icon align-middle fs-16 ms-2"></i> Order Complete</button>
                                            </div>
                                        </div>
                                        <!-- end tab pane -->
                                        <div class="tab-pane fade" id="v-pills-finish" role="tabpanel" aria-labelledby="v-pills-finish-tab">
                                            <div class="text-center pt-4 pb-2">
    
                                                <div class="mb-4">
                                                    <lord-icon src="https://cdn.lordicon.com/lupuorrc.json" trigger="loop" colors="primary:#0ab39c,secondary:#405189" style="width:120px;height:120px"></lord-icon>
                                                </div>
                                                <h5>Your Order is Completed !</h5>
                                                <p class="text-muted">You Will receive an order confirmation email with details of your order.</p>
                                            </div>
                                        </div>
                                        <!-- end tab pane -->
                                    </div>
                                    <!-- end tab content -->
                                </div>
                            </div>
                            <!-- end col -->
    
                            <div class="col-lg-3">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h5 class="fs-14 text-primary mb-0"><i class="ri-shopping-cart-fill align-middle me-2"></i> Your cart</h5>
                                    <span class="badge bg-danger rounded-pill">3</span>
                                </div>
                                <ul class="list-group mb-3">
                                    <li class="list-group-item d-flex justify-content-between bg-light">
                                        <div class="text-success">
                                            <h6 class="my-0">Denda</h6>
                                            <small>Telat bayar iuran</small>
                                        </div>
                                        <span class="text-danger">+ Rp 25.000</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between">
                                        <span>Total</span>
                                        <strong>Rp {{ number_format($total + 25000, 0, ',', '.') }}</strong>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <!-- end row -->
                    </form>
                </div>
            </div>
            <!-- end -->
        </div>
        <!-- end col -->
    </div>

@endsection
@section('script')
    <script src="{{ URL::asset('build/libs/tom-select/js/tom-select.base.min.js') }}"></script>
    {{-- <script src="{{ URL::asset('build/js/pages/form-wizard.init.js') }}"></script> --}}
    <script src="{{ URL::asset('build/js/app.js') }}"></script>

    
    <script>
        function copyRekening() {
            // Ambil isi dari elemen dengan id noRek
            var copyText = document.getElementById("noRek").innerText;
            
            // Gunakan clipboard API
            navigator.clipboard.writeText(copyText).then(function() {
                alert("Nomor rekening berhasil disalin: " + copyText);
            }, function(err) {
                alert("Gagal menyalin");
            });
        }
        
        // Cegah klik manual step-tab
        document.querySelectorAll('.step-nav-tab').forEach(function (tab) {
            tab.addEventListener('click', function (e) {
                e.preventDefault();
            });
        });
    
        // Fungsi untuk navigasi otomatis ke step berikutnya
        document.querySelectorAll('.nexttab').forEach(function (btn) {
            btn.addEventListener('click', function () {
                var nextTab = document.querySelector(`#${this.dataset.nexttab}`);
                if (nextTab) {
                    // Hapus class active dari semua
                    document.querySelectorAll('.step-nav-tab').forEach(t => t.classList.remove('active'));
                    document.querySelectorAll('.tab-pane').forEach(p => p.classList.remove('show', 'active'));
    
                    // Aktifkan tab tujuan
                    nextTab.classList.add('active');
                    const targetContent = document.querySelector(nextTab.dataset.bsTarget);
                    targetContent.classList.add('show', 'active');
                }
            });
        });
    
        // Fungsi untuk navigasi sebelumnya (opsional)
        document.querySelectorAll('.previestab').forEach(function (btn) {
            btn.addEventListener('click', function () {
                var prevTab = document.querySelector(`#${this.dataset.previous}`);
                if (prevTab) {
                    // Hapus class active dari semua
                    document.querySelectorAll('.step-nav-tab').forEach(t => t.classList.remove('active'));
                    document.querySelectorAll('.tab-pane').forEach(p => p.classList.remove('show', 'active'));
    
                    // Aktifkan tab tujuan
                    prevTab.classList.add('active');
                    const targetContent = document.querySelector(prevTab.dataset.bsTarget);
                    targetContent.classList.add('show', 'active');
                }
            });
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            let currentStatus = {{ $currentStatus }};
            let steps = [
                'v-pills-bill-info-tab',
                'v-pills-bill-address-tab',
                'v-pills-payment-tab',
                'v-pills-finish-tab'
            ];
    
            let contents = [
                'v-pills-bill-info',
                'v-pills-bill-address',
                'v-pills-payment',
                'v-pills-finish'
            ];
    
            // Aktifkan tab sesuai status
            for (let i = 0; i <= currentStatus; i++) {
                document.getElementById(steps[i]).disabled = false;
            }
    
            // Trigger tab yang sesuai status
            document.getElementById(steps[currentStatus]).click();
    
            // Tambah class 'active show' ke tab-pane
            contents.forEach(id => document.getElementById(id).classList.remove('active', 'show'));
            document.getElementById(contents[currentStatus]).classList.add('active', 'show');
        });
    </script>
    {{-- <script>
        document.getElementById("goToPaymentBtn").addEventListener("click", function () {
            var anggotaId = this.getAttribute("data-iuranid");  // Mengambil data-iuranid
            console.log(anggotaId); // Cek apakah nilai data-iuranid sudah benar

            // Mengirimkan data ke server menggunakan fetch
            fetch('/iuran/update-status/' + anggotaId, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ anggota_id: anggotaId })
            })

            .then(response => response.json())  // Mengonversi respons menjadi JSON
            .then(data => {
                console.log("Status updated:", data); // Menampilkan pesan dari server
                // Lanjutkan ke tab berikutnya
                document.querySelector(`[data-nexttab="v-pills-bill-address-tab"]`).click();
            })
            .catch(error => {
                console.error('Error:', error); // Menangani error jika terjadi masalah saat fetch
            });
        });
    </script> --}}
@endsection
