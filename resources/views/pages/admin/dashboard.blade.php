@extends('layouts.main')
@section('title', 'Dashboard')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Dashboard</h1>
    </div>

    <div class="section-body">
        <div class="row">
            <!-- Kartu Statistik -->
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <a href="{{ route('siswa.index') }}" style="text-decoration: none; color: inherit;">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary">
                            <i class="fas fa-users"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Jumlah Siswa</h4>
                            </div>
                            <div class="card-body">{{ $siswa }}</div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <a href="{{ route('mapel.index') }}" style="text-decoration: none; color: inherit;">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-success">
                            <i class="fas fa-book"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Jumlah Mata Pelajaran</h4>
                            </div>
                            <div class="card-body">{{ $mapel }}</div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <a href="{{ route('guru.index') }}" style="text-decoration: none; color: inherit;">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-warning">
                            <i class="fas fa-user"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Jumlah Guru</h4>
                            </div>
                            <div class="card-body">{{ $guru }}</div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <a href="{{ route('kelas.index') }}" style="text-decoration: none; color: inherit;">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-danger">
                            <i class="fas fa-user"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Jumlah Kelas</h4>
                            </div>
                            <div class="card-body">{{ $kelas }}</div>
                        </div>
                    </div>
                </a>
            </div>
        </div>

        <!-- Grafik -->
        <div class="row mt-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Grafik Jumlah Siswa dan Guru</h4>
                    </div>
                    <div class="card-body">
                        <canvas id="chartSiswaGuru" height="100"></canvas>

                        <!-- Tombol Export -->
                        <button id="exportExcel" class="btn btn-success mt-3 ml-2">Export Grafik ke Excel</button>
                        <button id="exportDataExcel" class="btn btn-info mt-3 ml-2">Export Data ke Excel</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabel Data -->
        {{-- <div class="row">
            <div class="col-12">
                <h5 class="mt-4">Data Siswa</h5>
                <table id="tabelSiswa" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Kelas</th>
                            <th>NIS</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dataSiswa as $s)
                        <tr>
                            <td>{{ $s->nama }}</td>
                            <td>{{ optional($s->kelas)->nama_kelas ?? '-' }}</td>
                            <td>{{ $s->nis }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>


                <h5 class="mt-4">Data Guru</h5>
                <table id="tabelGuru" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Mapel</th>
                            <th>NIP</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dataGuru as $g)
                        <tr>
                            <td>{{ $g->nama }}</td>
                            <td>{{ optional($g->mapel)->nama_mapel ?? '-' }}</td>
                            <td>{{ $g->nip }}</td> <!-- Menambahkan kolom NIP -->
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div> --}}


    </div>
</section>

<!-- SCRIPT -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.3/xlsx.full.min.js"></script>

<script>
    const ctx = document.getElementById('chartSiswaGuru').getContext('2d');
    const chart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Siswa', 'Guru'],
            datasets: [{
                label: '',
                data: [{{ $siswa }}, {{ $guru }}],
                backgroundColor: ['#6777ef', '#ffa426'],
                borderWidth: 1,
                maxBarThickness: 40
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        precision: 0,
                        stepSize: 1
                    }
                }
            }
        }
    });

//  document.getElementById('exportPDF').addEventListener('click', function () {
//     console.log("Tombol exportPDF ditekan!"); // Log ini untuk memeriksa apakah event diterima
//     setTimeout(function () {
//         const chartElement = document.getElementById('chartSiswaGuru');
        
//         if (!chartElement) {
//             console.error('Elemen chartSiswaGuru tidak ditemukan!');
//             return;
//         }

//         console.log('Elemen chartSiswaGuru ditemukan:', chartElement); // Memastikan elemen ditemukan

//         html2canvas(chartElement, {
//             scale: 2,
//             logging: true,
//             useCORS: true
//         }).then(function (canvas) {
//             const { jsPDF } = window.jspdf;
//             const pdf = new jsPDF('landscape', 'mm', 'a4');
//             const imgData = canvas.toDataURL('image/png');
//             pdf.addImage(imgData, 'PNG', 10, 10, 280, 140);
//             pdf.save("chart-siswa-guru.pdf");
//         }).catch(function (error) {
//             console.error('Terjadi kesalahan saat mengambil gambar:', error);
//         });
//     }, 500);
// });



    // Export Chart ke Excel
    document.getElementById('exportExcel').addEventListener('click', function () {
        const data = [
            ['Kategori', 'Jumlah'],
            ['Siswa', {{ $siswa }}],
            ['Guru', {{ $guru }}]
        ];
        const worksheet = XLSX.utils.aoa_to_sheet(data);
        const workbook = XLSX.utils.book_new();
        XLSX.utils.book_append_sheet(workbook, worksheet, 'Grafik');
        XLSX.writeFile(workbook, 'grafik-siswa-guru.xlsx');
    });

    document.getElementById('exportDataExcel').addEventListener('click', function () {
        const wb = XLSX.utils.book_new();

        // Data siswa
        const siswaData = [['Nama', 'Kelas', 'NIS']];
        @foreach ($dataSiswa as $s)
            siswaData.push([ '{{ $s->nama }}', '{{ optional($s->kelas)->nama_kelas ?? '-' }}', '{{ $s->nis }}' ]);
        @endforeach
        const wsSiswa = XLSX.utils.aoa_to_sheet(siswaData);
        XLSX.utils.book_append_sheet(wb, wsSiswa, 'Data Siswa');

        // Data guru
        const guruData = [['Nama', 'Mapel', 'NIP']];
        @foreach ($dataGuru as $g)
            guruData.push([ '{{ $g->nama }}', '{{ optional($g->mapel)->nama_mapel ?? '-' }}', '{{ $g->nip }}' ]);
        @endforeach
        const wsGuru = XLSX.utils.aoa_to_sheet(guruData);
        XLSX.utils.book_append_sheet(wb, wsGuru, 'Data Guru');

        XLSX.writeFile(wb, 'data-siswa-guru.xlsx');
    });


</script>


@endsection