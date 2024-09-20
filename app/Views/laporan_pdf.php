<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan PDF</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        table {
            width: 80%; /* Decreased the table width to 80% */
            margin: 0 auto; /* Center the table */
            border-collapse: collapse;
            border: 1px solid #333; /* Thinner border */
            font-size: 12px; /* Smaller font size */
        }
        th, td {
            border: 1px solid #666; /* Thinner cell borders */
            padding: 6px; /* Reduced padding */
            text-align: left;
        }
        th {
            background-color: #f4b400; /* Header background color */
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f1f1f1; /* Even row background color */
        }
        tr:nth-child(odd) {
            background-color: #e8f0fe; /* Odd row background color */
        }
        td {
            background-color: #f9f9f9; /* Default cell background color */
        }
        td:nth-child(2) {
            background-color: #fce8e6; /* Column 'Nama Guru' */
        }
        td:nth-child(4), td:nth-child(5) {
            background-color: #f3e5f5; /* Columns 'Silabus' and 'Modul' */
        }
        td:nth-child(8) {
            background-color: #e8f5e9; /* Column 'Prota' */
        }
        h2 {
            text-align: center; /* Center the heading */
            color: #4285f4; /* Heading color */
        }
    </style>
</head>
<body>

    <h2>Laporan PDF</h2>
    <table>
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
                <th>Media Pembelajaran</th>
                <th>Kreatif</th>
                <th>Keterangan</th>
                <th>Sesuai Materi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($laporan as $key => $row) : ?>
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
        </tbody>
    </table>
</body>
</html>
