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
                        <h6 class="m-0 font-weight-bold text-primary">Daftar Lowongan Kerja</h6>
                        
                        <?php if (session()->get('level') == 'admin' || session()->get('level') == 'bkk') { ?>
                            <div class="btn-group ml-auto" role="group">
                                <button class="btn btn-primary" data-toggle="modal" data-target="#tambahLokerModal">
                                    <i class="fas fa-plus"></i> Tambah Loker
                                </button>
                                
                                <a href="<?= base_url('home/inbox') ?>" class="btn btn-danger btn-sm">
                                    <i class="fas fa-envelope"></i> Inbox
                                </a>
                            </div>
                        <?php } ?>
                        <button type="button" class="btn btn-primary" id="daftarLokerBtn">
                                    Daftar Loker
                                </button>
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
                                          <a href="<?= base_url('home/h_loker/' . $kin->id_loker) ?>" class="btn btn-danger btn-sm mt-2">
                                            <i class="fas fa-trash"></i> Hapus
                                        </a>
                                        <button class="btn btn-info btn-sm mt-2 edit-loker-btn" data-toggle="modal" data-target="#editLokerModal" data-id-loker="<?= $kin->id_loker ?>" data-nama="<?= $kin->nama ?>" data-posisi="<?= $kin->posisi ?>" data-lokasi="<?= $kin->lokasi ?>" data-deskripsi="<?= $kin->deskripsi ?>" data-batas="<?= $kin->batas_lamaran ?>" data-kontak="<?= $kin->contact ?>" data-syarat="<?= $kin->syarat ?>" data-jenis="<?= $kin->jenis_pekerjaan ?>">
                                            <i class="fas fa-edit"></i> Edit
                                        </button>

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


<!-- Modal Tambah Loker -->
<div class="modal fade" id="tambahLokerModal" tabindex="-1" role="dialog" aria-labelledby="tambahLokerModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahLokerModalLabel">Form Lowongan Kerja</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('home/aksi_t_loker') ?>" method="post">
                    <div class="form-group">
                        <label for="namaPerusahaan">Nama Perusahaan</label>
                        <input type="text" id="namaPerusahaan" name="nama" placeholder="Masukkan nama perusahaan" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="posisi">Posisi</label>
                        <input type="text" id="posisi" name="posisi" placeholder="Masukkan posisi pekerjaan" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="lokasi">Lokasi</label>
                        <input type="text" id="lokasi" name="lokasi" placeholder="Masukkan lokasi pekerjaan" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="deskripsi">Deskripsi Pekerjaan</label>
                        <textarea id="deskripsi" name="deskripsi" rows="4" placeholder="Masukkan deskripsi pekerjaan" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="batasLamaran">Batas Lamaran</label>
                        <input type="date" id="batasLamaran" name="batas_lamaran" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="kontak">Kontak</label>
                        <input type="text" id="kontak" name="contact" placeholder="Masukkan kontak yang bisa dihubungi" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="syarat">Syarat</label>
                        <textarea id="syarat" name="syarat" rows="4" placeholder="Masukkan syarat-syarat pekerjaan" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="jenisPekerjaan">Jenis Pekerjaan</label>
                        <select id="jenisPekerjaan" name="jenis_pekerjaan" class="form-control">
                            <option value="full-time">Full-time</option>
                            <option value="part-time">Part-time</option>
                            <option value="freelance">Freelance</option>
                            <option value="kontrak">Kontrak</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary btn-submit">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="editLokerModal" tabindex="-1" role="dialog" aria-labelledby="editLokerModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editLokerModalLabel">Edit Lowongan Kerja</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('home/aksi_e_loker') ?>" method="post">
                    <input type="hidden" id="editIdLoker" name="id_loker">
                    <div class="form-group">
                        <label for="editNamaPerusahaan">Nama Perusahaan</label>
                        <input type="text" id="editNamaPerusahaan" name="nama" placeholder="Masukkan nama perusahaan" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="editPosisi">Posisi</label>
                        <input type="text" id="editPosisi" name="posisi" placeholder="Masukkan posisi pekerjaan" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="editLokasi">Lokasi</label>
                        <input type="text" id="editLokasi" name="lokasi" placeholder="Masukkan lokasi pekerjaan" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="editDeskripsi">Deskripsi Pekerjaan</label>
                        <textarea id="editDeskripsi" name="deskripsi" rows="4" placeholder="Masukkan deskripsi pekerjaan" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="editBatasLamaran">Batas Lamaran</label>
                        <input type="date" id="editBatasLamaran" name="batas_lamaran" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="editKontak">Kontak</label>
                        <input type="text" id="editKontak" name="contact" placeholder="Masukkan kontak yang bisa dihubungi" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="editSyarat">Syarat</label>
                        <textarea id="editSyarat" name="syarat" rows="4" placeholder="Masukkan syarat-syarat pekerjaan" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="editJenisPekerjaan">Jenis Pekerjaan</label>
                        <select id="editJenisPekerjaan" name="jenis_pekerjaan" class="form-control">
                            <option value="full-time">Full-time</option>
                            <option value="part-time">Part-time</option>
                            <option value="freelance">Freelance</option>
                            <option value="kontrak">Kontrak</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary btn-submit">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Detail -->
<div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="detailModalLabel">Detail Perusahaan</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-4">
                <div class="mb-3">
                    <h6 class="text-uppercase text-muted mb-1">Nama Perusahaan</h6>
                    <p class="font-weight-bold text-dark" id="modal-nama"></p>
                </div>
                <div class="mb-3">
                    <h6 class="text-uppercase text-muted mb-1">Posisi</h6>
                    <p class="font-weight-bold text-dark" id="modal-posisi"></p>
                </div>
                <div class="mb-3">
                    <h6 class="text-uppercase text-muted mb-1">Deskripsi</h6>
                    <p class="text-dark" id="modal-deskripsi"></p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Daftar Loker -->
<div class="modal fade" id="daftarLokerModal" tabindex="-1" role="dialog" aria-labelledby="daftarLokerModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="daftarLokerModalLabel">Form Pendaftaran Loker</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="daftarLokerForm" action="<?= base_url('home/aksi_t_lamaran') ?>" method="post">
                    <div class="form-group">
                        <label for="idLoker">Nama Perusahaan</label>
                        <select class="form-control kue-select" name="id_loker[]">
                            <option value="">Pilih nama perusahaan</option>
                            <?php foreach ($jel as $kin): ?>
                                <option value="<?= $kin->id_loker ?>" data-price="<?= $kin->nama ?>"><?= $kin->nama ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="namaDepan">Nama Depan</label>
                        <input type="text" id="namaDepan" name="nama_depan" placeholder="Masukkan nama depan" class="form-control">
                    </div>
                    
                    <div class="form-group">
                        <label for="namaBelakang">Nama Belakang</label>
                        <input type="text" id="namaBelakang" name="nama_belakang" placeholder="Masukkan nama belakang" class="form-control">
                    </div>
                    
                    <div class="form-group">
                        <label for="lokasi">Lokasi</label>
                        <input type="text" id="lokasi" name="lokasi" placeholder="Masukkan lokasi" class="form-control">
                    </div>
                    
                    <div class="form-group">
                        <label for="nomor">Nomor</label>
                        <input type="text" id="nomor" name="nomor" placeholder="Masukkan nomor telepon" class="form-control">
                    </div>
                    
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" placeholder="Masukkan email" class="form-control">
                    </div>
                    
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script>
    // Event listener for the job cards
    $(document).on('click', '.job-card', function() {
        // Get data attributes
        var nama = $(this).data('nama');
        var posisi = $(this).data('posisi');
        var deskripsi = $(this).data('deskripsi');

        // Set data to modal
        $('#modal-nama').text(nama);
        $('#modal-posisi').text(posisi);
        $('#modal-deskripsi').text(deskripsi);

        // Show detail modal
        $('#detailModal').modal('show');
    });

    // Event listener for the Edit button
    $(document).on('click', '.edit-loker-btn', function(event) {
        // Prevent the detail modal from showing
        event.stopPropagation();

        // Get data attributes
        var idLoker = $(this).data('id-loker');
        var nama = $(this).data('nama');
        var posisi = $(this).data('posisi');
        var lokasi = $(this).data('lokasi');
        var deskripsi = $(this).data('deskripsi');
        var batas = $(this).data('batas');
        var kontak = $(this).data('kontak');
        var syarat = $(this).data('syarat');
        var jenis = $(this).data('jenis');

        // Set data to edit modal
        $('#editIdLoker').val(idLoker);
        $('#editNamaPerusahaan').val(nama);
        $('#editPosisi').val(posisi);
        $('#editLokasi').val(lokasi);
        $('#editDeskripsi').val(deskripsi);
        $('#editBatasLamaran').val(batas);
        $('#editKontak').val(kontak);
        $('#editSyarat').val(syarat);
        $('#editJenisPekerjaan').val(jenis);

        // Show edit modal
        $('#editLokerModal').modal('show');
    });
</script>


<script>
    // Event listener for the job cards
    $(document).on('click', '.job-card', function() {
        // Get data attributes
        var nama = $(this).data('nama');
        var posisi = $(this).data('posisi');
        var deskripsi = $(this).data('deskripsi');
        var idLoker = $(this).data('id-loker'); // Add this if you are passing id_loker

        // Set data to modal
        $('#modal-nama').text(nama);
        $('#modal-posisi').text(posisi);
        $('#modal-deskripsi').text(deskripsi);

        // Set id_loker for the application form
        $('#idLoker').val(idLoker);
    });

    // Event listener for the "Daftar Loker" button
    $('#daftarLokerBtn').on('click', function() {
        $('#daftarLokerModal').modal('show');
    });
</script>


<script>
    $(document).ready(function() {
        // Trigger modal and populate with data
        $('.edit-loker-btn').on('click', function() {
            var idLoker = $(this).data('id-loker');
            var nama = $(this).data('nama');
            var posisi = $(this).data('posisi');
            var lokasi = $(this).data('lokasi');
            var deskripsi = $(this).data('deskripsi');
            var batas = $(this).data('batas');
            var kontak = $(this).data('kontak');
            var syarat = $(this).data('syarat');
            var jenis = $(this).data('jenis');
            
            $('#editIdLoker').val(idLoker);
            $('#editNamaPerusahaan').val(nama);
            $('#editPosisi').val(posisi);
            $('#editLokasi').val(lokasi);
            $('#editDeskripsi').val(deskripsi);
            $('#editBatasLamaran').val(batas);
            $('#editKontak').val(kontak);
            $('#editSyarat').val(syarat);
            $('#editJenisPekerjaan').val(jenis);
        });
    });
    </script


</body>
</html>
