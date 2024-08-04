<x-app-layout>
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Data Jadwal Piket</h4>
                <h6 class="card-subtitle text-muted">Piket guru MTS Negeri 7 Agam</h6>


                <div class="btn-group mt-3" role="group" aria-label="Basic example">
                    <button type="button" class="btn btn-secondary" data-bs-toggle="modal"
                        data-bs-target="#tambahModal"><span class="tf-icons bx bx-plus"></span> </i>Tambah
                        data</button>
                    <!--<button type="button" class="btn btn-secondary"><span class="tf-icons bx bx-file"></span>-->
                    <!--    </i>Template excel</button>-->
                    <!--<button type="button" class="btn btn-secondary"><span class="tf-icons bx bx-import"></span>-->
                    <!--    </i>Import</button>-->
                    <!--<button type="button" class="btn btn-secondary"><span class="tf-icons bx bx-export"></span>-->
                    <!--    </i>Export</button>-->
                    <!--<button type="button" class="btn btn-secondary"><span class="tf-icons bx bx-printer"></span> </i>-->
                    <!--    Cetak Laporan</button>-->
                </div>
                <div class="modal fade" id="tambahModal" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel1">Tambah data jadwal piket</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <form action="{{ route('jadwal_piket.store') }}" method="POST">
                                @csrf
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label class="form-label mt-2" for="guru_id">Nama guru</label>
                                        <select class="form-control" name="id_guru" id="id_guru">
                                            <option value="">Pilih guru</option>
                                            @foreach ($guru as $x)
                                                <option value="{{ $x->id_guru }}">{{ $x->nama_lengkap }} -
                                                    NIP.{{ $x->nip }}</option>
                                            @endforeach
                                        </select>
                                        @error('guru_id')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label mt-2" for="hari">Wali guru</label>
                                        <select class="form-control" name="hari" id="hari">
                                            <option value="" disabled>Pilih hari</option>
                                            <option value="senin">Senin</option>
                                            <option value="selasa">Selasa</option>
                                            <option value="rabu">Rabu</option>
                                            <option value="kamis">Kamis</option>
                                            <option value="jumat">Jumat</option>
                                            <option value="sabtu">Sabtu</option>
                                        </select>
                                        @error('hari')
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
        </div>
        <div class="row mt-3">
            <div class="col-md-6 mt-3">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Piket Hari Senin</h4>
        
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover table-striped" >
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>NIP</th>
                                        <th>Nama Guru</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($piket_senin as $x)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $x->nip }}</td>
                                            <td>{{ $x->nama_lengkap }}</td>
                                            <td>
                                                <div class="dropdown">
                                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                        data-bs-toggle="dropdown">
                                                        <i class="bx bx-dots-vertical-rounded"></i>
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <button type="button" class="dropdown-item" data-bs-toggle="modal"
                                                            data-bs-target="#editModal{{ $x->id_piket }}"><i
                                                                class="bx bx-edit-alt me-1"></i>
                                                            Edit
                                                        </button>
        
                                                        <form action="{{ route('jadwal_piket.destroy', $x->id_piket) }}"
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
        
                                        <div class="modal fade" id="editModal{{ $x->id_piket }}"
                                            tabindex="-1"aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel1">Edit data jadwal piket
                                                        </h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <form action="{{ route('jadwal_piket.update', $x->id_piket) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <label class="form-label mt-2" for="guru_id">Nama
                                                                    guru</label>
                                                                <select class="form-control" name="id_guru" id="id_guru">
                                                                    <option value="">Pilih guru</option>
                                                                    @foreach ($guru as $y)
                                                                        <option value="{{ $x->id_guru }}"
                                                                            @if ($y->id_guru === $x->id_guru) selected @endif>
                                                                            {{ $x->nama_lengkap }} -
                                                                            NIP.{{ $x->nip }}</option>
                                                                    @endforeach
                                                                </select>
                                                                @error('guru_id')
                                                                    <div class="text-danger">{{ $message }}
                                                                    </div>
                                                                @enderror
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="form-label mt-2" for="hari">Hari
                                                                    Piket</label>
                                                                <select class="form-control" name="hari" id="hari">
                                                                    <option value="" disabled>Pilih hari
                                                                    </option>
                                                                    <option value="senin"
                                                                        @if ($y->hari === 'senin') selected @endif>Senin
                                                                    </option>
                                                                    <option value="selasa"
                                                                        @if ($x->hari === 'selasa') selected @endif>Selasa
                                                                    </option>
                                                                    <option value="rabu"
                                                                        @if ($x->hari === 'rabu') selected @endif>Rabu
                                                                    </option>
                                                                    <option value="kamis"
                                                                        @if ($x->hari === 'kamis') selected @endif>Kamis
                                                                    </option>
                                                                    <option value="jumat"
                                                                        @if ($x->hari === 'jumat') selected @endif>Jumat
                                                                    </option>
                                                                    <option value="sabtu"
                                                                        @if ($x->hari === 'sabtu') selected @endif>Sabtu
                                                                    </option>
                                                                </select>
                                                                @error('hari')
                                                                    <div class="text-danger">{{ $message }}
                                                                    </div>
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
            <div class="col-md-6 mt-3">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Piket Hari Selasa</h4>
        
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover table-striped" >
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>NIP</th>
                                        <th>Nama Guru</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($piket_selasa as $x)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $x->nip }}</td>
                                            <td>{{ $x->nama_lengkap }}</td>
                                            <td>
                                                <div class="dropdown">
                                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                        data-bs-toggle="dropdown">
                                                        <i class="bx bx-dots-vertical-rounded"></i>
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <button type="button" class="dropdown-item" data-bs-toggle="modal"
                                                            data-bs-target="#editModal{{ $x->id_piket }}"><i
                                                                class="bx bx-edit-alt me-1"></i>
                                                            Edit
                                                        </button>
        
                                                        <form action="{{ route('jadwal_piket.destroy', $x->id_piket) }}"
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
        
                                        <div class="modal fade" id="editModal{{ $x->id_piket }}"
                                            tabindex="-1"aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel1">Edit data jadwal piket
                                                        </h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <form action="{{ route('jadwal_piket.update', $x->id_piket) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <label class="form-label mt-2" for="guru_id">Nama
                                                                    guru</label>
                                                                <select class="form-control" name="id_guru" id="id_guru">
                                                                    <option value="">Pilih guru</option>
                                                                    @foreach ($guru as $y)
                                                                        <option value="{{ $x->id_guru }}"
                                                                            @if ($y->id_guru === $x->id_guru) selected @endif>
                                                                            {{ $x->nama_lengkap }} -
                                                                            NIP.{{ $x->nip }}</option>
                                                                    @endforeach
                                                                </select>
                                                                @error('guru_id')
                                                                    <div class="text-danger">{{ $message }}
                                                                    </div>
                                                                @enderror
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="form-label mt-2" for="hari">Hari
                                                                    Piket</label>
                                                                <select class="form-control" name="hari" id="hari">
                                                                    <option value="" disabled>Pilih hari
                                                                    </option>
                                                                    <option value="senin"
                                                                        @if ($y->hari === 'senin') selected @endif>Senin
                                                                    </option>
                                                                    <option value="selasa"
                                                                        @if ($x->hari === 'selasa') selected @endif>Selasa
                                                                    </option>
                                                                    <option value="rabu"
                                                                        @if ($x->hari === 'rabu') selected @endif>Rabu
                                                                    </option>
                                                                    <option value="kamis"
                                                                        @if ($x->hari === 'kamis') selected @endif>Kamis
                                                                    </option>
                                                                    <option value="jumat"
                                                                        @if ($x->hari === 'jumat') selected @endif>Jumat
                                                                    </option>
                                                                    <option value="sabtu"
                                                                        @if ($x->hari === 'sabtu') selected @endif>Sabtu
                                                                    </option>
                                                                </select>
                                                                @error('hari')
                                                                    <div class="text-danger">{{ $message }}
                                                                    </div>
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
            <div class="col-md-6 mt-3">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Piket Hari Rabu</h4>
        
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover table-striped" >
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>NIP</th>
                                        <th>Nama Guru</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($piket_rabu as $x)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $x->nip }}</td>
                                            <td>{{ $x->nama_lengkap }}</td>
                                            <td>
                                                <div class="dropdown">
                                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                        data-bs-toggle="dropdown">
                                                        <i class="bx bx-dots-vertical-rounded"></i>
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <button type="button" class="dropdown-item" data-bs-toggle="modal"
                                                            data-bs-target="#editModal{{ $x->id_piket }}"><i
                                                                class="bx bx-edit-alt me-1"></i>
                                                            Edit
                                                        </button>
        
                                                        <form action="{{ route('jadwal_piket.destroy', $x->id_piket) }}"
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
        
                                        <div class="modal fade" id="editModal{{ $x->id_piket }}"
                                            tabindex="-1"aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel1">Edit data jadwal piket
                                                        </h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <form action="{{ route('jadwal_piket.update', $x->id_piket) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <label class="form-label mt-2" for="guru_id">Nama
                                                                    guru</label>
                                                                <select class="form-control" name="id_guru" id="id_guru">
                                                                    <option value="">Pilih guru</option>
                                                                    @foreach ($guru as $y)
                                                                        <option value="{{ $x->id_guru }}"
                                                                            @if ($y->id_guru === $x->id_guru) selected @endif>
                                                                            {{ $x->nama_lengkap }} -
                                                                            NIP.{{ $x->nip }}</option>
                                                                    @endforeach
                                                                </select>
                                                                @error('guru_id')
                                                                    <div class="text-danger">{{ $message }}
                                                                    </div>
                                                                @enderror
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="form-label mt-2" for="hari">Hari
                                                                    Piket</label>
                                                                <select class="form-control" name="hari" id="hari">
                                                                    <option value="" disabled>Pilih hari
                                                                    </option>
                                                                    <option value="senin"
                                                                        @if ($y->hari === 'senin') selected @endif>Senin
                                                                    </option>
                                                                    <option value="selasa"
                                                                        @if ($x->hari === 'selasa') selected @endif>Selasa
                                                                    </option>
                                                                    <option value="rabu"
                                                                        @if ($x->hari === 'rabu') selected @endif>Rabu
                                                                    </option>
                                                                    <option value="kamis"
                                                                        @if ($x->hari === 'kamis') selected @endif>Kamis
                                                                    </option>
                                                                    <option value="jumat"
                                                                        @if ($x->hari === 'jumat') selected @endif>Jumat
                                                                    </option>
                                                                    <option value="sabtu"
                                                                        @if ($x->hari === 'sabtu') selected @endif>Sabtu
                                                                    </option>
                                                                </select>
                                                                @error('hari')
                                                                    <div class="text-danger">{{ $message }}
                                                                    </div>
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
            <div class="col-md-6 mt-3">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Piket Hari kamis</h4>
        
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover table-striped" >
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>NIP</th>
                                        <th>Nama Guru</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($piket_kamis as $x)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $x->nip }}</td>
                                            <td>{{ $x->nama_lengkap }}</td>
                                            <td>
                                                <div class="dropdown">
                                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                        data-bs-toggle="dropdown">
                                                        <i class="bx bx-dots-vertical-rounded"></i>
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <button type="button" class="dropdown-item" data-bs-toggle="modal"
                                                            data-bs-target="#editModal{{ $x->id_piket }}"><i
                                                                class="bx bx-edit-alt me-1"></i>
                                                            Edit
                                                        </button>
        
                                                        <form action="{{ route('jadwal_piket.destroy', $x->id_piket) }}"
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
        
                                        <div class="modal fade" id="editModal{{ $x->id_piket }}"
                                            tabindex="-1"aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel1">Edit data jadwal piket
                                                        </h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <form action="{{ route('jadwal_piket.update', $x->id_piket) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <label class="form-label mt-2" for="guru_id">Nama
                                                                    guru</label>
                                                                <select class="form-control" name="id_guru" id="id_guru">
                                                                    <option value="">Pilih guru</option>
                                                                    @foreach ($guru as $y)
                                                                        <option value="{{ $x->id_guru }}"
                                                                            @if ($y->id_guru === $x->id_guru) selected @endif>
                                                                            {{ $x->nama_lengkap }} -
                                                                            NIP.{{ $x->nip }}</option>
                                                                    @endforeach
                                                                </select>
                                                                @error('guru_id')
                                                                    <div class="text-danger">{{ $message }}
                                                                    </div>
                                                                @enderror
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="form-label mt-2" for="hari">Hari
                                                                    Piket</label>
                                                                <select class="form-control" name="hari" id="hari">
                                                                    <option value="" disabled>Pilih hari
                                                                    </option>
                                                                    <option value="senin"
                                                                        @if ($y->hari === 'senin') selected @endif>Senin
                                                                    </option>
                                                                    <option value="selasa"
                                                                        @if ($x->hari === 'selasa') selected @endif>Selasa
                                                                    </option>
                                                                    <option value="rabu"
                                                                        @if ($x->hari === 'rabu') selected @endif>Rabu
                                                                    </option>
                                                                    <option value="kamis"
                                                                        @if ($x->hari === 'kamis') selected @endif>Kamis
                                                                    </option>
                                                                    <option value="jumat"
                                                                        @if ($x->hari === 'jumat') selected @endif>Jumat
                                                                    </option>
                                                                    <option value="sabtu"
                                                                        @if ($x->hari === 'sabtu') selected @endif>Sabtu
                                                                    </option>
                                                                </select>
                                                                @error('hari')
                                                                    <div class="text-danger">{{ $message }}
                                                                    </div>
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
            <div class="col-md-6 mt-3">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Piket Hari Jum'at</h4>
        
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover table-striped" >
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>NIP</th>
                                        <th>Nama Guru</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($piket_jumat as $x)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $x->nip }}</td>
                                            <td>{{ $x->nama_lengkap }}</td>
                                            <td>
                                                <div class="dropdown">
                                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                        data-bs-toggle="dropdown">
                                                        <i class="bx bx-dots-vertical-rounded"></i>
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <button type="button" class="dropdown-item" data-bs-toggle="modal"
                                                            data-bs-target="#editModal{{ $x->id_piket }}"><i
                                                                class="bx bx-edit-alt me-1"></i>
                                                            Edit
                                                        </button>
        
                                                        <form action="{{ route('jadwal_piket.destroy', $x->id_piket) }}"
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
        
                                        <div class="modal fade" id="editModal{{ $x->id_piket }}"
                                            tabindex="-1"aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel1">Edit data jadwal piket
                                                        </h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <form action="{{ route('jadwal_piket.update', $x->id_piket) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <label class="form-label mt-2" for="guru_id">Nama
                                                                    guru</label>
                                                                <select class="form-control" name="id_guru" id="id_guru">
                                                                    <option value="">Pilih guru</option>
                                                                    @foreach ($guru as $y)
                                                                        <option value="{{ $x->id_guru }}"
                                                                            @if ($y->id_guru === $x->id_guru) selected @endif>
                                                                            {{ $x->nama_lengkap }} -
                                                                            NIP.{{ $x->nip }}</option>
                                                                    @endforeach
                                                                </select>
                                                                @error('guru_id')
                                                                    <div class="text-danger">{{ $message }}
                                                                    </div>
                                                                @enderror
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="form-label mt-2" for="hari">Hari
                                                                    Piket</label>
                                                                <select class="form-control" name="hari" id="hari">
                                                                    <option value="" disabled>Pilih hari
                                                                    </option>
                                                                    <option value="senin"
                                                                        @if ($y->hari === 'senin') selected @endif>Senin
                                                                    </option>
                                                                    <option value="selasa"
                                                                        @if ($x->hari === 'selasa') selected @endif>Selasa
                                                                    </option>
                                                                    <option value="rabu"
                                                                        @if ($x->hari === 'rabu') selected @endif>Rabu
                                                                    </option>
                                                                    <option value="kamis"
                                                                        @if ($x->hari === 'kamis') selected @endif>Kamis
                                                                    </option>
                                                                    <option value="jumat"
                                                                        @if ($x->hari === 'jumat') selected @endif>Jumat
                                                                    </option>
                                                                    <option value="sabtu"
                                                                        @if ($x->hari === 'sabtu') selected @endif>Sabtu
                                                                    </option>
                                                                </select>
                                                                @error('hari')
                                                                    <div class="text-danger">{{ $message }}
                                                                    </div>
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
            <div class="col-md-6 mt-3">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Piket Hari Sabtu</h4>
        
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover table-striped" >
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>NIP</th>
                                        <th>Nama Guru</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($piket_sabtu as $x)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $x->nip }}</td>
                                            <td>{{ $x->nama_lengkap }}</td>
                                            <td>
                                                <div class="dropdown">
                                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                        data-bs-toggle="dropdown">
                                                        <i class="bx bx-dots-vertical-rounded"></i>
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <button type="button" class="dropdown-item" data-bs-toggle="modal"
                                                            data-bs-target="#editModal{{ $x->id_piket }}"><i
                                                                class="bx bx-edit-alt me-1"></i>
                                                            Edit
                                                        </button>
        
                                                        <form action="{{ route('jadwal_piket.destroy', $x->id_piket) }}"
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
        
                                        <div class="modal fade" id="editModal{{ $x->id_piket }}"
                                            tabindex="-1"aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel1">Edit data jadwal piket
                                                        </h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <form action="{{ route('jadwal_piket.update', $x->id_piket) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <label class="form-label mt-2" for="guru_id">Nama
                                                                    guru</label>
                                                                <select class="form-control" name="id_guru" id="id_guru">
                                                                    <option value="">Pilih guru</option>
                                                                    @foreach ($guru as $y)
                                                                        <option value="{{ $x->id_guru }}"
                                                                            @if ($y->id_guru === $x->id_guru) selected @endif>
                                                                            {{ $x->nama_lengkap }} -
                                                                            NIP.{{ $x->nip }}</option>
                                                                    @endforeach
                                                                </select>
                                                                @error('guru_id')
                                                                    <div class="text-danger">{{ $message }}
                                                                    </div>
                                                                @enderror
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="form-label mt-2" for="hari">Hari
                                                                    Piket</label>
                                                                <select class="form-control" name="hari" id="hari">
                                                                    <option value="" disabled>Pilih hari
                                                                    </option>
                                                                    <option value="senin"
                                                                        @if ($y->hari === 'senin') selected @endif>Senin
                                                                    </option>
                                                                    <option value="selasa"
                                                                        @if ($x->hari === 'selasa') selected @endif>Selasa
                                                                    </option>
                                                                    <option value="rabu"
                                                                        @if ($x->hari === 'rabu') selected @endif>Rabu
                                                                    </option>
                                                                    <option value="kamis"
                                                                        @if ($x->hari === 'kamis') selected @endif>Kamis
                                                                    </option>
                                                                    <option value="jumat"
                                                                        @if ($x->hari === 'jumat') selected @endif>Jumat
                                                                    </option>
                                                                    <option value="sabtu"
                                                                        @if ($x->hari === 'sabtu') selected @endif>Sabtu
                                                                    </option>
                                                                </select>
                                                                @error('hari')
                                                                    <div class="text-danger">{{ $message }}
                                                                    </div>
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
        </div>
    </div>
</x-app-layout>
