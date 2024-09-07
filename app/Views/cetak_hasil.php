<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print Result</title>
    <style>
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
    <h1>Print Result</h1>
    <table class="table">
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
            <?php if (!empty($formulir)): ?>
                <?php foreach ($formulir as $key => $row): ?>
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
            <?php else: ?>
                <tr>
                    <td colspan="8">No data available for the selected date range.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>
