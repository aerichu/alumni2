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
    </style>
</head>
<body>
    <div class="container-fluid">
        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Data jadwal</h1>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Data jadwal</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">guru</th>
                                <th scope="col">blok</th>
                                <th scope="col">nama mapel</th>
                                <th scope="col">kelas</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; foreach ($jel as $kin) { ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= $kin->username ?></td>
                                        <td><?= $kin->blok ?></td>
                                        <td><?= $kin->nama_mapel ?></td>
                                        <td><?= $kin->kelas ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>