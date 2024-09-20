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
                <th>Nama Guru</th>
                <th>Kerajinan Guru</th>
                <th>Silabus</th>
                <th>Modul</th>
                <th>CV</th>
                <th>ATP</th>
                <th>Prota</th>
                <th>Media Belajar</th>
                <th>Kekreatifan</th>
                <th>Keterangan</th>
                <th>Materi</th>
                <th>Detail</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($formulir)): ?>
                <?php foreach ($formulir as $key => $row): ?>
                    <tr>
                        <td><?= $key + 1 ?></td>
                        <td><?= $row->nama_guru ?></td>
                        <td><?= $row->kerajinan_guru ?></td>
                        <td><?= $row->silabus ?></td>
                        <td><?= $row->modul ?></td>
                        <td><?= $row->cv ?></td>
                        <td><?= $row->atp ?></td>
                        <td><?= $row->prota ?></td>
                        <td><?= $row->media_pembelajaran ?></td>
                        <td><?= $row->kreatif ?></td>
                        <td><?= $row->keterangan ?></td>
                        <td><?= $row->sesuai_materi ?></td>
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
