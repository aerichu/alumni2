<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Lowongan Kerja</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .form-group label {
            font-weight: bold;
            color: #333;
        }
        .form-group input, .form-group select, .form-group textarea {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .form-group input[type="date"] {
            padding: 5px 10px;
        }
        .btn-submit {
            background-color: #6a0dad;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
        .btn-submit:hover {
            background-color: #551a8b;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2 class="text-center">Form Lowongan Kerja</h2>
        <form>
            <div class="form-group">
                <label for="namaPerusahaan">Nama Perusahaan</label>
                <input type="text" id="namaPerusahaan" name="nama_perusahaan" placeholder="Masukkan nama perusahaan">
            </div>
            <div class="form-group">
                <label for="posisi">Posisi</label>
                <input type="text" id="posisi" name="posisi" placeholder="Masukkan posisi pekerjaan">
            </div>
            <div class="form-group">
                <label for="lokasi">Lokasi</label>
                <input type="text" id="lokasi" name="lokasi" placeholder="Masukkan lokasi pekerjaan">
            </div>
            <div class="form-group">
                <label for="deskripsi">Deskripsi Pekerjaan</label>
                <textarea id="deskripsi" name="deskripsi" rows="4" placeholder="Masukkan deskripsi pekerjaan"></textarea>
            </div>
            <div class="form-group">
                <label for="batasLamaran">Batas Lamaran</label>
                <input type="date" id="batasLamaran" name="batas_lamaran">
            </div>
            <div class="form-group">
                <label for="kontak">Kontak</label>
                <input type="text" id="kontak" name="kontak" placeholder="Masukkan kontak yang bisa dihubungi">
            </div>
            <div class="form-group">
                <label for="syarat">Syarat</label>
                <textarea id="syarat" name="syarat" rows="4" placeholder="Masukkan syarat-syarat pekerjaan"></textarea>
            </div>
            <div class="form-group">
                <label for="jenisPekerjaan">Jenis Pekerjaan</label>
                <select id="jenisPekerjaan" name="jenis_pekerjaan">
                    <option value="full-time">Full-time</option>
                    <option value="part-time">Part-time</option>
                    <option value="freelance">Freelance</option>
                    <option value="kontrak">Kontrak</option>
                </select>
            </div>
            <button type="submit" class="btn-submit">Submit</button>
        </form>
    </div>
</body>
</html>
