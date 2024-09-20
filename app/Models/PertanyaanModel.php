<?php
namespace App\Models;

use CodeIgniter\Model;

class PertanyaanModel extends Model
{
    protected $table = 'pertanyaan';
    protected $primaryKey = 'id_pertanyaan';
    protected $allowedFields = ['id_guru_mapel', 'pertanyaan'];
}

?>