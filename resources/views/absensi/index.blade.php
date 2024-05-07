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
                <div class=" ">
                    <label for="filter_kelas" class="form-label">Filter berdasarkan Kelas</label>
                    <select class="form-select" id="filter_kelas" aria-label="Default select example">
                        <option value="0" selected>Semua</option>
                        @foreach ($kelas as $k)
                            <option value="{{ $k->id_kelas }}">{{ $k->nama_kelas }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mt-3">
                    <label for="filter_tanggal" class="form-label">Filter berdasarkan Tanggal</label>
                    <input type="date" class="form-control" id="filter_tanggal">
                </div>
                <div class="btn-group mt-3" role="group" aria-label="Basic example">

                    <button type="button" class="btn btn-info"><span class="tf-icons bx bx-search-alt-2"></span>
                        </i>Cari</button>
                    <button type="button" class="btn btn-secondary"><span class="tf-icons bx bx-export"></span>
                        </i>Export</button>
                    <button type="button" class="btn btn-secondary"><span class="tf-icons bx bx-printer"></span> </i>
                        Cetak Laporan</button>
                </div>
            </div>
        </div>
        <div class="card mt-3">
            <div class="card-header">
                <h4 class="card-title">Absensi Siswa Kelas VII 5A</h4>
                <h6 class="card-subtitle text-muted">Tanggal 20 April 2002</h6>
            </div>

            <div class="card-body">
                <div class="table-responsive text-nowrap">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>NISN</th>
                                <th>Nama</th>
                                <th>Kelas</th>
                                <th>Kehadiran</th>
                                <th>Jam Absensi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>202013545</td>
                                <td><strong>Fadilla Septianti</strong></td>
                                <td>VII 5A</td>
                                <td>Haid</td>
                                <td>20:18 19</td>
                            </tr>
                            <tr>
                                <td>202013545</td>
                                <td><strong>Fajri Rinaldi Chan</strong></td>
                                <td>VII 5A</td>
                                <td>Hadir</td>
                                <td>20:19 19</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
