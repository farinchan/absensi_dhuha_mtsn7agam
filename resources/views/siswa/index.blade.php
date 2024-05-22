<x-app-layout>

    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Data Siswa</h4>
                <h6 class="card-subtitle text-muted">MTS Negeri 7 Agam</h6>


                <div class="btn-group mt-3" role="group" aria-label="Basic example">
                    <button type="button" class="btn btn-secondary" data-bs-toggle="modal"
                        data-bs-target="#tambahModal"><span class="tf-icons bx bx-plus"></span> </i>Tambah
                        data</button>
                    {{-- <button type="button" class="btn btn-secondary"><span class="tf-icons bx bx-file"></span>
                        </i>Template excel</button> --}}
                    <button type="button" class="btn btn-secondary"><span class="tf-icons bx bx-import"></span>
                        </i>Import</button>
                    {{-- <button type="button" class="btn btn-secondary"><span class="tf-icons bx bx-export"></span>
                        </i>Export</button> --}}
                    <a id="cetak_laporan" target="_blank" class="btn btn-info"><span class="tf-icons bx bx-printer"></span> </i>
                        Cetak Laporan</a>
                    {{-- <a id="cetak_kartu" target="_blank" class="btn btn-warning"><span class="tf-icons bx bx-id-card"></span> </i>
                        Cetak kartu Absensi</a> --}}
                </div>
                <div class=" mt-3">
                    <label for="filter_kelas" class="form-label">Filter berdasarkan Kelas</label>
                    <select class="form-select" id="filter_kelas" aria-label="Default select example">
                        <option value="0" selected>Semua</option>
                        @foreach ($kelas as $k)
                            <option value="{{ $k->id_kelas }}">{{ $k->nama_kelas }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="modal fade" id="tambahModal" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel1">Tambah Data Siswa</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <form action="{{ route('siswa.store') }}" method="POST">
                                @csrf
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label class="form-label mt-2" for="nisn">NISN</label>
                                        <input type="text" class="form-control" id="nisn" name="nisn"
                                            required>
                                        @error('nisn')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label mt-2" for="nama_lengkap">Nama</label>
                                        <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap"
                                            required>
                                        @error('nama_lengkap')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label mt-2" for="id_kelas_siswa">Kelas</label>
                                        <select class="form-control" id="id_kelas_siswa" name="id_kelas_siswa" required>
                                            <option value="">Pilih Kelas</option>
                                            @foreach ($kelas as $k)
                                                <option value="{{ $k->id_kelas }}">{{ $k->nama_kelas }}</option>
                                            @endforeach
                                        </select>
                                        @error('id_kelas_siswa')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label mt-2" for="alamat">Alamat</label>
                                        <textarea class="form-control" id="alamat" name="alamat" rows="3" required></textarea>
                                        @error('alamat')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                </div>
                            </form>


                        </div>
                    </div>
                </div>
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
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped" id="table_siswa">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>NISN</th>
                                <th>Nama</th>
                                <th>Kelas</th>
                                <th>Alamat</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- @foreach ($siswa as $x)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $x->nisn }}</td>
                                    <td>{{ $x->nama_lengkap }}</td>
                                    <td>{{ $x->id_kelas_siswa }}</td>
                                    <td>{{ $x->alamat }}</td>
                                    <td>
                                        
                                    </td>
                                </tr>
                            @endforeach --}}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
