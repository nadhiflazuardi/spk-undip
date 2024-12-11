<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Kinerja Pegawai</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
            font-size: 12pt;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        .title {
            font-weight: bold;
            margin-bottom: 5px;
        }
        .subtitle {
            font-weight: bold;
            margin-bottom: 20px;
        }
        .biodata {
            margin-bottom: 20px;
        }
        .biodata-item {
            margin-bottom: 5px;
        }
        .biodata-label {
            display: inline-block;
            width: 120px;
        }
        .separator {
            display: inline-block;
            width: 15px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            margin-bottom: 50px;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
        }
        th {
            text-align: center;
            font-weight: bold;
        }
        .signature {
            text-align: right;
            margin-right: 50px;
        }
        .signature-text {
            margin-bottom: 60px;
        }
        .signature-name, .signature-title {
            text-align: center;
            width: 200px;
            float: right;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="title">LAPORAN KINERJA PEGAWAI</div>
        <div class="subtitle">UNIVERSITAS DIPONEGORO</div>
    </div>

    <div class="biodata">
        <div class="biodata-item">
            <span class="biodata-label">Nama Pegawai</span>
            <span class="separator">:</span>
            <span>{{$pegawai->nama}}</span>
        </div>
        <div class="biodata-item">
            <span class="biodata-label">NIP</span>
            <span class="separator">:</span>
            <span>{{$pegawai->id}}</span>
        </div>
        <div class="biodata-item">
            <span class="biodata-label">Jabatan</span>
            <span class="separator">:</span>
            <span>{{$pegawai->jabatan}}</span>
        </div>
        <div class="biodata-item">
            <span class="biodata-label">Periode Penilaian</span>
            <span class="separator">:</span>
            <span>{{$bulan . " " . $tahun}}</span>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th>Tugas</th>
                <th>Target</th>
                <th>Realisasi</th>
                <th>Persentase</th>
            </tr>
        </thead>
        <tbody>
            @foreach($logs as $item)
            <tr>
                <td>{{$item['nama']}}</td>
                <td style="text-align: center">{{$item['target'] ? $item['target'] . ' menit' : '-'}}</td>
                <td style="text-align: center">{{$item['total'] ? $item['total'] . ' menit' : '-'}}</td>
                <td style="text-align: center">{{$item['target'] ?  round(($item['total'] * 100) / $item['target']) . "%" : '-'}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="signature">
        <div class="signature-text">Mengetahui,</div>
        <div class="signature-name">{{$atasan_langsung ?? 'Contoh'}}</div>
        <div class="signature-title">{{$jabatan_atasan ?? 'Contoh'}}</div>
    </div>
</body>
</html>