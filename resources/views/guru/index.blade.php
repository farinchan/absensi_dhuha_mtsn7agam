<x-app-layout>


    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Data Guru</h4>
                <h6 class="card-subtitle text-muted">Support card subtitle</h6>


                <div class="btn-group mt-3" role="group" aria-label="Basic example">
                    <button type="button" class="btn btn-secondary" data-bs-toggle="modal"
                        data-bs-target="#tambahModal"><span class="tf-icons bx bx-plus"></span> </i>Tambah
                        data</button>
                    {{-- <button type="button" class="btn btn-secondary"><span class="tf-icons bx bx-file"></span>
                        </i>Template excel</button> --}}
                    <button type="button" class="btn btn-secondary" data-bs-toggle="modal"
                    data-bs-target="#importModal"><span class="tf-icons bx bx-import"></span>
                        </i>Import</button>
                        
                    <a href="{{ route("guru.export") }}" class="btn btn-secondary"><span class="tf-icons bx bx-export"></span>
                        </i>Export</a>
                    <a href="{{ route('guru.laporan') }}" target="_blank" class="btn btn-info"><span
                            class="tf-icons bx bx-printer"></span> </i>
                        Cetak Laporan</a>
                </div>
                {{-- tambah data guru --}}
                <div class="modal fade" id="tambahModal" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel1">Tambah Data guru</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <form action="{{ route('guru.store') }}" method="POST">
                                @csrf
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label class="form-label mt-2" for="nip">NIP</label>
                                        <input type="text" class="form-control" id="nip" name="nip"
                                            required>
                                        @error('nip')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label mt-2" for="nama_lengkap">Nama</label>
                                        <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap"
                                            placeholder="Nama Lengkap" required>
                                        @error('nama_lengkap')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label mt-2" for="mapel">Mata Pelajaran</label>
                                        <input type="text" class="form-control" id="mapel" name="mapel"
                                            placeholder="Mata Pelajaran" required>
                                        @error('mapel')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label mt-2" for="no_hp">Nomor Telp</label>
                                        <input type="text" class="form-control" id="no_hp" name="no_hp"
                                            placeholder="Nomor Telepon" required>
                                        @error('no_hp')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label mt-2" for="username">Username</label>
                                        <input type="text" class="form-control" id="username" name="username"
                                            placeholder="Username" required>
                                        @error('username')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label mt-2" for="password">Password</label>
                                        <input type="password" class="form-control" id="password" name="password"
                                            placeholder="Password" required>
                                        @error('password')
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
                {{-- import data guru --}}
                <div class="modal fade" id="importModal" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel1">import Data guru</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <form action="{{ route('guru.import') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label class="form-label mt-2" for="nip">file excel</label>
                                        <input type="file" class="form-control" id="file" name="file"
                                            required>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">import</button>
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
                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                            aria-label="Close"></button>
                    </div>
                @endif
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible mt-3" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                            aria-label="Close"></button>
                    </div>
                @endif
                <div class="card-body">

                    <div class="table-responsive">
                        <table class="table table-bordered table-hover table-striped" id="table_guru">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>NIP</th>
                                    <th>Nama</th>
                                    <th>Mata pelajaran</th>
                                    <th>No. Telepon</th>
                                    <th>Username</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($guru as $x)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $x->nip }}</td>
                                        <td>{{ $x->nama_lengkap }}</td>
                                        <td>{{ $x->mapel }}</td>
                                        <td>{{ $x->no_hp }}</td>
                                        <td>{{ $x->username }}</td>
                                        <td>
                                            <div class="dropdown">
                                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                    data-bs-toggle="dropdown">
                                                    <i class="bx bx-dots-vertical-rounded"></i>
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href=""><i
                                                            class="bx bx-edit-alt me-1"></i> Edit</a>
                                                    <form action="{{ route('guru.destroy', $x->id_guru) }}"
                                                        method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="dropdown-item" href="javascript:void(0);"
                                                            onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')"><i
                                                                class="bx bx-trash me-1"></i> Delete
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
