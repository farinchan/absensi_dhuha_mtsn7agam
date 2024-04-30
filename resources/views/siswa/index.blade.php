<x-app-layout>

    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Data Siswa</h4>
                <h6 class="card-subtitle text-muted">Support card subtitle</h6>


                <div class="btn-group mt-3" role="group" aria-label="Basic example">
                    <button type="button" class="btn btn-secondary"><span class="tf-icons bx bx-plus"></span> </i>Tambah
                        data</button>
                    <button type="button" class="btn btn-secondary"><span class="tf-icons bx bx-import"></span>
                        </i>Import</button>
                    <button type="button" class="btn btn-secondary"><span class="tf-icons bx bx-export"></span>
                        </i>Export</button>
                    <button type="button" class="btn btn-secondary"><span class="tf-icons bx bx-printer"></span> </i>
                        Cetak Laporan</button>
                </div>
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
                            @foreach ($siswa as $x)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $x->nisn }}</td>
                                    <td>{{ $x->nama_lengkap }}</td>
                                    <td>{{ $x->id_kelas_siswa }}</td>
                                    <td>{{ $x->alamat }}</td>
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                data-bs-toggle="dropdown">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item"
                                                    href="{{ route('siswa.edit', $x->id_siswa) }}"><i
                                                        class="bx bx-edit-alt me-1"></i> Edit</a>
                                                <form action="{{ route('siswa.destroy', $x->id_siswa) }}" method="POST"
                                                    class="d-inline">
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
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
