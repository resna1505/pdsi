@extends('layouts.master')
@section('title')
    {{-- @lang('translation.starter') --}}
    Iuran Anggota
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
                                    <button class="nav-link step-nav-tab {{ $currentStatus == 0 ? 'active' : '' }}" id="v-pills-bill-info-tab" data-bs-toggle="pill" data-bs-target="#v-pills-bill-info" type="button" role="tab" aria-controls="v-pills-bill-info" aria-selected="true" disabled>
                                        <span class="step-title me-2">
                                            <i class="ri-close-circle-fill step-icon me-2"></i> Step 1
                                        </span>
                                        Billing Info
                                    </button>
                                    <button class="nav-link step-nav-tab {{ $currentStatus == 1 ? 'active' : '' }}" id="v-pills-bill-address-tab" data-bs-toggle="pill" data-bs-target="#v-pills-bill-address" type="button" role="tab" aria-controls="v-pills-bill-address" aria-selected="false" disabled>
                                        <span class="step-title me-2">
                                            <i class="ri-close-circle-fill step-icon me-2"></i> Step 2
                                        </span>
                                        Payment
                                    </button>
                                    <button class="nav-link step-nav-tab {{ $currentStatus == 2 ? 'active' : '' }}" id="v-pills-payment-tab" data-bs-toggle="pill" data-bs-target="#v-pills-payment" type="button" role="tab" aria-controls="v-pills-payment" aria-selected="false" disabled>
                                        <span class="step-title me-2">
                                            <i class="ri-close-circle-fill step-icon me-2"></i> Step 3
                                        </span>
                                        Verification
                                    </button>
                                    <button class="nav-link step-nav-tab {{ $currentStatus == 3 ? 'active' : '' }}" id="v-pills-finish-tab" data-bs-toggle="pill" data-bs-target="#v-pills-finish" type="button" role="tab" aria-controls="v-pills-finish" aria-selected="false" disabled>
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
                                                <button type="button" class="btn btn-success btn-label right ms-auto nexttab nexttab" data-nexttab="v-pills-bill-address-tab" data-iuranid="{{ $anggotaId }}" id="goToPaymentBtn">
                                                    <i class="ri-arrow-right-line label-icon align-middle fs-16 ms-2"></i>
                                                    Go to Payment
                                                </button>
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
                                                <button type="button" class="btn btn-light btn-label previestab" 
                                                        data-previous="v-pills-bill-info-tab" 
                                                        data-status="0" 
                                                        data-anggota-id="{{ $anggotaId }}">
                                                    <i class="ri-arrow-left-line label-icon align-middle fs-16 me-2"></i> Back to Billing Info
                                                </button>
                                                <button type="button" class="btn btn-success btn-label right ms-auto nexttab nexttab" 
                                                        data-nexttab="v-pills-payment-tab"
                                                        data-status="2" 
                                                        data-anggota-id="{{ $anggotaId }}"
                                                        id="goToVerificationBtn">
                                                    <i class="ri-arrow-right-line label-icon align-middle fs-16 ms-2"></i>Go to Verification
                                                </button>
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
    
                                            {{-- <div class="d-flex align-items-start gap-3 mt-4">
                                                <button type="button" class="btn btn-light btn-label previestab" data-previous="v-pills-bill-address-tab"><i class="ri-arrow-left-line label-icon align-middle fs-16 me-2"></i> Back to Payment Info</button>
                                                <button type="button" class="btn btn-success btn-label right ms-auto nexttab nexttab" data-nexttab="v-pills-finish-tab"><i class="ri-arrow-right-line label-icon align-middle fs-16 ms-2"></i> Order Complete</button>
                                            </div> --}}
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
                                        <span class="text-danger">+ Rp 0</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between">
                                        <span>Total</span>
                                        <strong>Rp {{ number_format($total, 0, ',', '.') }}</strong>
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

// PENTING: Cegah klik manual step-tab - JANGAN BIARKAN STEP BISA DIKLIK
document.querySelectorAll('.step-nav-tab').forEach(function (tab) {
    tab.addEventListener('click', function (e) {
        e.preventDefault();
        e.stopPropagation();
        return false;
    });
    
    // Tambahan: hapus pointer cursor dan buat tidak bisa diklik
    tab.style.pointerEvents = 'none';
    tab.style.cursor = 'default';
    
    // Tambahkan class disabled untuk memastikan
    tab.classList.add('disabled');
});

// Fungsi untuk update status biasa
function updateStatus(anggotaId, status, callback) {
    fetch('{{ route("iuran.updateStatus") }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({
            anggota_id: anggotaId,
            status: status
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            console.log('Status berhasil diupdate ke:', status);
            if (callback) callback();
        } else {
            alert('Gagal mengupdate status: ' + data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Terjadi kesalahan saat mengupdate status');
    });
}

// Fungsi untuk upload bukti bayar dan update status
function updateStatusWithPayment(anggotaId, callback) {
    const fileInput = document.getElementById('formFile');
    const descriptionInput = document.getElementById('des-info-description-input');
    
    // Validasi file
    if (!fileInput.files.length) {
        alert('Silakan upload bukti bayar terlebih dahulu!');
        return;
    }

    const file = fileInput.files[0];
    const maxSize = 2 * 1024 * 1024; // 2MB
    const allowedTypes = ['image/jpeg', 'image/png', 'image/jpg', 'application/pdf'];

    if (file.size > maxSize) {
        alert('Ukuran file maksimal 2MB!');
        return;
    }

    if (!allowedTypes.includes(file.type)) {
        alert('Format file harus JPEG, PNG, JPG, atau PDF!');
        return;
    }

    const formData = new FormData();
    formData.append('anggota_id', anggotaId);
    formData.append('bukti_bayar', file);
    formData.append('description', descriptionInput.value);

    fetch('{{ route("iuran.updateStatusWithPayment") }}', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            console.log('Data pembayaran berhasil disimpan');
            alert('Bukti pembayaran berhasil diupload dan sedang diverifikasi!');
            if (callback) callback();
        } else {
            alert('Gagal menyimpan data: ' + data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Terjadi kesalahan saat menyimpan data');
    });
}

// Fungsi untuk navigasi tab - HANYA BISA DIPANGGIL MELALUI TOMBOL
function navigateToTab(targetTabId) {
    var targetTab = document.querySelector(`#${targetTabId}`);
    if (targetTab) {
        // Hapus class active dari semua tab dan content
        document.querySelectorAll('.step-nav-tab').forEach(t => {
            t.classList.remove('active');
            // Pastikan tetap disabled
            t.style.pointerEvents = 'none';
            t.style.cursor = 'default';
        });
        document.querySelectorAll('.tab-pane').forEach(p => p.classList.remove('show', 'active'));

        // Aktifkan HANYA tab tujuan (tetap tidak bisa diklik)
        targetTab.classList.add('active');
        targetTab.style.pointerEvents = 'none'; // Tetap tidak bisa diklik
        targetTab.style.cursor = 'default';
        
        const targetContent = document.querySelector(targetTab.dataset.bsTarget);
        if (targetContent) {
            targetContent.classList.add('show', 'active');
        }
    }
}

// Fungsi khusus untuk tombol Go to Payment
document.getElementById('goToPaymentBtn').addEventListener('click', function() {
    const anggotaId = this.dataset.iuranid;
    const nextTab = this.dataset.nexttab;
    
    // Update status ke 1, lalu navigasi
    updateStatus(anggotaId, 1, function() {
        navigateToTab(nextTab);
    });
});

// Fungsi khusus untuk tombol Go to Verification (DENGAN VALIDASI DAN UPLOAD)
document.getElementById('goToVerificationBtn').addEventListener('click', function() {
    const anggotaId = this.dataset.anggotaId;
    const nextTab = this.dataset.nexttab;
    
    // Upload bukti bayar dan update status ke 2, lalu navigasi
    updateStatusWithPayment(anggotaId, function() {
        navigateToTab(nextTab);
    });
});

// Fungsi untuk tombol Back to Billing Info
document.querySelector('[data-previous="v-pills-bill-info-tab"]').addEventListener('click', function() {
    const anggotaId = this.dataset.anggotaId;
    const prevTab = this.dataset.previous;
    
    // Update status ke 0, lalu navigasi
    updateStatus(anggotaId, 0, function() {
        navigateToTab(prevTab);
    });
});

// Fungsi untuk navigasi otomatis ke step berikutnya (untuk tombol lainnya yang tidak memerlukan update status)
document.querySelectorAll('.nexttab:not(#goToPaymentBtn):not(#goToVerificationBtn)').forEach(function (btn) {
    btn.addEventListener('click', function () {
        const nextTab = this.dataset.nexttab;
        navigateToTab(nextTab);
    });
});

// Fungsi untuk navigasi sebelumnya (untuk tombol yang tidak memerlukan update status)
document.querySelectorAll('.previestab:not([data-previous="v-pills-bill-info-tab"])').forEach(function (btn) {
    btn.addEventListener('click', function () {
        const prevTab = this.dataset.previous;
        navigateToTab(prevTab);
    });
});
    </script>
@endsection
