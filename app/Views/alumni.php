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
        .hide-column {
            display: none;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Form Data Alumni</h1>

        <!-- Filter Form -->
        <div class="card mb-4">
            <div class="card-header">
                <h6 class="m-0 font-weight-bold text-primary">Filter Alumni</h6>
            </div>
            <div class="card-body">
                <form id="filterForm" class="form-inline mb-3">
                    <label class="mr-2" for="filterBy">Filter By:</label>
                    <select class="form-control mr-2" id="filterBy" onchange="filterTable()">
                        <option value="all">All</option>
                        <option value="kuliah">Kuliah</option>
                        <option value="kerja">Kerja</option>
                        <option value="kerja_kuliah">Kerja Sambil Kuliah</option>
                    </select>
                </form>

                <!-- Search Bar -->
                <input type="text" id="searchInput" class="form-control" placeholder="Search by Name, NIS, or Jurusan" onkeyup="searchTable()">
            </div>
        </div>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">All accounts registered on our website!</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama</th>
                                <th scope="col">NIS</th>
                                <th scope="col">Jurusan</th>
                                <th scope="col">Tahun Lulus</th>
                                <th scope="col" class="kerja-column">Tempat Kerja</th>
                                <th scope="col" class="kerja-column">Alamat Kerja</th>
                                <th scope="col" class="kuliah-column">Tempat Kuliah</th>
                                <th scope="col" class="kuliah-column">Alamat Kuliah</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; foreach ($jel as $kin) { ?>
                                <tr class="data-row" data-kuliah="<?= !empty($kin->tempat_kuliah) ?>" data-kerja="<?= !empty($kin->tempat_kerja) ?>">
                                    <td><?= $no++ ?></td>
                                    <td><?= $kin->nama ?></td>
                                    <td><?= $kin->nis ?></td>
                                    <td><?= $kin->jurusan ?></td>
                                    <td><?= $kin->tahun_lulus ?></td>
                                    <td class="kerja-column"><?= $kin->tempat_kerja ?></td>
                                    <td class="kerja-column"><?= $kin->alamat_kerja ?></td>
                                    <td class="kuliah-column"><?= $kin->tempat_kuliah ?></td>
                                    <td class="kuliah-column"><?= $kin->alamat_kuliah ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        function filterTable() {
            var filterBy = document.getElementById("filterBy").value;
            var rows = document.querySelectorAll(".data-row");

            // Reset visibility for all columns
            document.querySelectorAll('.kerja-column').forEach(function(column) {
                column.classList.remove('hide-column');
            });
            document.querySelectorAll('.kuliah-column').forEach(function(column) {
                column.classList.remove('hide-column');
            });

            // Filter rows and hide columns based on selected criteria
            rows.forEach(function(row) {
                var isKuliah = row.getAttribute("data-kuliah") === "1";
                var isKerja = row.getAttribute("data-kerja") === "1";

                if (filterBy === "all") {
                    row.style.display = "";
                } else if (filterBy === "kuliah" && isKuliah) {
                    row.style.display = "";
                    hideColumns('kerja');
                } else if (filterBy === "kerja" && isKerja) {
                    row.style.display = "";
                    hideColumns('kuliah');
                } else if (filterBy === "kerja_kuliah" && isKuliah && isKerja) {
                    row.style.display = "";
                } else {
                    row.style.display = "none";
                }
            });
        }

        function hideColumns(type) {
            if (type === 'kuliah') {
                document.querySelectorAll('.kuliah-column').forEach(function(column) {
                    column.classList.add('hide-column');
                });
            } else if (type === 'kerja') {
                document.querySelectorAll('.kerja-column').forEach(function(column) {
                    column.classList.add('hide-column');
                });
            }
        }

        function searchTable() {
            var input = document.getElementById("searchInput");
            var filter = input.value.toLowerCase();
            var rows = document.querySelectorAll(".data-row");

            rows.forEach(function(row) {
                var name = row.cells[1].textContent.toLowerCase();
                var nis = row.cells[2].textContent.toLowerCase();
                var jurusan = row.cells[3].textContent.toLowerCase();

                if (name.indexOf(filter) > -1 || nis.indexOf(filter) > -1 || jurusan.indexOf(filter) > -1) {
                    row.style.display = "";
                } else {
                    row.style.display = "none";
                }
            });
        }
    </script>
</body>
</html>
