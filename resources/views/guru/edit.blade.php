<x-app-layout>

    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Edit Data Guru</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('guru.update', $guru->id_guru) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="nip" class="form-label">NIP</label>
                        <input type="text" class="form-control" id="nip" name="nip" value="{{ $guru->nip }}">
                    </div>
                    <div class="mb-3">
                        <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" value="{{ $guru->nama_lengkap }}">
                    </div>
                    <div class="mb-3">
                        <label for="mapel" class="form-label">Mata Pelajaran</label>
                        <input type="text" class="form-control" id="mapel" name="mapel" value="{{ $guru->mapel }}">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ $guru->email }}">
                    </div>
                    <div class="mb-3">
                        <label for="no_hp" class="form-label">No. Telepon</label>
                        <input type="text" class="form-control" id="no_hp" name="no_hp" value="{{ $guru->no_hp }}">
                    </div>
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username" name="username" value="{{ $guru->username }}">
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>