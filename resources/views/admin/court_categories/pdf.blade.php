<!DOCTYPE html>
<html>

<head>
    <title>Laporan Data Kategori Lapangan</title>
    <style>
        body {
            font-family: sans-serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
            font-size: 12px;
        }

        th {
            background-color: #f2f2f2;
            color: #333;
        }

        h2 {
            text-align: center;
            color: #333;
        }

        .meta {
            margin-bottom: 20px;
            font-size: 12px;
            color: #666;
        }
    </style>
</head>

<body>
    <h2>Laporan Data Kategori Lapangan</h2>
    <div class="meta">
        <p>Dicetak pada: {{ now()->format('d M Y H:i:s') }}</p>
        <p>Total Kategori: {{ $categories->count() }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th style="width: 5%">No</th>
                <th style="width: 30%">Nama Kategori</th>
                <th style="width: 45%">Deskripsi</th>
                <th style="width: 20%">Jumlah Lapangan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $index => $category)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $category->category_name }}</td>
                    <td>{{ $category->description ?? '-' }}</td>
                    <td>{{ $category->courts->count() }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>