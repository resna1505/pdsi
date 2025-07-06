@extends('layouts.master')
@section('title')
@lang('translation.dashboards')
@endsection
@section('css')
<link href="{{ URL::asset('build/libs/jsvectormap/jsvectormap.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('build/libs/swiper/swiper-bundle.min.css')}}" rel="stylesheet" type="text/css" />
@endsection
@section('content')


<div class="row">
    <div class="col">
        <div class="row">
            <!-- Card Pembayaran Sukses -->
            <div class="col-xxl-3 col-md-6">
                <div class="card card-animate card-height-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <p class="fw-medium text-muted mb-0">Pembayaran Sukses</p>
                                <h2 class="mt-4 fw-semibold">
                                    <span class="counter-value" data-target="{{ $data['totalPembayaran'] }}">{{ $data['totalPembayaran'] }}</span>
                                </h2>
                                <p class="mb-0 text-muted">
                                    <span class="badge bg-light text-{{ $data['statusTrendSukses'] }} mb-0">
                                        <i class="{{ $data['trendIconSukses'] }} align-middle"></i> 
                                        {{ $data['persentaseSukses'] }}%
                                    </span> 
                                    dibanding periode yang sama tahun lalu
                                </p>
                                <small class="text-muted">Periode: Januari - {{ $data['currentMonth'] }} {{ $data['currentYear'] }}</small>
                            </div>
                            <div>
                                <div class="avatar-sm flex-shrink-0">
                                    <span class="avatar-title bg-success-subtle text-success rounded-circle fs-2">
                                        <i class="ph-check-square-offset"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div><!-- end card body -->
                </div>
            </div>

            <!-- Card Gagal Bayar Iuran -->
            <div class="col-xxl-3 col-md-6">
                <div class="card card-animate card-height-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <p class="fw-medium text-muted mb-0">Gagal Bayar Iuran</p>
                                <h2 class="mt-4 fw-semibold">
                                    <span class="counter-value" data-target="{{ $data['totalGagalBayar'] }}">{{ $data['totalGagalBayar'] }}</span>
                                </h2>
                                <p class="mb-0 text-muted">
                                    <span class="badge bg-light text-{{ $data['statusTrendGagal'] }} mb-0">
                                        <i class="{{ $data['trendIconGagal'] }} align-middle"></i> 
                                        {{ $data['persentaseGagal'] }}%
                                    </span> 
                                    dibanding periode yang sama tahun lalu
                                </p>
                                <small class="text-muted">Periode: Januari - {{ $data['currentMonth'] }} {{ $data['currentYear'] }}</small>
                            </div>
                            <div>
                                <div class="avatar-sm flex-shrink-0">
                                    <span class="avatar-title bg-danger-subtle text-danger rounded-circle fs-2">
                                        <i class="ph-warning"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div><!-- end card body -->
                </div>
            </div>
            <!--end col-->
            <div class="col-xxl-3 col-md-6">
                <div class="card card-height-100">
                    <div class="card-body">
                        <h5 class="card-title mb-3">Progress SKP</h5>
                        <div class="progress animated-progress custom-progress mb-1">
                            <div class="progress-bar" role="progressbar" style="width: 38%" aria-valuenow="38" aria-valuemin="0"
                                aria-valuemax="100"></div>
                        </div>
                        <p class="text-muted mb-2">You used 40 of 100 of your SKP</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
        <!-- end row -->

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header d-flex align-items-center">
                    <h5 class="card-title flex-grow-1 mb-0">Agenda Kegiatan</h5>
                    <div class="d-flex gap-1 flex-wrap">
                        <button class="btn btn-soft-primary" onclick="window.location.reload()">
                            <i class="ri-refresh-line"></i> Refresh
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    {{-- INFO: Total data yang diterima dari backend --}}
                    <div class="mb-3">
                        <small class="text-muted">
                            <i class="ri-information-line"></i> 
                            Menampilkan {{ $agendaData->firstItem() ?? 0 }} - {{ $agendaData->lastItem() ?? 0 }} dari {{ $agendaData->total() }} data
                        </small>
                    </div>

                    <div class="table-responsive table-card">
                        <table class="table align-middle table-nowrap mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Nama Kegiatan</th>
                                    <th>Kategori</th>
                                    <th>Tanggal</th>
                                    <th>Lokasi</th>
                                    <th>SKP</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- PASTIKAN DATA INI DARI BACKEND, BUKAN HARDCODED --}}
                                @if($agendaData->count() > 0)
                                    @foreach($agendaData as $index => $agenda)
                                    <tr>
                                        <td>
                                            <strong>{{ $agenda->title ?? 'Tidak ada judul' }}</strong>
                                            <br><small class="text-muted">{{ $agenda->source_type ?? 'Unknown' }} #{{ $agenda->source_id ?? 0 }}</small>
                                        </td>
                                        <td>
                                            <span class="badge bg-primary-subtle text-primary">{{ $agenda->category ?? 'Tidak ada kategori' }}</span>
                                        </td>
                                        <td>{{ $agenda->tanggal ?? 'Tanggal tidak tersedia' }}</td>
                                        <td>{{ $agenda->lokasi ?? '-' }}</td>
                                        <td>{{ $agenda->skp ?? 0 }}</td>
                                        <td>
                                            <span class="badge {{ $agenda->status_class ?? 'bg-secondary' }}">
                                                {{ $agenda->status ?? 'Unknown' }}
                                            </span>
                                        </td>
                                        <td>
                                            @if(isset($agenda->action_button))
                                                <a href="{{ $agenda->action_button['url'] ?? '#' }}" 
                                                   class="{{ $agenda->action_button['class'] ?? 'btn btn-sm btn-secondary' }}">
                                                    {{ $agenda->action_button['text'] ?? 'Aksi' }}
                                                </a>
                                            @else
                                                <button class="btn btn-sm btn-secondary" disabled>Tidak ada aksi</button>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                @else
                                    {{-- Jika tidak ada data dari backend --}}
                                    <tr>
                                        <td colspan="7" class="text-center py-5">
                                            <div class="empty-state">
                                                <i class="ri-calendar-line" style="font-size: 48px; color: #ccc;"></i>
                                                <h5 class="mt-3 text-muted">Tidak Ada Data Agenda</h5>
                                                <p class="text-muted">
                                                    Tidak ada data agenda dari database.<br>
                                                    <small>Query mungkin tidak mengembalikan data atau terjadi error.</small>
                                                </p>
                                                <button class="btn btn-outline-primary" onclick="window.location.reload()">
                                                    <i class="ri-refresh-line"></i> Coba Lagi
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>

                    {{-- Pagination --}}
                    @if($agendaData->hasPages())
                    <div class="d-flex justify-content-between align-items-center mt-4">
                        <div class="text-muted small">
                            Menampilkan {{ $agendaData->firstItem() }} - {{ $agendaData->lastItem() }} dari {{ $agendaData->total() }} data
                        </div>
                        <nav aria-label="Pagination">
                            {{ $agendaData->links('pagination::bootstrap-4') }}
                        </nav>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="api-key-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Create API Key</h5>
                    <button type="button" class="btn-close" id="close-modal" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form autocomplete="off">
                        <div id="api-key-error-msg" class="alert alert-danger py-2 d-none"></div>
                        <input type="hidden" id="apikeyId">
                        <div class="mb-3">
                            <label for="api-key-name" class="form-label">API Key Name <span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="api-key-name"
                                placeholder="Enter api key name">
                        </div>
                        <div class="mb-3" id="apikey-element" style="display: none;">
                            <label for="api-key" class="form-label">API Key</label>
                            <input type="text" class="form-control" id="api-key" disabled
                                value="b5815DE8A7224438932eb296Z5">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <div class="hstack gap-2 justify-content-end">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="createApi-btn">Create API</button>
                        <button type="button" class="btn btn-primary" id="add-btn">Add</button>
                        <button type="button" class="btn btn-primary" id="edit-btn">Save Changes</button>
                    </div>
                </div>
            </div>
            <!-- modal content -->
        </div>
    </div>
    <!-- end modal -->

    <!-- Modal -->
    <div class="modal fade zoomIn" id="deleteApiKeyModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        id="deleteRecord-close"></button>
                </div>
                <div class="modal-body">
                    <div class="mt-2 text-center">
                        <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop"
                            colors="primary:#f7b84b,secondary:#f06548" style="width:100px;height:100px"></lord-icon>
                        <div class="mt-4 pt-2 fs-15 mx-4 mx-sm-5">
                            <h4>Are you sure ?</h4>
                            <p class="text-muted mx-4 mb-0">Are you sure you want to remove this API Key ?</p>
                        </div>
                    </div>
                    <div class="d-flex gap-2 justify-content-center mt-4 mb-2">
                        <button type="button" class="btn w-sm btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn w-sm btn-danger " id="delete-record">Yes, Delete It!</button>
                    </div>
                </div>

            </div><!-- /.modal-content -->
        </div>
    </div> 
</div>

<div>
    <button type="button" class="btn-success btn-rounded shadow-lg btn btn-icon layout-rightside-btn fs-22"><i class="ri-chat-smile-2-line"></i></button>
</div>

@endsection

@section('script')
<!-- apexcharts -->
    <script src="{{ URL::asset('build/libs/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ URL::asset('build/libs/jsvectormap/jsvectormap.min.js') }}"></script>
    <script src="{{ URL::asset('build/libs/jsvectormap/maps/world-merc.js') }}"></script>
    <script src="{{ URL::asset('build/libs/swiper/swiper-bundle.min.js')}}"></script>
    <script src="{{ URL::asset('build/libs/list.js/list.min.js') }}"></script>
    <script src="{{ URL::asset('build/js/pages/dashboard-ecommerce.init.js') }}"></script>
    <script src="{{ URL::asset('build/js/app.js') }}"></script>
    <script src="{{ URL::asset('build/libs/list.pagination.js/list.pagination.min.js') }}"></script>
    <script src="{{ URL::asset('build/libs/sweetalert2/sweetalert2.min.js') }}"></script>
    {{-- <script src="{{ URL::asset('build/js/pages/api-key.init.js') }}"></script> --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Refresh button functionality
        document.getElementById('refresh-agenda')?.addEventListener('click', function() {
            window.location.reload();
        });
        
        // Counter animation for dashboard stats
        const counterElements = document.querySelectorAll('.counter-value');
        counterElements.forEach(counter => {
            const target = parseInt(counter.getAttribute('data-target'));
            let current = 0;
            const increment = target / 50;
            
            const updateCounter = () => {
                if (current < target) {
                    current += increment;
                    counter.textContent = Math.ceil(current);
                    setTimeout(updateCounter, 20);
                } else {
                    counter.textContent = target;
                }
            };
            
            updateCounter();
        });
        
        // Simple table sorting (optional)
        const sortHeaders = document.querySelectorAll('.sort');
        sortHeaders.forEach(header => {
            header.addEventListener('click', function() {
                const sortField = this.getAttribute('data-sort');
                console.log('Sorting by:', sortField);
                // Implement sorting logic here if needed
            });
        });
    });

    // Function for multiple delete (if needed)
    function deleteMultiple() {
        console.log('Delete multiple items');
        // Implement delete functionality
    }
</script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Counter animation
    const counterElements = document.querySelectorAll('.counter-value');
    counterElements.forEach(counter => {
        const target = parseInt(counter.getAttribute('data-target'));
        let current = 0;
        const increment = target / 30;
        
        const updateCounter = () => {
            if (current < target) {
                current += increment;
                counter.textContent = Math.ceil(current);
                setTimeout(updateCounter, 30);
            } else {
                counter.textContent = target;
            }
        };
        
        updateCounter();
    });
    
    console.log('Agenda dashboard loaded');
    console.log('Total agenda data:', {{ $agendaData->total() }});
    console.log('Current page:', {{ $agendaData->currentPage() }});
    console.log('Per page:', {{ $agendaData->perPage() }});
});
</script>

{{-- CSS untuk styling --}}
<style>
.empty-state {
    padding: 2rem;
}

.counter-value {
    transition: all 0.3s ease;
}

.card-animate {
    transition: all 0.3s ease;
}

.card-animate:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
}

.table tbody tr:hover {
    background-color: #f8f9fa;
}

.badge {
    font-size: 0.75rem;
}
</style>

{{-- Custom CSS for better styling --}}
<style>
.counter-value {
    transition: all 0.3s ease;
}

.card-animate {
    transition: all 0.3s ease;
}

.card-animate:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
}

.table th.sort {
    cursor: pointer;
    user-select: none;
}

.table th.sort:hover {
    background-color: #f8f9fa;
}

.badge {
    font-size: 0.75rem;
    padding: 0.35em 0.65em;
}

#agendaTable tbody tr:hover {
    background-color: #f8f9fa;
}
</style>

@endsection
