<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pilih Blok dan Kelas</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">Pilih Blok dan Kelas</h2>
        
        <!-- Form to select blok and class -->
        <form id="blokKelasForm">
            <div class="mb-3">
                <label for="blok" class="form-label">Pilih Blok</label>
                <select class="form-select" name="id_blok" id="blok" required>
                    <option value="">Pilih Blok</option>
                    <?php foreach($bloks as $blok): ?>
                    <option value="<?= $blok['id_blok']; ?>"><?= $blok['nama_blok']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="kelas" class="form-label">Pilih Kelas</label>
                <select class="form-select" name="id_kelas" id="kelas" required>
                    <option value="">Pilih Kelas</option>
                    <?php foreach($kelas1 as $kelas): ?>
                    <option value="<?= $kelas['id_kelas']; ?>"><?= $kelas['kelas']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            
            <button type="button" class="btn btn-primary" id="nextButton">Lanjut</button>
        </form>

        <!-- Form to enter subjects (mapel) for 5 sessions -->
        <form action="<?= base_url('home/aksi_t_blok') ?>" method="post" id="mapelForm" class="d-none mt-5">
            <input type="hidden" name="id_blok" id="selectedBlok">
            <input type="hidden" name="kelas" id="selectedKelas">

            <!-- Table to assign teachers to subjects -->
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Mapel</th>
                        <th>Guru</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Repeat for 5 subjects (sesi 1-5) -->
                    <?php for($i = 1; $i <= 5; $i++): ?>
                        <tr>
                            <td>
                                <input type="text" class="form-control" name="mapel[]" placeholder="Nama Mapel Sesi <?= $i ?>" required>
                            </td>
                            <td>
                                <select class="form-select" name="guru_mapel[]" required>
                                    <option value="">Pilih Guru</option>
                                    <?php foreach($gurus as $guru): ?>
                                    <option value="<?= $guru['id_user']; ?>"><?= $guru['username']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </td>
                        </tr>
                        <?php endfor; ?>
                    </tbody>
                </table>

                <!-- Submit Button -->
                <button type="submit" class="btn btn-success">Simpan</button>
            </form>
        </div>

        <script>
        // Fetch and populate Kelas based on the selected Blok
        document.getElementById('blok').addEventListener('change', function() {
            const blokId = this.value;
            if (blokId) {
                fetch(`<?= base_url('home/getKelasByBlok') ?>/${blokId}`)
                .then(response => response.json())
                .then(data => {
                    const kelasDropdown = document.getElementById('kelas');
                        kelasDropdown.innerHTML = '<option value="">Pilih Kelas</option>'; // Clear previous options
                        data.forEach(kelas => {
                            const option = document.createElement('option');
                            option.value = kelas.id_kelas;
                            option.textContent = kelas.kelas;
                            kelasDropdown.appendChild(option);
                        });
                    });
            } else {
                document.getElementById('kelas').innerHTML = '<option value="">Pilih Kelas</option>';
            }
        });

        // Show mapel form after selecting blok and class
        document.getElementById('nextButton').addEventListener('click', function() {
            const blok = document.getElementById('blok').value;
            const kelas = document.getElementById('kelas').value;

            if (blok && kelas) {
                document.getElementById('selectedBlok').value = blok;
                document.getElementById('selectedKelas').value = kelas;

                document.getElementById('mapelForm').classList.remove('d-none');
                document.getElementById('blokKelasForm').classList.add('d-none');
            } else {
                alert('Pilih blok dan masukkan kelas.');
            }
        });
    </script>
</body>
</html>
