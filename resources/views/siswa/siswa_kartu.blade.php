<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Card with Image and Biodata</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #f0f0f0;
        }
        .card {
            width: 10cm; /* Memperbesar lebar kartu */
            border: 1px solid #ccc;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            background-color: #fff;
        }
        .card-header {
            display: flex;
            align-items: center;
            background-color: #4CAF50;
            color: white;
            padding: 10px;
        }
        .card-header img {
            width: 40px; /* Memperbesar ukuran logo */
            height: 40px;
            margin-right: 10px;
        }
        .card-header h1 {
            margin: 0;
            font-size: 1.5em; /* Memperbesar ukuran teks nama instansi */
        }
        .separator {
            border-top: 1px solid #ccc;
            margin: 0 15px;
        }
        .card-body {
            display: flex;
            padding: 15px; /* Memperbesar padding untuk konten kartu */
        }
        .card-body svg {
            width: 120px; /* Memperbesar ukuran gambar */
            height: 120px;
            margin-right: 20px; /* Menambah space antara gambar dan biodata */
        }
        .card-body .biodata {
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        .card-body .biodata p {
            margin: 0;
            font-size: 1.1em; /* Memperbesar ukuran teks biodata */
        }
        @media print {
            body {
                justify-content: flex-start;
                align-items: flex-start;
                height: auto;
                background-color: #fff;
            }
            .card {
                box-shadow: none;
                border: 1px solid #000;
            }
        }
    </style>
</head>
<body>

<div class="card">
    <div class="card-header">
        <img src="{{ asset('assets/img/logo_mts7agam.png') }}" alt="Logo">
        <h1>MTS Negeri 7 Agam</h1>
    </div>
    <div class="separator"></div>
    <div class="card-body">
        {{ $qrcode }}
        <div class="biodata">
            <table>
                <tr>
                    <td>Nama</td>
                    <td>:</td>
                    <td>{{ $siswa->nama_lengkap }}</td>
                </tr>
                <tr>
                    <td>Kelas</td>
                    <td>:</td>
                    <td>{{ $siswa->nama_kelas }}</td>
                </tr>
                <tr>
                    <td>Alamat</td>
                    <td>:</td>
                    <td>{{ $siswa->alamat }}</td>
                </tr>
            </table>
        </div>
    </div>
</div>

</body>
</html>
