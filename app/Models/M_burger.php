<?php

namespace App\Models;
use CodeIgniter\Model;

class M_burger extends Model
{

    protected $table;
    
public function join($tabel, $tabel2, $on, $id){
    return $this->db->table($tabel)
                    ->join($tabel2,$on,'left')
                    ->orderby ($id,'desc') 
                    ->get()
                    ->getResult();
        }
public function tampilWhere($table, $where)
    {
        return $this->db->table($table)
                        ->where($where)
                        ->get()
                        ->getResultArray(); // Get as an array of results
    }

public function query1($query)
{
    // Jalankan query
    $result = $this->db->query($query);

    // Jika query gagal, tangani error
    if (!$result) {
        // Debugging: tampilkan error dari database
        $error = $this->db->error();
        die('Query Error: ' . $error['message']); // atau bisa diganti dengan logging jika tidak ingin mematikan aplikasi
    }

    // Jika query berhasil, kembalikan hasil
    return $result->getResult();
}

public function getGuruMapel()
    {
        return $this->db->table('guru_mapel')
            ->select('guru_mapel.id_guru_mapel, guru_mapel.nama_mapel, user.username as nama_guru')
            ->join('user', 'guru_mapel.id_user_guru = user.id_user')
            ->get()->getResultArray();
    }

public function getAllBloks()
{
    return $this->db->table('blok')->get()->getResultArray();
}
public function getKelas()
{
    return $this->db->table('kelas')->get()->getResultArray();
}

public function getAllKelas()
{
    return $this->db->table('kelas')->get()->getResultArray();
}

public function getKelasByBlok($blokId)
{
    $model = new M_burger();
    $kelas = $model->getKelasByBlok($blokId); // Fetch classes based on blok ID
    return $this->response->setJSON($kelas); // Return classes as JSON response
}

public function getAllGurus()
{
    return $this->db->table('user')->where('level', 'guru')->get()->getResultArray();
}

public function saveMapel($data)
{
    // Insert the mapel and assigned teacher into the guru_mapel table
    return $this->db->table('guru_mapel')->insert($data);
}


public function tampilform($table)
{
    return $this->db->table($table)->get()->getResultArray();
}


public function updatejwbn($table, $id_guru_mapel, $data)
{
    return $this->db->table($table)
                    ->where('id_guru_mapel', $id_guru_mapel)
                    ->update($data);
}






    
public function tampil($org)
    {
        return $this->db->table($org)->get()->getResult();
    }
    public function tambah($table,$where)
    {
        return $this->db->table($table)->insert($where);
    }
    public function hapus($kolom,$where)
    {
        return $this->db->table($kolom)->delete($where);
    }
    public function updateStatus($table, $data, $where)
{
    return $this->db->table($table)->where($where)->update($data);
}

public function update_status($kode_transaksi, $status)
{
    $builder = $this->db->table('transaksi');
    $builder->where('kode_transaksi', $kode_transaksi);
    $builder->update(['status' => $status]);
}

public function delete_order($kode_transaksi)
{
    $builder = $this->db->table('transaksi');
    $builder->where('kode_transaksi', $kode_transaksi);
    $builder->delete();
}


    public function hapus2($tabel, $where)
{
    // Debugging: Tampilkan query yang akan dijalankan
    $query = $this->db->table($tabel)->where($where)->getCompiledDelete();
    log_message('info', 'Query hapus: ' . $query);

    // Hapus data dari tabel sesuai kondisi
    return $this->db->table($tabel)->delete($where);
}
public function getWherecon($table, $conditions)
{
    return $this->db->table($table)->where($conditions)->get()->getResult();
}
    public function edit($kin,$isi,$where)
    {
        return $this->db->table($kin)->update($isi,$where);
    }
    // In M_burger model
public function update_multiple($table, $data, $field, $value)
{
    $builder = $this->db->table($table);
    $builder->where($field, $value);
    $builder->update($data);
}

    public function joinn($tabel, $tabel2, $tabel3, $on){
     return $this->db->table($tabel)
     ->join($tabel2, $on,'left')
    ->join($tabel3, $on,'left')
     ->get()
     ->getResult();

 }
public function tampil_join($table1,$tabel2,$on)
    {
        return $this->db->table($table1)
                        ->join($tabel2,$on,"left")
                        ->get()->getResult();
    }
public function tampil_join3($table1,$tabel2,$tabel3,$on)
    {
        return $this->db->table($table1)
                        ->join($tabel2,$on,"left")
                        ->join($tabel3,$on)
                        ->get()->getResult();
    }
    public function joinWhere($table,$tabel2,$on,$where)
    {
        return $this->db->table($tabel2)
                        ->join($tabel2,$on,"right")
                        ->getWhere($where)->getRow();
    }

    public function upload($file)
    {
        $imageName = $file->getName();
        $file->move(ROOTPATH.'public/img',$imageName);
    }

    public function save_file($data)
{
    $this->db->table('transaksi')->insert($data);
}

public function jointigawhere($table1, $table2, $table3, $on1, $on2, $select, $where)
{
    $builder = $this->db->table($table1);
    $builder->select($select);
    $builder->join($table2, $on1);
    $builder->join($table3, $on2);
    $builder->where($where);

    $query = $builder->get();

    // Check if the query was successful
    if ($query !== false) {
        if ($query->getNumRows() > 0) {
            return $query->getResult(); // Return results as array of objects
        } else {
            return []; // Return empty array if no results found
        }
    } else {
        // Log the query error (optional) and return an empty array
        // log_message('error', 'Query failed: ' . $this->db->getLastQuery());
        return [];
    }
}


public function joinTwoTables($tabel2, $on, $where1)
    {
        $query = $this->db->table($this->table)
                          ->join($tabel2, $on, 'left')
                          ->where($where1)
                          ->get();

        if ($query === false) {
            // Log error atau tampilkan pesan error untuk debugging
            log_message('error', 'Query failed: ' . $this->db->getLastQuery());
            return false; // Atau handle sesuai kebutuhan
        }

        return $query->getResult();
    }
public function joinFourTables($table1, $table2, $table3, $on1, $on2, $on3, $where = [])
    {
        // Perform the join of 4 tables
        return $this->db->table($this->table)
                        ->join($table1, $on1, 'left')
                        ->join($table2, $on2, 'left')
                        ->join($table3, $on3, 'left')
                        ->where($where)
                        ->get()
                        ->getResult();
    }


public function getwherejoin($tabel, $tabel2,$on,$id){
  return $this->db->table($tabel)
  ->join($tabel2, $on,'left')
  ->getWhere($where)
  ->getRow();

}

public function getWhere($tabel,$where){
    return $this->db->table($tabel)
             ->getWhere($where)
             ->getRow();
             
}
public function getWherepol($tabel,$where){
    return $this->db->table($tabel)
             ->getWhere($where)
             ->getResult();
             
}
public function updateRating($id_transaksi, $data)
{
    return $this->db->table('transaksi')
                    ->where('id_transaksi', $id_transaksi)
                    ->update($data);
}
public function updateRatingsByKodeTransaksi($kode_transaksi, $data)
{
    return $this->db->table('transaksi')
                    ->where('kode_transaksi', $kode_transaksi)
                    ->update($data);
}
public function updateFilesByKodeTransaksi($kode_transaksi, $filePaths)
{
    foreach ($filePaths as $filePath) {
        // Append the new file path to the existing file paths
        $this->db->table('transaksi')
            ->where('kode_transaksi', $kode_transaksi)
            ->update([
                'bukti_file' => $this->db->select('bukti_file')->where('kode_transaksi', $kode_transaksi)->get()->getRow()->bukti_file . ',' . $filePath
            ]);
    }
}






//bagian multilogin

public function edituser($table, $data, $where)
    {
        // Check if the 'pw' field exists in the $data array
        if (isset($data['pw'])) {
            // Encrypt the password before saving
            $data['pw'] = password_hash($data['pw'], PASSWORD_DEFAULT);
        }

        $this->db->table($table)->update($data, $where);
    }
public function editpw($table, $data, $where)
    {
        return $this->db->table($table)->update($data, $where);
    }

    public function updateuser($id, $data)
    {
        return $this->db->table($this->table)->update($data, ['id_user' => $id]);
    }

    public function deleteUser($id)
    {
        return $this->db->table($this->table)->delete(['id_user' => $id]);
    }

public function tambahpass($table, $data)
    {
        // Encrypt password if it exists in the data
        if (isset($data['pw'])) {
            $data['pw'] = password_hash($data['pw'], PASSWORD_DEFAULT);
        }

        return $this->db->table($table)->insert($data);
    }

    public function editpass($table, $data, $where)
    {
        // Encrypt password if it exists in the data
        if (isset($data['pw'])) {
            $data['pw'] = password_hash($data['pw'], PASSWORD_DEFAULT);
        }

        return $this->db->table($table)->update($data, $where);
    }



    public function encryptPasswordMD5($password)
{
    return md5($password); // Enkripsi password menggunakan MD5
}




// Di dalam model M_burger
public function tambahTransaksi($data)
{
    return $this->db->table('transaksi')->insert($data);
}


public function tambah1($table, $data)
{
    if ($this->db->table($table)->insert($data)) {
        return true;
    } else {
        log_message('error', 'Database error: ' . $this->db->error());
        return false;
    }
}

public function upload2($file)
{
    if ($file->isValid() && !$file->hasMoved())
    {
        $newName = $file->getRandomName();
        $file->move('./uploads', $newName);
    }
}
public function hapus1($tabel, $where)
{
    return $this->db->table($tabel)->delete($where);
}





//untuk mengubah logo menu
public function updateSetting2($field, $data)
    {
        $this->db->table('setting')->update($data, ['id_setting' => 1]);
    }


public function getReportData()
    {
        return $this->db->table($this->table)
                        ->select('id_transaksi, tgl_transaksi, kode_transaksi, id_user, id_makanan, jumlah, total_harga')
                        ->get()
                        ->getResult();
    }

public function uploadgambar($file)
{
    $targetPath = ROOTPATH . 'public/images/logo.png';

    // Hapus file lama jika ada
    if (file_exists($targetPath)) {
        unlink($targetPath);
    }

    // Simpan file baru
    $file->move(ROOTPATH . 'public/images', 'logo.png');
    
    return 'logo.png'; // Mengembalikan nama file baru
}


public function editgambar($table, $data, $where)
{
    return $this->db->table($table)->update($data, $where);
}

public function tampilgambar($table)
{
    return $this->db->table($table)->get()->getResult(); // Mengambil semua data dari tabel
}



    public function getTransactionsByDate($start_date, $end_date)
    {
        return $this->where('tgl_transaksi >=', $start_date)
                    ->where('tgl_transaksi <=', $end_date)
                    ->findAll();
    }

public function getLaporanByDate($start_date, $end_date)
{
    return $this->db->table('supervisi')
    ->where('created_at >=', $start_date)
    ->where('created_at <=', $end_date)
    ->get()
    ->getResult();
}

public function getLaporanByDateForExcel($start_date, $end_date)
{
    $query = $this->db->table('supervisi')
    ->where('created_at >=', $start_date)
    ->where('created_at <=', $end_date)
    ->get();

    return $query->getResultArray();
}


    public function upload1($file)
{
    $targetPath = ROOTPATH . 'public/images/logo.png';
    
    // Hapus file lama jika ada
    if (file_exists($targetPath)) {
        unlink($targetPath);
    }

    // Simpan file baru
    $file->move(ROOTPATH . 'public/images', 'logo.png');
    
    return 'logo.png'; // Mengembalikan nama file baru
}


    // Mendapatkan gambar dari tabel toko
    public function tampilgambarnota($table)
    {
        return $this->db->table($table)->get()->getResultArray();
    }


    public function joinAndGroupByTransaction()
{
    $query = $this->db->table('transaksi')
                      ->select('kode_transaksi, user.username, transaksi.tgl_transaksi, SUM(transaksi.total_harga) as total_harga, GROUP_CONCAT(makanan.nama SEPARATOR ", ") as nama, GROUP_CONCAT(transaksi.jumlah SEPARATOR ", ") as jumlah, transaksi.status, transaksi.bukti_file')
                      ->join('makanan', 'transaksi.id_makanan = makanan.id_makanan')
                      ->join('user', 'transaksi.id_user = user.id_user')
                      ->groupBy('kode_transaksi, user.username, transaksi.tgl_transaksi, transaksi.status, transaksi.bukti_file')
                      ->orderBy('transaksi.tgl_transaksi', 'desc')
                      ->get();
    return $query->getResult();
}

public function joinAndGroupByBukti()
{
    return $this->select('kode_transaksi, bukti_file')
                ->groupBy('kode_transaksi, bukti_file')
                ->findAll();
}






public function updateByKodeTransaksi($kode_transaksi, $updateData)
    {
        // Update all records where kode_transaksi matches the provided value
        $this->db->table($this->table)
                 ->where('kode_transaksi', $kode_transaksi)
                 ->update($updateData);
    }


public function getTransactionById($id_transaksi)
{
    return $this->db->table('transaksi')->where('id_transaksi', $id_transaksi)->get()->getRow();
}


public function edit2($table, $data, $where)
{
    return $this->db->table($table)->update($data, $where);
}

//log activity
public function logActivity($user_id, $activity, $description) {
    date_default_timezone_set('Asia/Jakarta'); // Set timezone ke WIB
    $timestamp = date('Y-m-d H:i:s'); // Waktu dalam WIB

    $data = [
        'user_id' => $user_id,
        'activity' => $activity,
        'description' => $description,
        'timestamp' => $timestamp, // Tambahkan timestamp ke data
    ];

    $this->db->table('activity_logs')->insert($data);
}
public function getActivityLogs() {
    $query = $this->db->table('activity_logs')
                      ->join('user', 'activity_logs.user_id = user.id_user', 'left')
                      ->select('user.username, activity_logs.activity, activity_logs.description, activity_logs.timestamp')
                      ->orderBy('activity_logs.timestamp', 'DESC')
                      ->get();

    $results = $query->getResultArray();
    return $results;
}
public function query($query)
{
    return $this->db->query($query)
                    ->getResult();
}

public function history_edit($user_id, $activity, $description) {
    date_default_timezone_set('Asia/Jakarta'); // Set timezone ke WIB
    $timestamp = date('Y-m-d H:i:s'); // Waktu dalam WIB

    $data = [
        'user_id' => $user_id, // Pastikan nama kolom sesuai dengan tabel
        'activity' => $activity,
        'description' => $description,
        'timestamp' => $timestamp, // Tambahkan timestamp ke data
    ];

    if (!$this->db->table('history_edit')->insert($data)) {
        // Log error untuk debugging
        log_message('error', 'Failed to insert history_edit data: ' . $this->db->error());
    }
}

public function gethistoryedit() {
    // Define the query
    $builder = $this->db->table('history_edit');
    $builder->join('user', 'history_edit.user_id = user.id_user', 'left');
    $builder->select('user.username, history_edit.activity, history_edit.description, history_edit.timestamp');
    $builder->orderBy('history_edit.timestamp', 'DESC');

    $query = $builder->get();

    // Cek apakah query berhasil
    if ($query === false) {
        // Log error untuk debugging
        log_message('error', 'Query Error: ' . $this->db->getLastQuery());
        return []; // Atau handle error sesuai kebutuhan
    }

    // Retrieve results
    $results = $query->getResultArray();
    return $results;
}

}