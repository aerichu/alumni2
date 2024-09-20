<?php
namespace App\Models;

use CodeIgniter\Model;

class PilihanBlokModel extends Model
{
    protected $table = 'pilihan_blok';
    protected $primaryKey = 'id_pilihan_blok';
    protected $allowedFields = ['id_user_siswa', 'id_blok'];
}

?>