@section('title') Register @endsection

<section class="auth-page-wrapper py-5 position-relative d-flex align-items-center justify-content-center min-vh-100 bg-light">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row g-0">
                            <div class="col-lg-5">
                                <div class="auth-card card bg-primary h-100 border-0 shadow-none p-sm-3 overflow-hidden">
                                    <div class="card-body p-4 d-flex justify-content-between flex-column">
                                        <div class="auth-image">
                                            <div class="d-flex justify-content-center">
                                                <img src="{{ URL::asset('build/images/logo-light-full.png') }}" alt="" height="125" />
                                            </div>
                                            <img src="{{ URL::asset('build/images/effect-pattern/auth-effect-2.png') }}" alt="" class="auth-effect-2" />
                                            <img src="{{ URL::asset('build/images/effect-pattern/auth-effect.png') }}" alt="" class="auth-effect" />
                                            <img src="{{ URL::asset('build/images/effect-pattern/auth-effect.png') }}" alt="" class="auth-effect-3" />
                                        </div>

                                        <div>
                                            <h3 class="text-white">Start your journey with us.</h3>
                                            <p class="text-white-75 fs-15">It brings together your tasks, projects, timelines, files and more</p>
                                        </div>
                                        <div class="text-center text-white-75">
                                            <p class="mb-0">&copy; <script>
                                                    document.write(new Date().getFullYear())

                                                </script> PDSI. Crafted with <i class="mdi mdi-heart text-danger"></i> by ICT PDSI
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--end col-->
                            <div class="col-lg-7">
                                <div class="card mb-0 border-0 py-3 shadow-none">
                                    <div class="card-body px-0 p-sm-5 m-lg-4">
                                        <div class="d-flex justify-content-center">
                                            <img src="{{ URL::asset('build/images/logo-sm-bottom.png') }}" alt="" height="100" />
                                        </div>
                                        <div class="text-center mt-4">
                                            <h5 class="text-primary fs-20">Buat Akun Baru Anggota PDSI</h5>
                                            <p class="text-muted">Silahkan melakukan pengisian pembuatan akun ke Anggotaan PDSI.</p>
                                        </div>

                                        @if(session()->has('error'))
                                            <div class="alert alert-borderless alert-danger alert-dismissible mb-2 mx-2">
                                                {{ session('error') }}
                                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                            </div>
                                        @endif
                                        @if(session()->has('success'))
                                            <div class="alert alert-borderless alert-success alert-dismissible mb-2 mx-2">
                                                {{ session('success') }}
                                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                            </div>
                                        @endif

                                        <div class="p-2 mt-5">
                                            <form class="needs-validation" novalidate enctype="multipart/form-data" wire:submit="submit">
                                                @csrf
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="mb-4">
                                                            <label class="form-label">Daftar sebagai <span class="text-danger">*</span></label>
                                                            <div class="row g-2">
                                                                <div class="col-sm-6">
                                                                    <input type="radio" class="btn-check" name="jenis_anggota" id="jenis_biasa" value="biasa" wire:model.live="jenis_anggota" autocomplete="off" @checked($jenis_anggota === 'biasa')>
                                                                    <label class="btn btn-outline-primary w-100 text-start p-3" for="jenis_biasa">
                                                                        <span class="fw-semibold d-block">Anggota Biasa PDSI</span>
                                                                        <small class="opacity-75">Pendaftaran anggota PDSI</small>
                                                                    </label>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <input type="radio" class="btn-check" name="jenis_anggota" id="jenis_perhimpunan" value="perhimpunan" wire:model.live="jenis_anggota" autocomplete="off" @checked($jenis_anggota === 'perhimpunan')>
                                                                    <label class="btn btn-outline-primary w-100 text-start p-3" for="jenis_perhimpunan">
                                                                        <span class="fw-semibold d-block">Anggota Perhimpunan</span>
                                                                        <small class="opacity-75">Dokter spesialis / perhimpunan, wajib STR, SIP, dll.</small>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            @error('jenis_anggota')
                                                            <div class="text-danger small mt-1"><strong>{{ $message }}</strong></div>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    @if ($jenis_anggota === 'perhimpunan')
                                                    <div class="col-lg-12">
                                                        <div class="mb-4 p-3 rounded border border-primary-subtle bg-primary-subtle">
                                                            <label for="perhimpunan_id" class="form-label fw-semibold">Pilih Perhimpunan <span class="text-danger">*</span></label>
                                                            <select id="perhimpunan_id"
                                                                    class="form-select @error('perhimpunan_id') is-invalid @enderror"
                                                                    wire:model.live="perhimpunan_id">
                                                                <option value="">-- Pilih Perhimpunan --</option>
                                                                @foreach ($perhimpunans as $perhimpunan)
                                                                    <option value="{{ $perhimpunan->id }}" @selected((string) $perhimpunan_id === (string) $perhimpunan->id)>{{ $perhimpunan->singkatan }} - {{ $perhimpunan->nama }}</option>
                                                                @endforeach
                                                            </select>
                                                            @error('perhimpunan_id')
                                                            <div class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </div>
                                                            @enderror
                                                            <small class="text-muted d-block mt-2">Lengkapi data diri di bawah, lalu unggah syarat dokumen perhimpunan (STR, SIP, Serkom, Ijazah, CV{{ $showSerpeng ? ', SERPENG' : '' }}).</small>
                                                        </div>
                                                    </div>
                                                    @endif

                                                    <div class="col-lg-12">
                                                        <div class="mb-3">
                                                            <label for="useremail" class="form-label">Email <span
                                                                    class="text-danger">*</span></label>
                                                            <input id="email" type="email"
                                                                   class="form-control @error('email') is-invalid @enderror" wire:model.live="email"
                                                                   value="{{ old('email') }}" required autocomplete="off"
                                                                   placeholder="Masukan email">
                                                            @error('email')
                                                            <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-12">
                                                        <div class="mb-3">
                                                            <label for="name" class="form-label">Nama Lengkap (dan gelar) <span
                                                                    class="text-danger">*</span></label>
                                                            <input id="name" type="text"
                                                                   class="form-control @error('name') is-invalid @enderror"
                                                                   wire:model.live="name" value="{{ old('name') }}" required
                                                                   autocomplete="name" autofocus placeholder="Masukan Nama">
                                                            @error('name')
                                                            <div class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </div>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-12">
                                                        <div class="mb-3">
                                                            <label for="noktp" class="form-label">No KTP <span
                                                                    class="text-danger">*</span></label>
                                                            <input id="noktp" type="number"
                                                                   class="form-control @error('noktp') is-invalid @enderror"
                                                                   wire:model.live="noktp" value="{{ old('noktp') }}" required
                                                                   autocomplete="noktp" autofocus placeholder="Masukan No noktp">
                                                            @error('noktp')
                                                            <div class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </div>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    @if ($jenis_anggota !== 'perhimpunan')
                                                    <div class="col-lg-12">
                                                        <div class="mb-3">
                                                            <label for="tempat_lahir" class="form-label">Tempat Lahir <span
                                                                    class="text-danger">*</span></label>
                                                            <input id="tempat_lahir" type="text"
                                                                   class="form-control @error('tempat_lahir') is-invalid @enderror"
                                                                   wire:model.live="tempat_lahir" value="{{ old('tempat_lahir') }}" required
                                                                   autocomplete="tempat_lahir" autofocus placeholder="Masukan tempat lahir">
                                                            @error('tempat_lahir')
                                                            <div class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </div>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-12">
                                                        <div class="mb-3">
                                                            <label for="tanggal_lahir" class="form-label">Tanggal Lahir <span
                                                                    class="text-danger">*</span></label>
                                                            <input id="tanggal_lahir" type="date"
                                                                   class="form-control @error('tanggal_lahir') is-invalid @enderror"
                                                                   wire:model.live="tanggal_lahir" value="{{ old('tanggal_lahir') }}" required
                                                                   autocomplete="tanggal_lahir" autofocus>
                                                            @error('tanggal_lahir')
                                                            <div class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    @endif

                                                    <div class="col-lg-12">
                                                        <div class="mb-3">
                                                            <label for="no_hp" class="form-label">No Telp/Hp <span
                                                                    class="text-danger">*</span></label>
                                                            <input id="no_hp" type="number"
                                                                   class="form-control @error('no_hp') is-invalid @enderror"
                                                                   wire:model.live="no_hp" value="{{ old('no_hp', '08') }}" required
                                                                   autocomplete="no_hp" autofocus placeholder="Masukan No no_hp">
                                                            @error('no_hp')
                                                            <div class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </div>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-12">
                                                        <div class="mb-3">
                                                            <label for="alamat" class="form-label">Alamat lengkap domisili saat ini <span class="text-danger">*</span></label>
                                                            <textarea id="alamat"
                                                                      class="form-control @error('alamat') is-invalid @enderror"
                                                                      wire:model.live="alamat" required
                                                                      autocomplete="alamat" autofocus placeholder="Masukan alamat domisili" rows="3">{{ old('alamat') }}</textarea>
                                                            @error('alamat')
                                                            <div class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </div>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <!-- BAGIAN YANG DIMODIFIKASI: KOTA DAN PROVINSI -->
                                                    {{-- Anggota perhimpunan tidak mengisi kota/provinsi --}}
                                                    @if ($jenis_anggota !== 'perhimpunan')
                                                    <div class="col-lg-12">
                                                        <div class="mb-3 position-relative">
                                                            <label for="kota" class="form-label">Mendaftar keanggotaan PDSI Kota/Kabupaten, sebutkan ? <span class="text-danger">*</span></label>
                                                            <input id="kota" type="text"
                                                                   class="form-control @error('kota') is-invalid @enderror"
                                                                   wire:model.live="kota"
                                                                   wire:blur="hideSuggestions"
                                                                   value="{{ old('kota') }}"
                                                                   required
                                                                   autocomplete="off"
                                                                   autofocus
                                                                   placeholder="Masukan Kota/Kabupaten">

                                                            <!-- Suggestions Dropdown -->
                                                            @if($showSuggestions && !empty($suggestions))
                                                                <ul class="list-group position-absolute w-100" style="z-index: 1000; max-height: 200px; overflow-y: auto; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                                                                    @foreach($suggestions as $suggestion)
                                                                        <li class="list-group-item list-group-item-action d-flex justify-content-between align-items-center"
                                                                            style="cursor: pointer;"
                                                                            wire:click="selectKota('{{ $suggestion }}')"
                                                                            onmousedown="event.preventDefault();">
                                                                            <div>
                                                                                <strong>{{ $suggestion }}</strong>
                                                                                <small class="text-muted d-block">{{ $dataKota[$suggestion] ?? '' }}</small>
                                                                            </div>
                                                                            <i class="ri-map-pin-line text-primary"></i>
                                                                        </li>
                                                                    @endforeach
                                                                </ul>
                                                            @endif

                                                            @error('kota')
                                                            <div class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </div>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-12">
                                                        <div class="mb-3">
                                                            <label for="provinsi" class="form-label">Asal Provinsi <span class="text-danger">*</span></label>
                                                            <div class="input-group">
                                                                <span class="input-group-text"><i class="ri-map-2-line"></i></span>
                                                                <input id="provinsi" type="text"
                                                                       class="form-control @error('provinsi') is-invalid @enderror"
                                                                       wire:model="provinsi"
                                                                       value="{{ old('provinsi') }}"
                                                                       required
                                                                       readonly
                                                                       autocomplete="provinsi"
                                                                       autofocus
                                                                       placeholder="Provinsi akan otomatis terisi"
                                                                       style="background-color: #f8f9fa;">
                                                            </div>
                                                            @error('provinsi')
                                                            <div class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    @endif
                                                    <!-- AKHIR MODIFIKASI -->

                                                    @if ($jenis_anggota !== 'perhimpunan')
                                                    <div class="col-lg-12">
                                                        <div class="mb-3">
                                                            <label for="profesi" class="form-label">Profesi <span class="text-danger">*</span></label>

                                                            <div class="form-check mb-2">
                                                                <input class="form-check-input @error('profesi') is-invalid @enderror" type="radio" name="profesi" id="sarjana" value="Sarjana Kedokteran" wire:model.live="profesi">
                                                                <label class="form-check-label" for="sarjana">
                                                                    Sarjana Kedokteran (S1 Kedokteran / KO Asisten)
                                                                </label>
                                                            </div>

                                                            <div class="form-check mb-2">
                                                                <input class="form-check-input @error('profesi') is-invalid @enderror" type="radio" name="profesi" id="umum" value="Dokter Umum" wire:model.live="profesi">
                                                                <label class="form-check-label" for="umum">
                                                                    Dokter Umum
                                                                </label>
                                                            </div>

                                                            <div class="form-check mb-2">
                                                                <input class="form-check-input @error('profesi') is-invalid @enderror" type="radio" name="profesi" id="Kehormatan" value="Anggota Kehormatan" wire:model.live="profesi">
                                                                <label class="form-check-label" for="Kehormatan">
                                                                    Anggota Kehormatan
                                                                </label>
                                                            </div>

                                                            <div class="form-check mb-2">
                                                                <input class="form-check-input @error('profesi') is-invalid @enderror" type="radio" name="profesi" id="spesialis" value="Dokter Spesialis" wire:model.live="profesi">
                                                                <label class="form-check-label" for="spesialis">
                                                                    Dokter Spesialis
                                                                </label>
                                                            </div>

                                                            <div class="form-check mb-2">
                                                                <input class="form-check-input @error('profesi') is-invalid @enderror" type="radio" name="profesi" id="otherRadio" value="other" wire:model.live="profesi">
                                                                <label class="form-check-label" for="otherRadio">
                                                                    Other
                                                                </label>
                                                            </div>

                                                            @if ($profesi === 'other')
                                                                <input type="text" class="form-control mt-2" placeholder="Masukkan profesi lainnya" wire:model.live="otherProfesi">
                                                            @endif
                                                            @error('profesi')
                                                            <div class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    @endif

                                                    <div class="col-lg-12">
                                                        <div class="mb-3">
                                                            <label for="ktp" class="form-label">Foto KTP<span
                                                                    class="text-danger">*</span></label>
                                                            <label for="" class="text-muted"> (File: JPG/PNG Maks. 200 KB)</label>
                                                            <input id="ktp" type="file"
                                                                   class="form-control @error('ktp') is-invalid @enderror" wire:model.live="ktp"
                                                                   value="{{ old('ktp') }}" required autocomplete="off"
                                                                   placeholder="Enter your ktp">
                                                            @error('ktp')
                                                            <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-12">
                                                        <div class="mb-3">
                                                            <label for="npwp" class="form-label">Foto NPWP<span
                                                                    class="text-danger">*</span></label>
                                                            <label for="" class="text-muted"> (File: JPG/PNG Maks. 200 KB)</label>
                                                            <input id="npwp" type="file"
                                                                   class="form-control @error('npwp') is-invalid @enderror" wire:model.live="npwp"
                                                                   value="{{ old('npwp') }}" required autocomplete="off"
                                                                   placeholder="Enter your npwp">
                                                            @error('npwp')
                                                            <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-12">
                                                        <div class="mb-3">
                                                            <label for="avatar" class="form-label">Foto Berwarna<span
                                                                    class="text-danger">*</span></label>
                                                            <label for="" class="text-muted"> (File: JPG/PNG Maks. 200 KB)</label>
                                                            <input id="avatar" type="file"
                                                                   class="form-control @error('avatar') is-invalid @enderror" wire:model.live="avatar"
                                                                   value="{{ old('avatar') }}" required autocomplete="off"
                                                                   placeholder="Enter your avatar">
                                                            @error('avatar')
                                                            <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    @if ($jenis_anggota !== 'perhimpunan')
                                                    <div class="mb-3">
                                                        <label class="form-label">Dokumen Persyaratan <span class="text-danger">*</span></label>

                                                        <!-- Tombol Download -->
                                                        <div class="mb-2">
                                                            <a href="{{ asset('downloads/Surat-Fakta-Integritas-Anggota-PDSI.docx') }}"
                                                            class="btn btn-outline-primary btn-sm"
                                                            download="Surat-Fakta-Integritas-Anggota-PDSI.docx">
                                                                <i class="ri-download-line me-1"></i>
                                                                Download Template Dokumen
                                                            </a>
                                                            <small class="text-muted d-block mt-1">
                                                                Silakan download template, isi, dan upload kembali file yang sudah diisi
                                                            </small>
                                                        </div>

                                                        <!-- Input Upload -->
                                                        <input type="file"
                                                            class="form-control @error('dokumen_persyaratan') is-invalid @enderror"
                                                            wire:model="dokumen_persyaratan"
                                                            id="dokumen_persyaratan"
                                                            accept=".doc,.docx,.pdf"
                                                            required>

                                                        @error('dokumen_persyaratan')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror

                                                        <div class="invalid-feedback">
                                                            Silakan upload dokumen persyaratan yang sudah diisi
                                                        </div>

                                                        <!-- Loading indicator (opsional untuk Livewire) -->
                                                        <div wire:loading wire:target="dokumen_persyaratan" class="text-muted mt-1">
                                                            <small><i class="ri-loader-4-line spinner-border spinner-border-sm me-1"></i>Uploading...</small>
                                                        </div>
                                                    </div>
                                                    @endif

                                                    <!-- Syarat dokumen anggota perhimpunan -->
                                                    @if ($jenis_anggota === 'perhimpunan')
                                                    <div class="col-lg-12">
                                                        <div class="border rounded p-3 mb-3">
                                                            <h6 class="mb-1">Syarat Dokumen Perhimpunan <span class="text-danger">*</span></h6>
                                                            <p class="text-muted small mb-3">Semua dokumen wajib diunggah. File PDF/JPG/PNG (CV: PDF/DOC/DOCX), maks. 5 MB.</p>

                                                            <div class="row">
                                                                <div class="col-md-7 mb-3">
                                                                    <label for="no_str" class="form-label">No. STR <span class="text-danger">*</span></label>
                                                                    <input id="no_str" type="text" class="form-control @error('no_str') is-invalid @enderror"
                                                                           wire:model="no_str" placeholder="Nomor STR">
                                                                    @error('no_str')
                                                                    <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
                                                                    @enderror
                                                                </div>
                                                                <div class="col-md-5 mb-3">
                                                                    <label for="str_berlaku_sampai" class="form-label">STR Berlaku Sampai</label>
                                                                    <input id="str_berlaku_sampai" type="date" class="form-control @error('str_berlaku_sampai') is-invalid @enderror"
                                                                           wire:model="str_berlaku_sampai">
                                                                    <small class="text-muted">Kosongkan jika STR seumur hidup</small>
                                                                    @error('str_berlaku_sampai')
                                                                    <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
                                                                    @enderror
                                                                </div>
                                                            </div>

                                                            @php
                                                                $dokumenProfesi = [
                                                                    'file_str' => ['STR (masih aktif)', '.pdf,.jpg,.jpeg,.png'],
                                                                    'file_sip' => ['SIP', '.pdf,.jpg,.jpeg,.png'],
                                                                    'file_serkom' => ['Serkom', '.pdf,.jpg,.jpeg,.png'],
                                                                    'file_serpeng' => ['SERPENG (wajib khusus PDSKKSI / Sp.KKLP)', '.pdf,.jpg,.jpeg,.png'],
                                                                    'file_ijazah' => ['Ijazah Dokter', '.pdf,.jpg,.jpeg,.png'],
                                                                    'file_cv' => ['CV', '.pdf,.doc,.docx'],
                                                                ];
                                                            @endphp
                                                            @foreach ($dokumenProfesi as $field => [$label, $accept])
                                                                <div class="mb-3" wire:key="{{ $field }}">
                                                                    <label for="{{ $field }}" class="form-label">{{ $label }}
                                                                        @if ($field !== 'file_serpeng' || $showSerpeng)
                                                                            <span class="text-danger">*</span>
                                                                        @endif
                                                                    </label>
                                                                    <input id="{{ $field }}" type="file" accept="{{ $accept }}"
                                                                           class="form-control @error($field) is-invalid @enderror"
                                                                           wire:model="{{ $field }}">
                                                                    @error($field)
                                                                    <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
                                                                    @enderror
                                                                    <div wire:loading wire:target="{{ $field }}" class="text-muted mt-1">
                                                                        <small><i class="ri-loader-4-line spinner-border spinner-border-sm me-1"></i>Uploading...</small>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                    @endif

                                                    <div class="col-lg-12">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="password-input">Password <span class="text-danger">*</span></label>
                                                            <div class="position-relative auth-pass-inputgroup">
                                                                <input type="password"
                                                                       class="form-control pe-5 password-input @error('password') is-invalid @enderror"
                                                                       onpaste="return false" placeholder="Enter password"
                                                                       id="password-input" wire:model.live="password" aria-describedby="passwordInput"
                                                                       pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" required>
                                                                <button
                                                                    class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon"
                                                                    type="button" id="password-addon"><i
                                                                        class="ri-eye-fill align-middle"></i></button>
                                                                @error('password')
                                                                <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-12">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="password-confirm">Confirm Password <span class="text-danger">*</span></label>
                                                            <div class="position-relative auth-pass-inputgroup">
                                                                <input id="confirm-password-input" type="password"
                                                                       class="form-control pe-5 password-input"
                                                                       wire:model.live="password_confirmation" required autocomplete="new-password"
                                                                       placeholder="Enter confirm password">
                                                                <button
                                                                    class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon"
                                                                    type="button" id="password-addon"><i
                                                                        class="ri-eye-fill align-middle"></i></button>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    {{-- <div class="col-lg-12">
                                                        <div class="mb-3">
                                                            <label for="otp" class="form-label">OTP <span class="text-danger">*</span></label>
                                                            <br>
                                                            <label for="">Di kirim ke email terdaftar</label>
                                                            <div class="input-group">
                                                                <input id="otp" type="text" class="form-control @error('otp') is-invalid @enderror"" wire:model.live="otp" required autocomplete="off" placeholder="Enter your OTP">
                                                                <button type="button" class="btn btn-primary" wire:click="sendOtp" wire:loading.attr="disabled">
                                                                    <span wire:loading.remove>Kirim OTP</span>
                                                                    <span wire:loading>
                                                                        <i class="fa fa-spinner fa-spin"></i> Loading...
                                                                    </span>
                                                                </button>                                                            </div>
                                                            @error('otp')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div> --}}

                                                    @php
                                                        $pihakKetentuan = $jenis_anggota === 'perhimpunan' ? 'Anggota Perhimpunan Dokter Spesialis' : 'PDSI Online';
                                                    @endphp
                                                    <div class="mb-4">
                                                        <div class="form-check @error('remember') is-invalid @enderror">
                                                            <input class="form-check-input" type="checkbox" name="remember" id="remember" wire:model.live="remember"
                                                                {{ old('remember') ? 'checked' : '' }}>
                                                            @if ($jenis_anggota === 'perhimpunan')
                                                                <label class="mb-0 fs-13 fw-bold" for="remember">Saya setuju dengan Ketentuan Penggunaan {{ $pihakKetentuan }}</label>
                                                            @else
                                                                <p class="mb-0 fs-12">Saya setuju dengan Ketentuan Penggunaan {{ $pihakKetentuan }}</p>
                                                            @endif
                                                            <p class="mb-0 fs-12 text-muted fst-italic">
                                                                Mohon tinjau dan terima
                                                                <a href="#" data-bs-toggle="modal" data-bs-target=".bs-terms-modal-lg" class="text-primary fst-normal fw-medium">Ketentuan Penggunaan
                                                                </a>
                                                                {{ $pihakKetentuan }} untuk menyelesaikan pembuatan akun
                                                            </p>
                                                        </div>
                                                        @error('remember')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>Anda harus menyetujui Ketentuan Penggunaan {{ $pihakKetentuan }} terlebih dahulu.</strong>
                                                            </span>
                                                        @enderror
                                                    </div>

                                                    <div id="password-contain" class="p-3 bg-light mb-2 rounded">
                                                        <h5 class="fs-13">Password must contain:</h5>
                                                        <p id="pass-length" class="invalid fs-12 mb-2">Minimum <b>8 characters</b>
                                                        </p>
                                                        <p id="pass-lower" class="invalid fs-12 mb-2">At <b>lowercase</b> letter
                                                            (a-z)
                                                        </p>
                                                        <p id="pass-upper" class="invalid fs-12 mb-2">At least <b>uppercase</b>
                                                            letter
                                                            (A-Z)
                                                        </p>
                                                        <p id="pass-number" class="invalid fs-12 mb-0">A least <b>number</b> (0-9)
                                                        </p>
                                                    </div>

                                                    <div class="mt-4">
                                                        <button class="btn btn-primary w-100" type="submit">Sign Up</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="mt-4 text-center">
                                            <p class="mb-0">Already have an account ? <a href="auth-signin-basic" class="fw-semibold text-primary text-decoration-underline"> Signin </a> </p>
                                        </div>
                                    </div><!-- end card body -->
                                </div><!-- end card -->
                            </div>
                            <!--end col-->
                        </div>
                        <!--end row-->

                        <div class="modal fade bs-terms-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="myLargeModalLabel">{{ $jenis_anggota === 'perhimpunan' ? 'Ketentuan Penggunaan Anggota Perhimpunan Dokter Spesialis' : 'From Persetujuan Register' }}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <h6 class="fs-15">Wajib dibaca dan menyetujui bagi register menjadi keanggotaan PDSI, dengan ketentuan-ketentuan dibawah ini: </h6>
                                        <div class="d-flex">
                                            <div class="flex-shrink-0">
                                                <i class="ri-checkbox-circle-fill text-success"></i>
                                            </div>
                                            <div class="flex-grow-1 ms-2">
                                                <p class="text-muted mb-0">Sistem Informasi Aplikasi Data Anggota berbasiskan web Perkumpulan Dokter Seluruh Indonesia (PDSI) yang terintegrasi di dalam Website www.pdsionline.org ini dibangun dan dikembangkan oleh Tim ICT PDSI. Biaya pembangunan dan pengembangan berasal dari iuran anggota yang disetorkan ke rekening PDSI Pusat.</p>
                                            </div>
                                        </div>
                                        <div class="d-flex mt-2">
                                            <div class="flex-shrink-0">
                                                <i class="ri-checkbox-circle-fill text-success"></i>
                                            </div>
                                            <div class="flex-grow-1 ms-2 ">
                                                <p class="text-muted mb-0">Aktivasi data dilakukan berdasarkan kesesuaian jawaban dengan data yang tersimpan di data base Anggota Perkumpulan Dokter Seluruh Indonesia. Jika anda merasa data jawaban telah benar namun tidak dapat masuk ke tahapan selanjutnya, harap hubungi Admin Tim ICT dan Layanan Informasi (PUSDATIN ( Pusat Data dan Informasi )) Pengurus Besar PDSI di Email ke register@pdsionline.org, (Balasan email paling lambat 2 x 24 jam di hari kerja, Email aktif di hari kerja senin – jumat dari jam 08'30 – 16'00). Selanjutnya admin PUSDATIN ( Pusat Data dan Informasi ) akan melakukan validasi laporan anda.</p>
                                            </div>
                                        </div>
                                        <div class="d-flex mt-2">
                                            <div class="flex-shrink-0">
                                                <i class="ri-checkbox-circle-fill text-success"></i>
                                            </div>
                                            <div class="flex-grow-1 ms-2 ">
                                                <p class="text-muted mb-0">Setelah seluruh pertanyaan terjawab, akses aktivasi akan dikirim ke email yang anda daftarkan di pertanyaan terakhir. Masukkan kata kunci (Password) yang mudah anda ingat.</p>
                                            </div>
                                        </div>
                                        <div class="d-flex mt-2">
                                            <div class="flex-shrink-0">
                                                <i class="ri-checkbox-circle-fill text-success"></i>
                                            </div>
                                            <div class="flex-grow-1 ms-2 ">
                                                <p class="text-muted mb-0">Setelah berhasil masuk ke halaman data anda, lakukan perbaikan (Edit) data yang sesuai dengan data terbaru anda. Data pertama yang wajib anda edit adalah data Surat Tanda Registrasi (STR).</p>
                                            </div>
                                        </div>

                                        <h6 class="fs-16 my-3">Seluruh data yang diperbaiki akan diverifikasi oleh admin pusat dengan tahapan sebagai berikut :</h6>
                                        <div class="d-flex mt-2">
                                            <div class="flex-shrink-0">
                                                <i class="ri-checkbox-circle-fill text-success"></i>
                                            </div>
                                            <div class="flex-grow-1 ms-2 ">
                                                <p class="text-muted mb-0">Data iuran akan diverifikasi oleh Bagian Keuangan PDSI Pusat berdasarkan data transaksi yang tercatat di rekening PDSI (dana iuran dan dana biaya cetak Kartu Tanda Anggota (KTA) PDSI ) serta data yang diberikan oleh PDSI Cabang.</p>
                                            </div>
                                        </div>
                                        <div class="d-flex mt-2">
                                            <div class="flex-shrink-0">
                                                <i class="ri-checkbox-circle-fill text-success"></i>
                                            </div>
                                            <div class="flex-grow-1 ms-2 ">
                                                <p class="text-muted mb-0">Data lainnya, terutama Data Pendidikan akan diverifikasi oleh Bagian PUSDALIN berdasarkan validasi sumber data (data kependudukan, data institusi pendidikan, dan lain-lain). Verifikasi data lain dilakukan setelah data iuran terverifikasi.</p>
                                            </div>
                                        </div>

                                        <h6 class="fs-16 my-3">Kendala proses verifikasi dapat disebabkan oleh :</h6>
                                        <div class="d-flex mt-2">
                                            <div class="flex-shrink-0">
                                                <i class=" ri-close-circle-fill text-danger"></i>
                                            </div>
                                            <div class="flex-grow-1 ms-2 ">
                                                <p class="text-muted mb-0">PDSI Cabang belum mengirim data terkait iuran anggota dan atau biaya cetak KTA PDSI.</p>
                                            </div>
                                        </div>
                                        <div class="d-flex mt-2">
                                            <div class="flex-shrink-0">
                                                <i class=" ri-close-circle-fill text-danger"></i>
                                            </div>
                                            <div class="flex-grow-1 ms-2 ">
                                                <p class="text-muted mb-0">Tidak ada data transaksi iuran di rekening PDSI Pusat  yang sesuai dengan informasi yang diberikan PDSI Cabang atau entri data iuran.</p>
                                            </div>
                                        </div>
                                        <div class="d-flex mt-2">
                                            <div class="flex-shrink-0">
                                                <i class=" ri-close-circle-fill text-danger"></i>
                                            </div>
                                            <div class="flex-grow-1 ms-2 ">
                                                <p class="text-muted mb-0">Data pendidikan tidak valid</p>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <a href="javascript:void(0);" class="btn btn-link link-success fw-medium" data-bs-dismiss="modal"><i class="ri-close-line me-1 align-middle"></i> Close</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end col-->
        </div>
        <!--end row-->
    </div>
    <!--end container-->
</section>

@section('script')
    <!-- validation init -->
    <script src="{{ URL::asset('build/js/pages/form-validation.init.js') }}"></script>
    <!-- password create init -->
    <script src="{{ URL::asset('build/js/pages/passowrd-create.init.js') }}"></script>

    <!-- Custom JavaScript untuk Autocomplete -->
    <script>
    document.addEventListener('livewire:init', () => {
        Livewire.on('hide-suggestions', () => {
            setTimeout(() => {
                @this.showSuggestions = false;
            }, 200);
        });
    });

    // Close suggestions when clicking outside
    document.addEventListener('click', function(e) {
        if (!e.target.closest('#kota') && !e.target.closest('.list-group')) {
            @this.showSuggestions = false;
        }
    });

    // Style untuk hover effect
    document.addEventListener('DOMContentLoaded', function() {
        const style = document.createElement('style');
        style.textContent = `
            .list-group-item:hover {
                background-color: #e3f2fd !important;
                transform: translateY(-1px);
                transition: all 0.2s ease;
            }

            .list-group-item {
                border: 1px solid #dee2e6;
                transition: all 0.2s ease;
            }

            .list-group-item:first-child {
                border-top-left-radius: 0.375rem;
                border-top-right-radius: 0.375rem;
            }

            .list-group-item:last-child {
                border-bottom-left-radius: 0.375rem;
                border-bottom-right-radius: 0.375rem;
            }

            .position-relative input:focus + .list-group {
                border-top: none;
            }

            #provinsi[readonly] {
                background-color: #f8f9fa !important;
                cursor: not-allowed;
            }
        `;
        document.head.appendChild(style);
    });
    </script>
@endsection
