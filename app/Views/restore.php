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
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex justify-content-between align-items-center">
                        <h6 class="m-0 font-weight-bold text-primary">Restore</h6>
                    </div>
                    <div class="card-body">
                        <div class="job-card-container">
                            <?php $no = 1; foreach ($jel as $kin) { ?>
                                <div class="job-card-item">
                                    <div class="job-card p-3 border rounded shadow-sm" data-toggle="modal" data-target="#detailModal" data-nama="<?= $kin->nama ?>" data-posisi="<?= $kin->posisi ?>" data-deskripsi="<?= $kin->deskripsi ?>" data-id-loker="<?= $kin->id_loker ?>">
                                        <h5 class="text-uppercase-bold-blue mb-2"><?= $kin->posisi ?></h5>
                                        <p class="mb-1"><strong>Nama Perusahaan:</strong> <?= $kin->nama ?></p>
                                        <p class="mb-1"><strong>Lokasi:</strong> <?= $kin->lokasi ?></p>
                                        <p class="mb-1"><strong>Deskripsi:</strong> <?= $kin->deskripsi ?></p>
                                        <p class="mb-1"><strong>Batas Lamaran:</strong> <?= $kin->batas_lamaran ?></p>
                                        <p class="mb-1"><strong>Kontak:</strong> <?= $kin->contact ?></p>
                                        <p class="mb-1"><strong>Syarat:</strong> <?= $kin->syarat ?></p>
                                        <p class="mb-1"><strong>Jenis Pekerjaan:</strong> <?= $kin->jenis_pekerjaan ?></p>
                                        <?php if (session()->get('level') == 'admin') { ?>
                                          <a href="<?= base_url('home/aksi_restore/' . $kin->id_loker) ?>" class="btn btn-danger btn-sm mt-2">
                                            <i class="fas fa-trash"></i> Restore
                                        </a>
                                    <?php } ?>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>