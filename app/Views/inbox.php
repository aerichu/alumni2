<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inbox - Applications</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
    <div class="container-fluid">
      
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex justify-content-between align-items-center">
                        
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Nama Depan</th>
                                        <th scope="col">Nama Belakang</th>
                                        <th scope="col">Lokasi</th>
                                        <th scope="col">Nomor</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Melamar kepada</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; foreach ($jel as $app): ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= $app->nama_depan ?></td>
                                            <td><?= $app->nama_belakang ?></td>
                                            <td><?= $app->lokasi1 ?></td>
                                            <td><?= $app->nomor ?></td>
                                            <td><?= $app->email ?></td>
                                            <td><?= $app->nama ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
       
    </div>
</body>
</html>
