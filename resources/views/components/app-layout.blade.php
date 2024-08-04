<!DOCTYPE html>

<!-- beautify ignore:start -->
<html
  lang="en"
  class="light-style layout-menu-fixed"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="{{ asset('assets/') }}"
  data-template="vertical-menu-template-free"
>
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title>Absensi Dhuha MTSN 7 Agam</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/favicon/favicon.ico') }}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet"
    />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/boxicons.css') }}" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/core.css') }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/theme-default.css') }}" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />

    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/apex-charts/apex-charts.css') }}" />

    <!-- datatables CSS -->
    <link href="https://cdn.datatables.net/2.0.5/css/dataTables.bootstrap5.css" rel="stylesheet">
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
    

    <!-- Helpers -->
    <script src="{{ asset('assets/vendor/js/helpers.js') }}"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{ asset('assets/js/config.js') }}"></script>
  </head>

  <body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        
        @include('partials.menu')

        <!-- Layout container -->
        <div class="layout-page">

            @include('partials.navbar')

          <!-- Content wrapper -->
          <div class="content-wrapper">

            {{ $slot }}

           @include('partials.footer')

            <div class="content-backdrop fade"></div>
          </div>
          <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
      </div>

      <!-- Overlay -->
      <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->


    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="{{ asset('assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('assets/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>

    <script src="{{ asset('assets/vendor/js/menu.js') }}"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="{{ asset('assets/vendor/libs/apex-charts/apexcharts.js') }}"></script>

    <!-- Main JS -->
    <script src="{{ asset('assets/js/main.js') }}"></script>

    <!-- Page JS -->
    <script src="{{ asset('assets/js/dashboards-analytics.js') }}"></script>

    {{-- <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script> --}}

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>

    {{-- datatables jquery --}}
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.datatables.net/2.0.5/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.0.5/js/dataTables.bootstrap5.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    

    <script>
        $(document).ready(function() {
            $('#select2-field').select2({
                theme: 'bootstrap-5'
            });
            $('#table_kelas').DataTable();
            $('#table_guru').DataTable();

            function updateAjaxSiswa() {
                $('#cetak_laporan').attr('href',
                    `{{ route('siswa.laporan') }}?filter_kelas=${$('#filter_kelas').val()}`);
                $('#cetak_kartu').attr('href',
                    `{{ route('siswa.cetak_kartu') }}?filter_kelas=${$('#filter_kelas').val()}`);
                $('#table_siswa').DataTable().destroy();
                var list_siswa = $('#table_siswa').DataTable({
                    processing: true,
                    serverSide: true,
                    responsive: true,
                    ajax: `{{ route('siswa.ajax') }}?filter_kelas=${$('#filter_kelas').val()}`,
                    columns: [{
                            data: 'nisn'
                        },
                        {
                            data: 'nisn'
                        },
                        {
                            data: 'nama_lengkap'
                        },
                        {
                            data: 'nama_kelas'
                        },
                        {
                            data: 'alamat'
                        },
                        {
                            data: null
                        }
                    ],
                    columnDefs: [{
                            targets: 0,
                            data: null,
                            orderable: false,
                            render: function(data, type, row, meta) {
                                return meta.row + 1;
                            }
                        },
                        {
                            targets: -1,
                            data: 'id_siswa',
                            orderable: false,
                            render: function(data, type, row) {
                                console.log(data.id_siswa);
                                return `
                                    <div class="dropdown">
                                      <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                      </button>
                                      <div class="dropdown-menu">
                                        <a target="_blank" class="dropdown-item" href="/siswa/cetak_kartu?id=${data.id_siswa}"><i class="bx bx-id-card me-1"></i> Kartu Absensi</a>
                                        <a class="dropdown-item" href="/siswa/${data.id_siswa}/edit"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                                        <form action="/siswa/${data.id_siswa}" method="POST" class="d-inline">
                                          @csrf
                                          @method('DELETE')
                                          <button type="submit" class="dropdown-item">
                                            <i class="bx bx-trash me-1"></i> Hapus
                                          </button>
                                        </form>
                                      </div>
                                    </div>
                                  `;
                            }
                        }
                    ]
                });
            }
            updateAjaxSiswa();

            // Memperbarui data ketika filter berubah
            $('#filter_kelas').on('change', function() {
                console.log('filter kelas berubah');
                updateAjaxSiswa();
            });


            if (window.location.pathname == '/dashboard') {

                let cardColor, headingColor, axisColor, shadeColor, borderColor;

                cardColor = config.colors.white;
                headingColor = config.colors.headingColor;
                axisColor = config.colors.axisColor;
                borderColor = config.colors.borderColor;

                // Order Statistics Chart
                // --------------------------------------------------------------------


                $.ajax({
                    url: `{{ route('dashboard.statAbsenHariIni') }}`,
                    type: 'GET',
                    success: function(data) {
                        document.querySelector('#totalSiswa').textContent = data.total_siswa;
                        document.querySelector('#hadir').textContent =  `${data.hadir} / ${(data.hadir/data.total_siswa * 100).toFixed(2)}%`;
                        document.querySelector('#haid').textContent = `${data.haid} / ${(data.haid/data.total_siswa * 100).toFixed(2)}%`;
                        document.querySelector('#terlambat').textContent = `${data.terlambat} / ${(data.terlambat/data.total_siswa * 100).toFixed(2)}%`;
                        document.querySelector('#tidakHadir').textContent = `${data.tidak_hadir} / ${(data.tidak_hadir/data.total_siswa * 100).toFixed(2)}%`;
                        const chartOrderStatistics = document.querySelector('#orderStatisticsChart'),

                            orderChartConfig = {
                                chart: {
                                    height: 165,
                                    width: 130,
                                    type: 'donut'
                                },
                                labels: ['hadir', 'haid', 'terlambat', 'belum hadir'],
                                series: [data.hadir, data.haid, data.terlambat, data.tidak_hadir],
                                colors: [config.colors.success, config.colors.secondary, config.colors
                                    .warning, config.colors.danger
                                ],
                                stroke: {
                                    width: 5,
                                    colors: cardColor
                                },
                                dataLabels: {
                                    enabled: false,
                                    formatter: function(val, opt) {
                                        let gg = parseInt(val) / data.total_siswa * 100;
                                        return gg.toFixed(2) + '%';

                                    }
                                },
                                legend: {
                                    show: false
                                },
                                grid: {
                                    padding: {
                                        top: 0,
                                        bottom: 0,
                                        right: 15
                                    }
                                },
                                plotOptions: {
                                    pie: {
                                        donut: {
                                            size: '75%',
                                            labels: {
                                                show: true,
                                                value: {
                                                    fontSize: '1.5rem',
                                                    fontFamily: 'Public Sans',
                                                    color: headingColor,
                                                    offsetY: -15,
                                                    formatter: function(val) {
                                                        let gg = parseInt(val) / data.total_siswa *
                                                            100;
                                                        return gg.toFixed(2) + '%';
                                                    }
                                                },
                                                name: {
                                                    offsetY: 20,
                                                    fontFamily: 'Public Sans'
                                                },
                                                total: {
                                                    show: true,
                                                    fontSize: '0.8125rem',
                                                    color: axisColor,
                                                    label: 'absensi',
                                                    formatter: function(w) {
                                                        let hitung = (data.haid + data.hadir + data
                                                            .terlambat) / data.total_siswa * 100;
                                                        console.log(hitung);
                                                        return hitung.toFixed(2) + '%';
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            };
                        if (typeof chartOrderStatistics !== undefined && chartOrderStatistics !==
                            null) {
                            const statisticsChart = new ApexCharts(chartOrderStatistics,
                                orderChartConfig);
                            statisticsChart.render();
                        }
                    }
                });


                var siswaPerKelas = {
                    series: [{
                        name: 'Total Siswa',
                        data: []
                    }],
                    chart: {
                        type: 'bar',
                        height: 400
                    },
                    plotOptions: {
                        bar: {
                            horizontal: true,
                            columnWidth: '55%',
                            endingShape: 'rounded',
                            borderRadius: 4,
                            borderRadiusApplication: 'end',
                        },

                    },
                    dataLabels: {
                        enabled: true
                    },
                    stroke: {
                        show: true,
                        width: 2,
                        colors: ['transparent']
                    },
                    yaxis: {
                        title: {
                            text: 'Kelas'
                        },
                        reversed: true

                    },
                };
                var chart = new ApexCharts(document.querySelector("#chart"), siswaPerKelas);
                chart.render();

                $.ajax({
                    url: `{{ route('dashboard.siswaPerKelas') }}`,
                    type: 'GET',
                    success: function(data) {
                        chart.updateOptions({
                            xaxis: {
                                categories: data.map(function(item) {
                                    return item.nama_kelas;
                                })
                            },
                        });
                        chart.updateSeries([{
                            data: data.map(function(item) {
                                return item.total_siswa;
                            })
                        }]);
                    }
                });

                var options = {
                    series: [
                    ],
                    chart: {
                        height: 400,
                        type: 'line',
                        dropShadow: {
                            enabled: true,
                            color: '#000',
                            top: 18,
                            left: 7,
                            blur: 10,
                            opacity: 0.2
                        },
                        zoom: {
                            enabled: false
                        },
                        toolbar: {
                            show: false
                        }
                    },
                    colors: [config.colors.success, config.colors.secondary, config.colors
                                    .warning, config.colors.danger
                                ],
                    // dataLabels: {
                    //     enabled: true,
                    // },
                    stroke: {
                        curve: 'smooth'
                    },
                    title: {
                        text: 'Total Absensi Siswa Sebulan terakhir',
                        align: 'left'
                    },
                    grid: {
                        borderColor: '#e7e7e7',
                        row: {
                            colors: ['#f3f3f3',
                                'transparent'
                            ], // takes an array which will be repeated on columns
                            opacity: 0.5
                        },
                    },
                    markers: {
                        size: 1
                    },
                    xaxis: {
                        categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
                        title: {
                            text: 'Tanggal'
                        }
                    },
                    yaxis: {
                        title: {
                            text: 'Jumlah siswa'
                        },
                        min: 0,
                        max: 100
                    },
                    legend: {
                        position: 'top',
                        horizontalAlign: 'right',
                        floating: true,
                        offsetY: -25,
                        offsetX: -5
                    }
                };

                var chart2 = new ApexCharts(document.querySelector("#chart2"), options);
                chart2.render();
                
                $.ajax({
                    url: `{{ route('dashboard.statAbsenSebulanTerakhir') }}`,
                    type: 'GET',
                    success: function(data) {
                        chart2.updateOptions({
                            xaxis: {
                                categories: data.map(function(item) {
                                    return item.tanggal;
                                })
                            },
                            yaxis: {
                                max: data.total_siswa
                            }
                        });
                        chart2.updateSeries([{
                                name: "Hadir",
                                data: data.map(function(item) {
                                    return item.hadir;
                                })
                            },
                            {
                                name: "Haid",
                                data: data.map(function(item) {
                                    return item.haid;
                                })
                            },
                            {
                                name: "Terlambat",
                                data: data.map(function(item) {
                                    return item.terlambat;
                                })
                            },
                            {
                                name: "Tidak Hadir",
                                data: data.map(function(item) {
                                    return item.tidak_hadir;
                                })
                            }
                        ]);
                    }
                });
            }



            // ============== khusus halaman absensi ==============

            if (window.location.pathname == '/absensi') {

                let filter_kelas = $('#filter_kelas').val();
                let filter_nama = $('#select2-field').val();
                let filter_tanggal_dari = $('#filter_tanggal_dari').val();
                let filter_tanggal_sampai = $('#filter_tanggal_sampai').val();
                let filter_kehadiran = $('#filter_kehadiran').val();

                function updateAbsensi() {
                    console.log(filter_kelas, filter_nama, filter_tanggal_dari, filter_tanggal_sampai,
                        filter_kehadiran)
                    $('#cetak_laporan').attr('href',
                        `{{ route('absensi.laporan') }}?filter_kelas=${$('#filter_kelas').val()}&filter_nama=${$('#select2-field').val()}&filter_tanggal_dari=${$('#filter_tanggal_dari').val()}&filter_tanggal_sampai=${$('#filter_tanggal_sampai').val()}&filter_kehadiran=${$('#filter_kehadiran').val()}`
                    );
                    $('#absensi_siswa').DataTable().destroy();
                    $('#absensi_siswa').DataTable({
                        processing: true,
                        serverSide: true,
                        searching: false,
                        responsive: true,
                        ajax: `{{ route('absensi.ajax') }}?filter_kelas=${$('#filter_kelas').val()}&filter_nama=${$('#select2-field').val()}&filter_tanggal_dari=${$('#filter_tanggal_dari').val()}&filter_tanggal_sampai=${$('#filter_tanggal_sampai').val()}&filter_kehadiran=${$('#filter_kehadiran').val()}`,
                        columns: [{
                                data: 'nisn'
                            },
                            {
                                data: 'nisn'
                            },
                            {
                                data: 'nama_lengkap'
                            },
                            {
                                data: 'nama_kelas'
                            },
                            {
                                data: 'tanggal'
                            },
                            {
                                data: 'kehadiran'
                            },
                            {
                                data: 'waktu_absensi'
                            },
                        ],
                        columnDefs: [{
                                targets: 0,
                                data: null,
                                orderable: false,
                                render: function(data, type, row, meta) {
                                    console.log(row);
                                    return meta.row + 1;
                                }
                            },
                            {
                                targets: 5,
                                data: 'kehadiran',
                                render: function(data, type, row) {
                                    if (data == 'hadir') {
                                        return `<span class="text-success">Hadir</span>`;
                                    } else if (data == 'terlambat') {
                                        return `<span class="text-warning">Terlambat</span>`;
                                    } else if (data == 'haid') {
                                        return `<span class="text-secondary">Haid</span>`;
                                    } else {
                                        return `<span class="text-danger">Belum Absensi</span>`;
                                    }
                                }
                            },
                            {
                                targets: 6,
                                data: 'waktu_absensi',
                                render: function(data, type, row) {
                                    if (data == null) {
                                        return `-`;
                                    } else {
                                        return data;
                                    }
                                }
                            }
                        ]
                    });
                }

                updateAbsensi();
                // Memperbarui data ketika filter berubah

                $('#filter_kelas').on('change', function() {
                    $('#title-kelas').text(`Absensi Siswa Kelas ${$('#filter_kelas option:selected').text()}`);
                    console.log('filter kelas berubah');
                    updateAbsensi();
                });

                $('#select2-field').on('change', function() {
                    console.log('filter nama berubah');
                    updateAbsensi();
                });

                $('#filter_tanggal_dari').on('change', function() {
                    console.log('filter tanggal dari berubah');
                    $('#label_tanggal').text($('#filter_tanggal_dari').val() + " - " + $('#filter_tanggal_sampai')
                        .val());
                    updateAbsensi();

                });

                $('#filter_tanggal_sampai').on('change', function() {
                    console.log('filter tanggal sampai berubah');
                    $('#label_tanggal').text($('#filter_tanggal_dari').val() + " - " + $('#filter_tanggal_sampai')
                        .val());
                    updateAbsensi();
                });

                $('#filter_kehadiran').on('change', function() {
                    console.log('filter kehadiran berubah');
                    updateAbsensi();
                });

                $('#label_tanggal').text($('#filter_tanggal_dari').val() + " - " + $('#filter_tanggal_sampai').val());
                $('#title-kelas').text(`Absensi Siswa Kelas ${$('#filter_kelas option:selected').text()}`);


            }


            // ============== khusus halaman history ==============

            if (window.location.pathname == '/history') {

                let filter_kelas = $('#filter_kelas').val();
                let filter_nama = $('#select2-field').val();
                let filter_tanggal_dari = $('#filter_tanggal_dari').val();
                let filter_tanggal_sampai = $('#filter_tanggal_sampai').val();
                let filter_kehadiran = $('#filter_kehadiran').val();

                function updateHistoryAbsensi() {

                    console.log(filter_kelas, filter_nama, filter_tanggal_dari, filter_tanggal_sampai,
                        filter_kehadiran)

                    $('#table_history_absensi').DataTable().destroy();
                    $('#table_history_absensi').DataTable({
                        processing: true,
                        serverSide: true,
                        responsive: true,
                        ajax: `{{ route('history.ajax') }}?filter_kelas=${$('#filter_kelas').val()}&filter_nama=${$('#select2-field').val()}&filter_tanggal_dari=${$('#filter_tanggal_dari').val()}&filter_tanggal_sampai=${$('#filter_tanggal_sampai').val()}&filter_kehadiran=${$('#filter_kehadiran').val()}`,
                        columns: [{
                                data: 'id_absensi'
                            },
                            {
                                data: 'nisn'
                            },
                            {
                                data: 'nama_lengkap'
                            },
                            {
                                data: 'nama_kelas'
                            },
                            {
                                data: 'kehadiran'
                            },
                            {
                                data: 'tanggal'
                            },
                            {
                                data: 'jam_hadir'
                            },
                            {
                                data: null
                            }
                        ],
                        columnDefs: [{
                                targets: 0,
                                data: null,
                                orderable: false,
                                render: function(data, type, row, meta) {
                                    return meta.row + 1;
                                }
                            },
                            {
                                targets: -1,
                                data: 'id_siswa',
                                orderable: false,
                                render: function(data, type, row) {
                                    console.log(row.id_absensi);
                                    return `
                                    <div class="dropdown">
                                      <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                      </button>
                                      <div class="dropdown-menu">
                                        <form action="/history/${row.id_absensi}" method="POST" class="d-inline">
                                          @csrf
                                          @method('DELETE')
                                          <button type="submit" class="dropdown-item">
                                            <i class="bx bx-trash me-1"></i> Hapus
                                          </button>
                                        </form>
                                      </div>
                                    </div>
                                  `;
                                }
                            }
                        ]
                    });
                }

                updateHistoryAbsensi();
                // Memperbarui data ketika filter berubah

                $('#filter_kelas').on('change', function() {
                    console.log('filter kelas berubah');
                    updateHistoryAbsensi();
                });

                $('#select2-field').on('change', function() {
                    console.log('filter nama berubah');
                    updateHistoryAbsensi();
                });

                $('#filter_tanggal_dari').on('change', function() {
                    console.log('filter tanggal dari berubah');
                    updateHistoryAbsensi();
                });

                $('#filter_tanggal_sampai').on('change', function() {
                    console.log('filter tanggal sampai berubah');
                    updateHistoryAbsensi();
                });

                $('#filter_kehadiran').on('change', function() {
                    console.log('filter kehadiran berubah');
                    updateHistoryAbsensi();
                });


            }

        });
    </script>
  </body>
</html>
