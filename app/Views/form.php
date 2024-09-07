<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Data Alumni</title>
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
        <h1 class="h3 mb-2 text-gray-800">Form Data Alumni</h1>

        <!-- Form -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Add New Alumni Data</h6>
            </div>
            <div class="card-body">
                <form id="addDataForm" action="<?= base_url('home/aksi_t_form') ?>" method="post">
                    <!-- Filter Selection -->
                    <div class="form-group">
                        <label for="filter">Filter</label>
                        <select class="form-control" id="filter" name="filter" required>
                            <option value="">Select Option</option>
                            <option value="kerja">Kerja</option>
                            <option value="kuliah">Kuliah</option>
                            <option value="kerja_sambil_kuliah">Kerja Sambil Kuliah</option>
                        </select>
                    </div>

                    <!-- Fields that are always shown -->
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" class="form-control" id="nama" name="nama" required>
                    </div>
                    <div class="form-group">
                        <label for="nis">NIS</label>
                        <input type="text" class="form-control" id="nis" name="nis" required>
                    </div>
                    <div class="form-group">
                        <label for="jurusan">Jurusan</label>
                        <input type="text" class="form-control" id="jurusan" name="jurusan" required>
                    </div>
                    <div class="form-group">
                        <label for="tahun_lulus">Tahun Lulus</label>
                        <input type="number" class="form-control" id="tahun_lulus" name="tahun_lulus" required>
                    </div>

                    <!-- Filtered Fields -->
                    <div class="form-group" id="tempat_kerja_div">
                        <label for="tempat_kerja">Tempat Kerja</label>
                        <input type="text" class="form-control" id="tempat_kerja" name="tempat_kerja">
                    </div>
                    <div class="form-group" id="alamat_kerja_div">
                        <label for="alamat_kerja">Alamat Kerja</label>
                        <input type="text" class="form-control" id="alamat_kerja" name="alamat_kerja">
                    </div>
                    <div class="form-group" id="tempat_kuliah_div">
                        <label for="tempat_kuliah">Tempat Kuliah</label>
                        <input type="text" class="form-control" id="tempat_kuliah" name="tempat_kuliah">
                    </div>
                    <div class="form-group" id="alamat_kuliah_div">
                        <label for="alamat_kuliah">Alamat Kuliah</label>
                        <input type="text" class="form-control" id="alamat_kuliah" name="alamat_kuliah">
                    </div>

                    <!-- Submit and Close Buttons -->
                    <div class="form-group text-right">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const filterSelect = document.getElementById('filter');
            
            function updateFormFields() {
                const selectedOption = filterSelect.value;
                const tempatKerjaDiv = document.getElementById('tempat_kerja_div');
                const alamatKerjaDiv = document.getElementById('alamat_kerja_div');
                const tempatKuliahDiv = document.getElementById('tempat_kuliah_div');
                const alamatKuliahDiv = document.getElementById('alamat_kuliah_div');
                
                // Reset all fields to visible
                tempatKerjaDiv.style.display = 'block';
                alamatKerjaDiv.style.display = 'block';
                tempatKuliahDiv.style.display = 'block';
                alamatKuliahDiv.style.display = 'block';

                // Hide fields based on selection
                if (selectedOption === 'kuliah') {
                    tempatKerjaDiv.style.display = 'none';
                    alamatKerjaDiv.style.display = 'none';
                } else if (selectedOption === 'kerja') {
                    tempatKuliahDiv.style.display = 'none';
                    alamatKuliahDiv.style.display = 'none';
                } else if (selectedOption === 'kerja_sambil_kuliah') {
                    // No fields to hide
                }
            }

            filterSelect.addEventListener('change', updateFormFields);

            // Initialize form fields visibility
            updateFormFields();
        });
    </script>
</body>
</html>
