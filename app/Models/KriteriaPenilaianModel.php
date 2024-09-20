<?php
namespace App\Models;

use CodeIgniter\Model;

class KriteriaPenilaianModel extends Model
{
    protected $table = 'kriteria_penilaian';
    protected $primaryKey = 'id_kriteria';
    protected $allowedFields = ['nama_kriteria'];
}

?>