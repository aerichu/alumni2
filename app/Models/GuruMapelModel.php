<?php
namespace App\Models;

use CodeIgniter\Model;

class GuruMapelModel extends Model
{
    protected $table = 'guru_mapel';
    protected $primaryKey = 'id_guru_mapel';
    protected $allowedFields = ['id_user_guru', 'id_blok', 'nama_mapel'];
}

?>