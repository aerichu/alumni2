<?php
namespace App\Models;

use CodeIgniter\Model;

class PenilaianModel extends Model
{
    protected $table = 'penilaian';
    protected $primaryKey = 'id_penilaian';
    protected $allowedFields = [
        'id_user_penilai', 
        'id_user_guru', 
        'kriteria1', 
        'kriteria2', 
        'kriteria3', 
        'komentar', 
        'role_penilai', 
        'tanggal_penilaian'
    ];
}

?>