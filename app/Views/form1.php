<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Jawaban</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f0f4f8;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        h2 {
            color: #007bff;
            margin-bottom: 30px;
            font-weight: bold;
        }
        h4 {
            color: #343a40;
        }
        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            padding: 20px;
            background-color: #fff;
            margin-bottom: 30px;
            transition: transform 0.3s, box-shadow 0.3s;
        }
        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        }
        .form-label {
            font-weight: 600;
            color: #495057;
        }
        textarea {
            width: 100%;
            height: 120px;
            padding: 12px;
            border-radius: 8px;
            border: 1px solid #ced4da;
            transition: border-color 0.3s;
        }
        textarea:focus {
            border-color: #007bff;
            outline: none;
            box-shadow: 0 0 8px rgba(0, 123, 255, 0.2);
        }
        .btn-success {
            padding: 12px 24px;
            font-size: 16px;
            font-weight: bold;
            background-color: #28a745;
            border: none;
            border-radius: 8px;
            transition: background-color 0.3s, transform 0.3s;
        }
        .btn-success:hover {
            background-color: #218838;
            transform: translateY(-2px);
        }
        .btn-success:active {
            background-color: #1e7e34;
        }
        .text-muted {
            color: #6c757d;
        }
        .text-center button {
            margin-top: 20px;
        }
        /* Animation */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(50px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        .container {
            animation: fadeInUp 0.8s ease-in-out;
        }
    </style>
</head>
<body>

<div class="container mt-5">
    <h2 class="text-center">Form Penilaian Guru</h2>

    <form action="<?= base_url('home/aksi_t_jawaban') ?>" method="post">
        <?php foreach ($mapel as $m): ?>
            <div class="card">
                <h4><?= $m['nama_mapel']; ?></h4>
                <p><strong>Guru:</strong> <?= $m['guru']; ?></p>
                <p><strong>Blok:</strong> <?= $m['blok']; ?></p>

                <?php if (!empty($m['soal'])): ?>
                    <div class="mb-4">
                        <!-- Display all questions -->
                        <?php foreach ($m['soal'] as $id_soal => $soal): ?>
                            <label class="form-label"><?= $soal; ?></label><br>
                        <?php endforeach; ?>
                        
                        <!-- Answer field for all questions -->
                        <label class="form-label mt-3">Jawaban:</label>
                        <textarea name="jawaban[<?= $m['id_guru_mapel'] ?>]" placeholder="Isi jawaban untuk semua pertanyaan..."></textarea>
                    </div>
                <?php else: ?>
                    <p class="text-muted">Tidak ada soal untuk mata pelajaran ini.</p>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>

        <div class="text-center">
            <button type="submit" class="btn btn-success">Kirim Jawaban</button>
        </div>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
