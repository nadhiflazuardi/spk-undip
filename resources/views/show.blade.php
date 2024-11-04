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
                    <h1>Rekapitulasi Kinerja Pegawai Tahun {{ now()->format('Y') }}</h1>
                </div>
                <br>
                <div>
                    <div class="d-flex align-items-center justify-content-between">
                        <h2>{{ $pegawai->nama }}</h2>
                    </div>
                    <form class="row g-3 " id="filterForm">
                        <span>Filter Menurut tanggal</span>
                        <div class="col-auto">
                            <label for="inputStartDate" class="visually-hidden">TanggalMulai</label>
                            <input type="date" class="form-control" id="inputStartDate" placeholder="TanggalMulai">
                        </div>
                        <p class="col-auto p-0">Hingga</p>
                        <div class="col-auto">
                            <label for="inputEndDate" class="visually-hidden">TanggalMulai</label>
                            <input type="date" class="form-control" id="inputEndDate" placeholder="TanggalMulai">
                        </div>
                        <div class="col-auto">
                            <button type="submit" class="btn btn-primary mb-3">Filter Data</button>
                        </div>
                    </form>
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
                </div>
            </div>
        </div>
    </div>
    <div class="top-0 position-fixed start-50 translate-middle-x p-3">
      <div class="toast align-items-center text-bg-success border-0 " role="alert" aria-live="assertive" aria-atomic="true" id="toastBerhasil">
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
      <div class="toast align-items-center text-bg-danger border-0 " role="alert" aria-live="assertive" aria-atomic="true" id="toastGagal">
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
                    let percentage = log.total == 0 || log.total == null || log.target == 0 || log.target == null ? 0 : Math.round((log.total * 100) / log.target);
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

            function fetchData(startDate, endDate) {
                $.ajax({
                    url: 'http://e-office-undip.test/api/log/' + {{ $pegawai->id }},
                    type: 'GET',
                    data: {
                        startDate: startDate,
                        endDate: endDate
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
                const startDate = $('#inputStartDate').val();
                const endDate = $('#inputEndDate').val();

                if (!startDate || !endDate) {
                    alert('Mohon isi kedua tanggal');
                    return;
                }

                fetchData(startDate, endDate);
            });
        });
    </script>
@endsection
