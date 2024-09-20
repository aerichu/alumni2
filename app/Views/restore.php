<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account List</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <style>
        .btn-sm-rounded {
            border-radius: 50%;
            padding: 0.25rem 0.5rem;
            font-size: 0.75rem;
            line-height: 1;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .text-uppercase-bold-blue {
            text-transform: uppercase;
            font-weight: bold;
            color: #007bff;
            font-size: 1rem;
        }
        .job-card {
            cursor: pointer;
            padding: 1rem;
            font-size: 0.875rem;
            max-width: 100%; /* Full width within grid column */
            margin-bottom: 1rem; /* Space between rows */
        }
        .card-body {
            padding: 1rem;
        }
        .modal-body {
            font-size: 0.875rem;
        }
        .modal-dialog {
            max-width: 500px;
        }
        /* Custom styles for grid layout */
        .job-card-container {
            display: flex;
            flex-wrap: wrap;
            gap: 1rem; /* Space between cards */
        }
        .job-card-item {
            flex: 1 1 calc(50% - 1rem); /* Two cards per row with gap included */
            max-width: calc(50% - 1rem);
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
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
                        <?php $no = 1; foreach ($jel as $kin) { ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $kin->nama_guru ?></td>
                                <td><?= $kin->kerajinan_guru ?></td>
                                <td><?= $kin->silabus ?></td>
                                <td><?= $kin->modul ?></td>
                                <td><?= $kin->cv ?></td>
                                <td><?= $kin->atp ?></td>
                                <td><?= $kin->prota ?></td>
                                <td><?= $kin->media_pembelajaran ?></td>
                                <td><?= $kin->kreatif ?></td>
                                <td><?= $kin->keterangan ?></td>
                                <td><?= $kin->sesuai_materi ?></td>
                                <td>
                                    <a href="<?= base_url('home/aksi_restore/' . $kin->id_supervisi) ?>" class="btn btn-warning btn-sm rounded-circle">
                                        <i class="fa fa-redo"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>