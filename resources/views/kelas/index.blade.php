<x-app-layout>

    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Data Kelas</h4>
                <h6 class="card-subtitle text-muted">Support card subtitle</h6>


                <div class="btn-group mt-3" role="group" aria-label="Basic example">
                    <button type="button" class="btn btn-secondary" data-bs-toggle="modal"
                        data-bs-target="#tambahModal"><span class="tf-icons bx bx-plus"></span> </i>Tambah
                        data</button>
                    {{-- <button type="button" class="btn btn-secondary"><span class="tf-icons bx bx-file"></span>
                        </i>Template excel</button>
                    <button type="button" class="btn btn-secondary"><span class="tf-icons bx bx-import"></span>
                        </i>Import</button> --}}
                    <a href="{{ route('kelas.export') }}" class="btn btn-secondary"><span class="tf-icons bx bx-export"></span>
                        </i>Export</a>
                    {{-- <button type="button" class="btn btn-secondary"><span class="tf-icons bx bx-printer"></span> </i>
                        Cetak Laporan</button> --}}
                </div>
                <div class="modal fade" id="tambahModal" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel1">Tambah Data Siswa</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <form action="{{ route('kelas.store') }}" method="POST">
                                @csrf
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label class="form-label mt-2" for="nama_kelas">Nama kelas</label>
                                        <input type="text" class="form-control" id="nama_kelas" name="nama_kelas"
                                            placeholder="Nama Kelas" required>
                                        @error('nama_kelas')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label mt-2" for="wali_kelas">Wali Kelas</label>
                                        <select class="form-control" name="guru_id" id="guru_id">
                                            <option value="">Pilih Wali Kelas</option>
                                            @foreach ($guru as $x)
                                                <option value="{{ $x->id_guru }}">{{ $x->nama_lengkap }}</option>
                                            @endforeach
                                        </select>
                                        @error('wali_kelas')
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
                    <table class="table table-bordered table-hover table-striped" id="table_kelas">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Kelas</th>
                                <th>Wali Kelas</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kelas as $x)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $x->nama_kelas }}</td>
                                    <td>{{ $x->nama_lengkap }}</td>
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                data-bs-toggle="dropdown">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <button type="button" class="dropdown-item" data-bs-toggle="modal"
                                                    data-bs-target="#editModal{{ $x->id_kelas }}"><span
                                                        class="bx bx-edit-alt me-1"></span> </i>Edit</button>

                                                <form action="{{ route('kelas.destroy', $x->id_kelas) }}"
                                                    method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="dropdown-item">
                                                        <i class="bx bx-trash me-1"></i> Hapus
                                                    </button>
                                                </form>
                                            </div>
                                        </div>

                                    </td>
                                </tr>
                                <div class="modal fade" id="editModal{{ $x->id_kelas }}" tabindex="-1"
                                    aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel1">Tambah Data Siswa</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <form action="{{ route('kelas.update', $x->id_guru) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label class="form-label mt-2" for="nama_kelas">Nama
                                                            kelas</label>
                                                        <input type="text" class="form-control" id="nama_kelas"
                                                            name="nama_kelas" placeholder="Nama Kelas" value="{{ $x->nama_kelas }}" required>
                                                        @error('nama_kelas')
                                                            <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="form-label mt-2" for="wali_kelas">Wali
                                                            Kelas</label>
                                                        <select class="form-control" name="guru_id" id="guru_id">
                                                            <option value="">Pilih Wali Kelas</option>
                                                            @foreach ($guru as $y)
                                                                <option @if ($y->id_guru == $x->guru_id)
                                                                    
                                                                    selected
                                                                    
                                                                @endif value="{{ $y->id_guru }}">
                                                                    {{ $x->nama_lengkap }}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('wali_kelas')
                                                            <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Save
                                                        changes</button>
                                                </div>
                                            </form>


                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
