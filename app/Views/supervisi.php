<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account List</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f4f6f9;
        }

        .btn-primary {
            background-color: #28a745;
            border-color: #28a745;
        }

        .btn-primary:hover {
            background-color: #218838;
            border-color: #1e7e34;
        }

        h1.h3 {
            color: #28a745;
        }

        .table-responsive {
            max-height: 400px;
            overflow-y: auto;
        }

        .card-header {
            background-color: #28a745;
            color: #fff;
        }

        .modal-header {
            background-color: #28a745;
            color: #fff;
        }

        .btn-info {
            background-color: #218838;
            border-color: #1e7e34;
        }

        .btn-info:hover {
            background-color: #1e7e34;
            border-color: #155d27;
        }

        .btn-secondary {
            background-color: #6c757d;
        }

        .table th, .table td {
            white-space: nowrap;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Format B</h1>

        <!-- Tambah Data Supervisi Button -->
        <button class="btn btn-primary mb-3" data-toggle="modal" data-target="#addSupervisiModal">Tambah Data Supervisi</button>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold">Data data penilaian guru bagi supervisi</h6>
            </div>
            <div class="card-body">
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
                                    <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#detailModal<?= $kin->id_supervisi ?>">Detail</button>
                                    <a href="<?= base_url('home/h_supervisi/' . $kin->id_supervisi) ?>" class="btn btn-danger btn-sm mt-2">
                                            <i class="fas fa-trash"></i> Hapus
                                        </a>
                                </td>
                            </tr>

                            <!-- Detail Modal for each entry -->
                            <div class="modal fade" id="detailModal<?= $kin->id_supervisi ?>" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel<?= $kin->id_supervisi ?>" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="detailModalLabel<?= $kin->id_supervisi ?>">Detail Penilaian - <?= $kin->nama_guru ?></h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="container">
                                                <div class="row mb-2">
                                                    <div class="col-md-6 font-weight-bold">Kerajinan Guru:</div>
                                                    <div class="col-md-6"><?= $kin->kerajinan_guru ?></div>
                                                </div>
                                                <div class="row mb-2">
                                                    <div class="col-md-6 font-weight-bold">Silabus:</div>
                                                    <div class="col-md-6"><?= $kin->silabus ?></div>
                                                </div>
                                                <div class="row mb-2">
                                                    <div class="col-md-6 font-weight-bold">Modul:</div>
                                                    <div class="col-md-6"><?= $kin->modul ?></div>
                                                </div>
                                                <div class="row mb-2">
                                                    <div class="col-md-6 font-weight-bold">CV:</div>
                                                    <div class="col-md-6"><?= $kin->cv ?></div>
                                                </div>
                                                <div class="row mb-2">
                                                    <div class="col-md-6 font-weight-bold">ATP:</div>
                                                    <div class="col-md-6"><?= $kin->atp ?></div>
                                                </div>
                                                <div class="row mb-2">
                                                    <div class="col-md-6 font-weight-bold">Prota:</div>
                                                    <div class="col-md-6"><?= $kin->prota ?></div>
                                                </div>
                                                <div class="row mb-2">
                                                    <div class="col-md-6 font-weight-bold">Media Pembelajaran:</div>
                                                    <div class="col-md-6"><?= $kin->media_pembelajaran ?></div>
                                                </div>
                                                <div class="row mb-2">
                                                    <div class="col-md-6 font-weight-bold">Kekreatifan:</div>
                                                    <div class="col-md-6"><?= $kin->kreatif ?></div>
                                                </div>
                                                <div class="row mb-2">
                                                    <div class="col-md-6 font-weight-bold">Kesesuaian Materi:</div>
                                                    <div class="col-md-6"><?= $kin->sesuai_materi ?></div>
                                                </div>
                                                <div class="row mt-4">
                                                    <div class="col-md-12 text-center">
                                                        <p class="font-italic" style="font-size: 1.2rem;">Keterangan: <?= $kin->keterangan ?></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Supervisi Modal -->
    <div class="modal fade" id="addSupervisiModal" tabindex="-1" role="dialog" aria-labelledby="addSupervisiModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addSupervisiModalLabel">Tambah Data Supervisi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="<?= base_url('home/aksi_t_supervisi') ?>">
                        <div class="form-group">
                            <label for="nama_guru">Masukkan Nama Guru</label>
                            <input type="text" class="form-control" id="nama_guru" name="nama_guru" required>
                        </div>
                        <div class="form-group">
                            <label for="kerajinan_guru">Bagaimana dengan kerajinan guru selama pembelajaran?</label>
                            <select class="form-control" id="kerajinan_guru" name="kerajinan_guru">
                                <option value="baik">Baik</option>
                                <option value="tidak">Tidak</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="silabus">Persiapan Silabus</label>
                            <select class="form-control" id="silabus" name="silabus">
                                <option value="baik">Baik</option>
                                <option value="tidak">Tidak</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="modul">Persiapan Modul</label>
                            <select class="form-control" id="modul" name="modul">
                                <option value="baik">Baik</option>
                                <option value="tidak">Tidak</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="cv">Persiapan CV</label>
                            <select class="form-control" id="cv" name="cv">
                                <option value="baik">Baik</option>
                                <option value="tidak">Tidak</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="atp">Persiapan ATP</label>
                            <select class="form-control" id="atp" name="atp">
                                <option value="baik">Baik</option>
                                <option value="tidak">Tidak</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="prota">Persiapan Prota</label>
                            <select class="form-control" id="prota" name="prota">
                                <option value="baik">Baik</option>
                                <option value="tidak">Tidak</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="media_pembelajaran">Persiapan Media Pembelajaran</label>
                            <select class="form-control" id="media_pembelajaran" name="media_pembelajaran">
                                <option value="baik">Baik</option>
                                <option value="tidak">Tidak</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="kreatif">Bagaimana dengan kreatif guru selama pembelajaran?</label>
                            <select class="form-control" id="kreatif" name="kreatif">
                                <option value="baik">Baik</option>
                                <option value="tidak">Tidak</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="sesuai_materi">Apakah guru memberikan materi yang sesuai?</label>
                            <select class="form-control" id="sesuai_materi" name="sesuai_materi">
                                <option value="baik">Baik</option>
                                <option value="tidak">Tidak</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="keterangan">Berikan Keterangan</label>
                            <textarea class="form-control" id="keterangan" name="keterangan"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>


</body>

</html>


