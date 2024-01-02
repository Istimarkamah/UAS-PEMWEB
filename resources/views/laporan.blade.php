<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Daftar Buku</title>
    <style>
        table,
        td,
        th {
            border: 1px solid;
            text-align: center;
            font-size: 15px
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        .title {
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <div class="title">
        <h1>Laporan Daftar Buku</h1>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Judul</th>
                <th>Penulis</th>
                <th>Tahun Terbit</th>
                <th>Genre</th>
                <th>Deskripsi</th>
              
            </tr>
        </thead>
        <tbody>
            @php
                $no = 1;
            @endphp
            @foreach ($datas as $data)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $data->judul }}</td>
                    <td>{{ $data->penulis }}</td>
                    <td>{{ $data->tahun_terbit }}</td>
                    <td>{{ $data->genre }}</td>
                    <td>{{ $data->deskripsi }}</td>
                   
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
