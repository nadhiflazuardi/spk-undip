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
            <tbody>
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
                        <div class="progress w-100" style="height: 10px" role="progressbar" aria-label="Basic example"
                          aria-valuenow="{{ round(($log['total'] * 100) / $log['target']) }}" aria-valuemin="0"
                          aria-valuemax="100">

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
@endsection

@section('scripts')
  <script>
    $(document).ready(function() {
      $('#pribadiTable').DataTable();

      // hide datatable pagination and search, but only the first occurence
      $('.dt-length').first().hide();
      $('.dt-search').first().hide();
      $('.dt-info').first().hide();
      $('.dt-paging').first().hide();
    });
  </script>
@endsection
