<x-app-layout>

    <x-slot name="header">
        <h2 class="h4 font-weight-semi-bold">
            {{ __('Edit Siswa') }}
        </h2>
    </x-slot>

    <div class="container-xxl flex-grow-1 container-p-y">

        <div class="card mb-5">
            <div class="card-header">
                <h4 class="card-title">Edit Siswa</h4>
                <h6 class="card-subtitle text-muted">Edit siswa atas nama <b> {{ $siswa->nama_lengkap }} ({{ $siswa->nisn }})</b> </h6>
               
            </div>
            <div class="card-body">
                <form action="{{ route('siswa.update', $siswa->id_siswa) }}" method="POST">
                    @csrf
                    @method('PUT')


                    <div class="mb-3 row">
                        <label for="nisn" class="col-md-2 col-form-label">NISN</label>
                        <div class="col-md-10">
                            <input type="text" id="nisn" class="form-control" name="nisn"
                                value="{{ $siswa->nisn }}" />
                            @error('nisn')
                                <div class="form-text text-danger">{{ $nisn }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="nama_lengkap" class="col-md-2 col-form-label">Nama Lengkap</label>
                        <div class="col-md-10">
                            <input type="text" id="nama_lengkap" class="form-control" name="nama_lengkap"
                                value="{{ $siswa->nama_lengkap }}" />
                            @error('id_kelas_siswa')
                                <div class="form-text text-danger">{{ $nama_lengkap }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="id_kelas_siswa" class="col-md-2 col-form-label">Kelas</label>
                        <div class="col-md-10">
                            <select name="id_kelas_siswa" id="id_kelas_siswa" class="form-select">
                                @foreach ($kelas as $x)
                                    <option value="{{ $x->id_kelas }}"
                                        {{ $siswa->id_kelas_siswa == $x->id ? 'selected' : '' }}>{{ $x->nama_kelas }}
                                    </option>
                                @endforeach
                            </select>
                            @error('id_kelas_siswa')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>
                    <div class="mb-3 row">
                        <label for="alamat" class="col-md-2 col-form-label">Alamat</label>
                        <div class="col-md-10">
                            <textarea name="alamat" class="form-control" id="alamat" rows="3">
                                {{ $siswa->alamat }}
                            </textarea>
                            @error('alamat')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</x-app-layout>
