@extends('layouts.app')

@section('content')
    <style>
        table.dataTable {
            /* Biar garisnya rapet */
            border-collapse: collapse;
        }

        table.dataTable th,
        table.dataTable td {
            /* Atur warna dan ukuran garisnya */
            border: 1px solid #ddd;
        }
    </style>
    <div class="d-flex justify-content-center">
        <div class="me-4 mb-4 px-3 py-5 ms-4 shadow mt-3" style="background-color: white; width: 75%; border-radius: 10px;">
            <div class="ms-3">
                {{ Breadcrumbs::render() }}
            </div>
            <div class="container">
                <div class="border-bottom border-black">
                    <h1>Rekapitulasi Kinerja Pegawai</h1>
                </div>
                <br>
                <div>
                    <div class="d-flex align-items-center justify-content-between">
                        <h2>{{ $pegawai->nama }}</h2>
                    </div>
                    <!-- Button trigger modal -->
                    {{-- <button id="cetakLaporanButton" class="btn btn-primary" type="button" data-bs-target="#exampleModal" data-bs-toggle="modal">
                        Cetak Laporan Kinerja Pegawai
                    </button> --}}

                    <!-- Modal -->
                    {{-- <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Cetak Laporan Kinerja Pegawai</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <form action="{{ route('kinerja.download', ['id' => $pegawai->id]) }}">
                                    <div class="modal-body">
                                        <p>Silahkan pilih periode penilaian kinerja</p>
                                        <div class="d-flex gap-1">
                                            <div class="flex-grow-1">
                                                <select
                                                    class="form-select @error('bulan')
                                                    is-invalid
                                                @enderror"
                                                    name="bulan" aria-label="Default select example">
                                                    <option selected>Pilih Bulan</option>
                                                    <option value="01" @selected(old('bulan') == '01')>Januari</option>
                                                    <option value="02" @selected(old('bulan') == '02')>Februari</option>
                                                    <option value="03" @selected(old('bulan') == '03')>Maret</option>
                                                    <option value="04" @selected(old('bulan') == '04')>April</option>
                                                    <option value="05" @selected(old('bulan') == '05')>Mei</option>
                                                    <option value="06" @selected(old('bulan') == '06')>Juni</option>
                                                    <option value="07" @selected(old('bulan') == '07')>Juli</option>
                                                    <option value="08" @selected(old('bulan') == '08')>Agustus</option>
                                                    <option value="09" @selected(old('bulan') == '09')>September</option>
                                                    <option value="10" @selected(old('bulan') == '10')>Oktober</option>
                                                    <option value="11" @selected(old('bulan') == '11')>November</option>
                                                    <option value="12" @selected(old('bulan') == '12')>Desember</option>
                                                </select>
                                                @error('bulan')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="flex-grow-1">
                                                <select
                                                    class="form-select @error('tahun')
                                                    is-invalid 
                                                @enderror"
                                                    name="tahun" aria-label="Default select example">
                                                    <option selected>Pilih Tahun</option>
                                                    @for ($i = 0; $i < 10; $i++)
                                                        <option value="{{ date('Y') - $i }}" @selected(old('tahun') == date('Y') - $i)>
                                                            {{ date('Y') - $i }}</option>
                                                    @endfor
                                                </select>
                                                @error('tahun')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-primary">Cetak Laporan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div> --}}
                    <form class="row g-3 " id="filterForm">
                        <span>Filter data berdasarkan bulan</span>
                        <div class="d-flex gap-1 w-50">
                            <div class="flex-grow-1">
                                <select
                                    class="form-select @error('bulan')
                                                    is-invalid
                                                @enderror"
                                    name="bulan" aria-label="Default select example" id="bulanInput">
                                    <option selected value="">Pilih Bulan</option>
                                    <option value="01" @selected(old('bulan') == '01')>Januari</option>
                                    <option value="02" @selected(old('bulan') == '02')>Februari</option>
                                    <option value="03" @selected(old('bulan') == '03')>Maret</option>
                                    <option value="04" @selected(old('bulan') == '04')>April</option>
                                    <option value="05" @selected(old('bulan') == '05')>Mei</option>
                                    <option value="06" @selected(old('bulan') == '06')>Juni</option>
                                    <option value="07" @selected(old('bulan') == '07')>Juli</option>
                                    <option value="08" @selected(old('bulan') == '08')>Agustus</option>
                                    <option value="09" @selected(old('bulan') == '09')>September</option>
                                    <option value="10" @selected(old('bulan') == '10')>Oktober</option>
                                    <option value="11" @selected(old('bulan') == '11')>November</option>
                                    <option value="12" @selected(old('bulan') == '12')>Desember</option>
                                </select>
                                @error('bulan')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="flex-grow-1">
                                <select
                                    class="form-select @error('tahun')
                                                    is-invalid 
                                                @enderror"
                                    name="tahun" aria-label="Default select example" id="tahunInput">
                                    <option selected value="">Pilih Tahun</option>
                                    @for ($i = 0; $i < 10; $i++)
                                        <option value="{{ date('Y') - $i }}" @selected(old('tahun') == date('Y') - $i)>
                                            {{ date('Y') - $i }}</option>
                                    @endfor
                                </select>
                                @error('tahun')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-auto">
                                <button type="submit" class="btn btn-primary mb-3">Filter Data</button>
                            </div>
                        </div>
                        {{-- <div class="col-auto">
                            <label for="inputStartDate" class="visually-hidden">TanggalMulai</label>
                            <input type="date" class="form-control" id="inputStartDate" placeholder="TanggalMulai">
                        </div>
                        <p class="col-auto p-0">Hingga</p>
                        <div class="col-auto">
                            <label for="inputEndDate" class="visually-hidden">TanggalMulai</label>
                            <input type="date" class="form-control" id="inputEndDate" placeholder="TanggalMulai">
                        </div> --}}

                    </form>
                    <p class="text-center fw-semibold">Menampilkan Data Kinerja <span
                            id="range">{{ now()->format('F Y') }}</span></p>
                    <table id="pribadiTable" class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col" class="text-center w-25" style="color: #144272">Tugas</th>
                                <th scope="col" class="text-center" style="max-width: 50px; color: #144272">Target</th>
                                <th scope="col" class="text-center" style="max-width: 50px; color: #144272">Terpenuhi
                                </th>
                                <th scope="col" class="text-center" style="color: #144272">Persentase</th>
                            </tr>
                        </thead>
                        <tbody id="logTableBody">
                            @foreach ($logs as $log)
                                <tr>
                                    <td>{{ $log['nama'] }}</td>
                                    @if ($log['target'] == 0)
                                        <td class="text-center">-</td>
                                    @else
                                        <td class="text-center">{{ $log['target'] }} menit</td>
                                    @endif
                                    <td class="text-center">{{ $log['total'] }} menit</td>
                                    <td>
                                        @if ($log['target'] == 0)
                                            <div class="text-center">-</div>
                                        @else
                                            <div class="d-flex align-items-center gap-1">
                                                <div class="progress w-100" style="height: 10px" role="progressbar"
                                                    aria-label="Basic example"
                                                    aria-valuenow="{{ round(($log['total'] * 100) / $log['target']) }}"
                                                    aria-valuemin="0" aria-valuemax="100">

                                                    <div class="progress-bar"
                                                        style="width: {{ round(($log['total'] * 100) / $log['target']) }}%; background-color: #144272">
                                                    </div>
                                                </div>
                                                <span class="fs-6 fw-semibold">
                                                    {{ round(($log['total'] * 100) / $log['target']) }}%</span>
                                            </div>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <button id="cetakLaporanButton" class="btn btn-primary" type="button">
                        Cetak Laporan Kinerja Pegawai
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="top-0 position-fixed start-50 translate-middle-x p-3">
        <div class="toast align-items-center text-bg-success border-0 " role="alert" aria-live="assertive"
            aria-atomic="true" id="toastBerhasil">
            <div class="d-flex">
                <div class="toast-body">
                    Data berhasil dimuat
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                    aria-label="Close"></button>
            </div>
        </div>
    </div>
    <div class="top-0 position-fixed start-50 translate-middle-x p-3">
        <div class="toast align-items-center text-bg-danger border-0 " role="alert" aria-live="assertive"
            aria-atomic="true" id="toastGagal">
            <div class="d-flex">
                <div class="toast-body">
                    Data gagal dimuat. Mohon coba lagi
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                    aria-label="Close"></button>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    @if ($errors->any())
        <script>
            $(document).ready(function() {
                $('#exampleModal').modal('show');
            });
        </script>
    @endif
    <script>
        $(document).ready(function() {
            var table = $('#pribadiTable').DataTable({
                searching: false,
                paging: false,
                info: false
            });
            const toastBerhasil = new bootstrap.Toast(document.getElementById('toastBerhasil'));
            const toastGagal = new bootstrap.Toast(document.getElementById('toastGagal'));
            // Function untuk render baris tabel
            function renderTableRow(log) {
                let targetCell = log.target == 0 || log.target == null ? '-' : `${log.target} menit`;
                let percentageCell = '';

                if (log.target == 0) {
                    percentageCell = '<div class="text-center">-</div>';
                } else {
                    let percentage = log.total == 0 || log.total == null || log.target == 0 || log.target == null ?
                        0 : Math.round((log.total * 100) / log.target);
                    percentageCell = `
                <div class="d-flex align-items-center gap-1">
                    <div class="progress w-100" style="height: 10px" role="progressbar" 
                         aria-label="Basic example" aria-valuenow="${percentage}"
                         aria-valuemin="0" aria-valuemax="100">
                        <div class="progress-bar" 
                             style="width: ${percentage}%; background-color: #144272">
                        </div>
                    </div>
                    <span class="fs-6 fw-semibold">${percentage}%</span>
                </div>
            `;
                }

                return `
            <tr>
                <td>${log.nama}</td>
                <td class="text-center">${targetCell}</td>
                <td class="text-center">${log.total} menit</td>
                <td>${percentageCell}</td>
            </tr>
        `;
            }


            // Function untuk update tabel
            function updateTable(data) {
                // console.log(table);
                table.destroy();

                let tableContent = '';
                data.forEach(log => {
                    tableContent += renderTableRow(log);
                });
                console.log(tableContent);
                $('#logTableBody').empty();
                $('#logTableBody').append(tableContent);

                table = $('#pribadiTable').DataTable({
                    searching: false,
                    paging: false,
                    info: false
                });
            }

            function fetchData(bulanInput, tahunInput) {
                $.ajax({
                    url: 'http://e-office-undip.test/api/log/' + {{ $pegawai->id }},
                    type: 'GET',
                    data: {
                        bulan: bulanInput,
                        tahun: tahunInput
                    },
                    success: function(response) {
                        updateTable(response.data); // Asumsikan response.data berisi array logs
                        toastBerhasil.show();
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching data:', error);
                        $('#toastGagal').show();
                    }
                })
            }

            $('#filterForm').submit(function(e) {
                e.preventDefault();
                const bulanInput = $('#bulanInput').val();
                const tahunInput = $('#tahunInput').val();
                if (!bulanInput || !tahunInput) {
                    alert('Mohon isi bulan dan tanggal');
                    return;
                }
                const bulan = Intl.DateTimeFormat('id', {
                    month: 'long'
                }).format(new Date(bulanInput));


                fetchData(bulanInput, tahunInput);

                $('#range').text(bulan + ' ' + tahunInput);
            });

            $("#cetakLaporanButton").click(function() {
                const bulanInput = $('#bulanInput').val() ?? "{{ now()->month }}";
                const tahunInput = $('#tahunInput').val() ?? "{{ now()->year }}";
                console.log(bulanInput, tahunInput);
                if (!bulanInput && !tahunInput) {
                    window.location.href =
                        `https://spk-undip.test/kinerja-pegawai/{{ $pegawai->id }}/download?bulan={{ now()->month }}&tahun={{ now()->year }}`;
                    return;
                }
                // if (!bulanInput || !tahunInput) {
                //     alert('Mohon isi tanggal dan tahun dengan lengkap');
                //     return;
                // }

                const bulan = Intl.DateTimeFormat('id', {
                    month: 'long'
                }).format(new Date(bulanInput));


                window.location.href =
                    `https://spk-undip.test/kinerja-pegawai/{{ $pegawai->id }}/download?bulan=${bulanInput}&tahun=${tahunInput}`;;
            });
        });
    </script>
@endsection
