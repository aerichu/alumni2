<?php
namespace App\Models;

use CodeIgniter\Model;

class JawabanModel extends Model
{
    protected $table = 'jawaban';
    protected $primaryKey = 'id_jawaban';
    protected $allowedFields = ['id_user_siswa', 'id_pertanyaan', 'jawaban'];
}

?>