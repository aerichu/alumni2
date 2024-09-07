


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan PDF</title>
    <style>
        /* Tambahkan gaya CSS sesuai kebutuhan */
        body {
            font-family: Arial, sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #dddddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

    <h2>Laporan PDF</h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>nama</th>
                <th>posisi</th>
                <th>lokasi</th>
                <th>batas lamaran</th>
                <th>syarat</th>
                <th>kontak</th>
                <th>jenis pekerjaan</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($laporan as $key => $row) : ?>
                <tr>
                    <td><?= $key + 1 ?></td>
                    <td><?= $row->nama ?></td>
                    <td><?= $row->posisi ?></td>
                    <td><?= $row->lokasi ?></td>
                    <td><?= $row->batas_lamaran ?></td>
                    <td><?= $row->syarat ?></td>
                    <td><?= $row->contact ?></td>
                    <td><?= $row->jenis_pekerjaan ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
