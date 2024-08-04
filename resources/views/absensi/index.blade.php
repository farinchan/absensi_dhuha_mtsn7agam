<x-app-layout>

    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Data Absensi Siswa</h4>
                <h6 class="card-subtitle text-muted">Support card subtitle</h6>

                @if ($errors->any())
                    <div class="alert alert-warning alert-dismissible mt-3" role="alert">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible mt-3" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class=" mt-3">
                            <label for="filter_kelas" class="form-label">Filter berdasarkan Kelas</label>
                            <select class="form-select" id="filter_kelas" aria-label="Default select example">
                                @foreach ($kelas as $k)
                                    <option value="{{ $k->id_kelas }}">{{ $k->nama_kelas }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class=" mt-3">
                            <label for="filter_nama" class="form-label">Filter berdasarkan Nama</label>
                            <select class="form-select" id="select2-field" aria-label="Default select example">
                                <option value="0" selected>Semua</option>
                                @foreach ($siswa as $k)
                                    <option value="{{ $k->id_siswa }}">{{ $k->nama_lengkap }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    
                </div>
                
                <div class="row">
                    <div class="col-md-4">
                        <div class="mt-3">
                            <label for="filter_tanggal" class="form-label">Filter Dari Tanggal </label>
                            <input type="date" class="form-control" id="filter_tanggal_dari" value="{{ date("Y-m-d") }}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mt-3">
                            <label for="filter_tanggal" class="form-label">Filter Sampai Tanggal</label>
                            <input type="date" class="form-control" id="filter_tanggal_sampai" value="{{ date("Y-m-d") }}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class=" mt-3">
                            <label for="filter_kelas" class="form-label">Filter berdasarkan Kehadiran</label>
                            <select class="form-select" id="filter_kehadiran" aria-label="Default select example">
                                <option value="0" selected>Semua</option>
                                <option value="hadir">Hadir</option>
                                <option value="terlambat">terlambat</option>
                                <option value="haid">Haid</option>
                                <option value="tidak hadir">tidak hadir</option>

                            </select>
                        </div>
                    </div>
                    
                </div>
                <div class="btn-group mt-3" role="group" aria-label="Basic example">

                    {{-- <button type="button" class="btn btn-info"><span class="tf-icons bx bx-search-alt-2"></span>
                        </i>Cari</button> --}}
                    {{-- <button type="button" class="btn btn-secondary"><span class="tf-icons bx bx-export"></span>
                        </i>Export</button> --}}
                    <a id="cetak_laporan" class="btn btn-info" target="_blank"><span
                            class="tf-icons bx bx-printer"></span>
                        </i>
                        Cetak Laporan</a>
                </div>
            </div>

        </div>

        <div class="card mt-2">
            <div class="card-header">
                <h4 id="title-kelas" class="card-title">Absensi Siswa Kelas VII 5A</h4>
                <h6 id="label_tanggal" class="card-subtitle text-muted"></h6>
            </div>

            <div class="card-body">
                <div class="table-responsive text-nowrap">
                    <table class="table table-bordered" id="absensi_siswa">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>NISN</th>
                                <th>Nama</th>
                                <th>Kelas</th>
                                <th>tanggal</th>
                                <th>Kehadiran</th>
                                <th>Jam Absensi</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

</x-app-layout>
