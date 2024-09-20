<?php

namespace App\Controllers;
use App\Models\M_burger;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Dompdf\Dompdf;
use Dompdf\Options;
use App\Models\BlokModel;
use App\Models\GuruMapelModel;
use App\Models\KriteriaPenilaianModel;
use App\Models\PertanyaanModel;
use App\Models\PenilaianModel;


class Home extends BaseController
{
    protected $db;

    public function __construct()
    {
        // Inisialisasi database
        $this->db = \Config\Database::connect();
    }
    public function dashboard()
    {
        if(session()->get('level')>0){ 
            $model= new M_burger;
            $data['jes'] = $model->tampilgambar('toko');
            echo view('header');
            echo view('menu');
            echo view('dashboard');
        }else{
            return redirect()->to('http://localhost:8080/home/login');
        }
    }
    public function login()
    {
        echo view('header');
        echo view('login');

    }

    public function aksi_login()
    {
        $u=$this->request->getPost('username');
        $p=$this->request->getPost('pw');

        $model = new M_burger();
        $where=array(
            'username'=> $u,
            'pw'=> md5($p)
        );

        $model = new M_burger();
        $cek = $model->getWhere('user',$where);
        
        if ($cek>0){
         session()->set('id',$cek->id_user);
         session()->set('username',$cek->username);
         session()->set('level',$cek->level);

         $model->logActivity($cek->id_user, 'login', 'User logged in.');

         return redirect()->to('home/dashboard');
     } else {
        return redirect()->to('http://localhost:8080/home/login');
    }

}

public function logout() {
    $user_id = session()->get('id');
    
    if ($user_id) {
        // Log the logout activity
        $model = new M_burger();
        $model->logActivity($user_id, 'logout', 'User logged out.');
    }

    session()->destroy();
    return redirect()->to('http://localhost:8080/home/login');
}

public function register()
{
    $model= new M_burger;
    // $data['jel']= $model->tampil('user');
     $data['kelas'] = $model->getKelas(); 
    echo view('header');
    echo view('register',$data);
}
public function aksi_t_register()
{
    $nama = $this->request->getPost('nama');
    $email = $this->request->getPost('email');
    $password = md5($this->request->getPost('pass'));
    $id_kelas = $this->request->getPost('id_kelas');

    $data = array(
        'username' => $nama,
        'email' => $email,
        'pw' => $password,
        'level' => 'siswa',  // assuming new users are students
        'id_kelas' => $id_kelas
    );

    $model = new M_burger();
    $model->tambah('user', $data);
    
    return redirect()->to(base_url('home/login'));
}



public function activity_log() 
{   
    if(session()->get('level')>0){
        $model = new M_burger();
        $logs = $model->getActivityLogs();

        $data['logs'] = $logs;

        $where = array(
            'id_toko' => 1
        );

        echo view('header');
        echo view('menu', $data);
        return view('activity_log', $data);
    }else{
        return redirect()->to('http://localhost:8080/home/login');
    }
}


public function aksi_reset($id)
{
    $model = new M_burger();
    $user_id = session()->get('id');

    $where= array('id_user'=>$id);

    $isi = array(

        'pw' => md5('11111111')      

    );
    $model->editpw('user', $isi,$where);
    $model->logActivity($user_id, 'user', 'User reset a password');  

    return redirect()->to('home/user');
}


public function user()
{
    if (session()->get('level')> 0) {
        $model = new M_burger();
        $data['jel'] = $model->join('user', 'kelas', 'user.id_kelas=kelas.id_kelas', 'kelas.id_kelas');
        
        $user_id = session()->get('id');
        $model->logActivity($user_id, 'user', 'User in user page');

        echo view('header');
        echo view('menu', $data);
        echo view('user', $data);
    } else {
        return redirect()->to(base_url('home/login'));
    }
}

public function t_user()
{
    $model= new M_burger;
    $user_id = session()->get('id');
    $data['jel']= $model->tampil('user');
    $model->logActivity($user_id, 'tambah user', 'User in tambah user page');
    echo view('header');
    echo view('menu', $data);
    echo view('t_user',$data);
}
public function aksi_t_user()
{
    $user_id = session()->get('id');
    $a = $this->request->getPost('nama');
    $c = $this->request->getPost('email');
    $b = md5($this->request->getPost('pass'));
    
    $u = $this->request->getPost('level');

    // Prepare the data for inserting into the 'user' table
    $sis = array(
        'level' => $u,
        'username' => $a,
        'email' => $c,
        'pw' => $b, 
    );

    // Instantiate the model and add the new user data
    $model = new M_burger;
    $model->tambah('user', $sis);

    $model->logActivity($user_id, 'user', 'User added a new account');  

    // Redirect the user after the operation is completed
    return redirect()->to('http://localhost:8080/home/user');
}
public function h_user($id)
{
    $model = new M_burger();
    $id_user = session()->get('id');
    $kil = array('id_user' => $id);
    $model->hapus('user', $kil);
    $model->logActivity($id_user, 'user', 'User deleted a user data.');
    return redirect()->to(base_url('home/user'));
}
public function aksi_e_user()
{
    $model= new M_burger;
    $user_id = session()->get('id');
    $a= $this->request->getPost('username');
    $c= $this->request->getPost('email');
    $b= md5($this->request->getPost('pw'));
    
    $d= $this->request->getPost('level');
    $id=$this->request->getPost('id');
    $where = array('id_user'=>$id);
    $isi= array(
        'username'=>$a,
        'email'=>$c,
        'pw'=>$b,
        
        'level'=>$d);
    $model->edit('user',$isi,$where);
    $model->logActivity($user_id, 'user', 'User updated a menu burger data');
    return redirect()-> to ('http://localhost:8080/home/user');
}

//jadwal
public function blok()
{
    if (session()->get('level') > 0) {
        $model = new M_burger();
        $user_id = session()->get('id');
        
        $data['bloks'] = $model->getAllBloks(); // Fetch blok data
        $data['gurus'] = $model->getAllGurus(); // Fetch teacher data
        $data['kelas1'] = $model->getAllKelas();
        
        $model->logActivity($user_id, 'blok', 'User in blok');
        
        echo view('header');
        echo view('menu');
        echo view('blok', $data); // Pass data to view
    } else {
        return redirect()->to('http://localhost:8080/home/login');
    }
}

public function saveBlok()
{
    $model = new M_burger();
    
    $id_blok = $this->request->getPost('id_blok');
    $mapel = $this->request->getPost('mapel');
    $guru_mapel = $this->request->getPost('guru_mapel');

    // Save each subject and its assigned teacher to the database
    foreach ($mapel as $index => $mapel_name) {
        $model->saveMapel([
            'id_blok' => $id_blok,
            'nama_mapel' => $mapel_name,
            'id_user_guru' => $guru_mapel[$index]
        ]);
    }
    
    return redirect()->to('http://localhost:8080/blok');
}

public function aksi_t_blok()
{
    $model = new M_burger();

    $id_blok = $this->request->getPost('id_blok');
    $id_kelas = $this->request->getPost('kelas');
    $mapel = $this->request->getPost('mapel');
    $guru_mapel = $this->request->getPost('guru_mapel');

    foreach ($mapel as $index => $mapel_name) {
        if (!empty($mapel_name) && !empty($guru_mapel[$index])) {
            $data = [
                'id_blok' => $id_blok,
                'nama_mapel' => $mapel_name,
                'id_user_guru' => $guru_mapel[$index],
                'id_kelas' => $id_kelas,
                'id_soal' => '1,2,3' // Set id_soal to 123
            ];

            // Call the model function to insert the data
            $model->saveMapel($data);
        }
    }

    return redirect()->to('/home/blok')->with('message', 'Data successfully added.');
}



public function form()
{
    if (session()->get('level') > 0) {
        $model = new M_burger(); // Replace with your actual model
        $id_user = session()->get('id');
        
        // Get the user's class (id_kelas) from the user table
        $user_data = $model->tampilWhere('user', ['id_user' => $id_user]);

        // Check if user data is found
        if (!empty($user_data)) {
            $id_kelas = $user_data[0]['id_kelas']; // Access the first result's id_kelas
            
            // Fetch blocks associated with the user's class
            $data['blok'] = $model->tampilWhere('blok', ['id_kelas' => $id_kelas]);

            // Fetch subjects (mapel) associated with the user's class
            $mapel_data = $model->tampilWhere('guru_mapel', ['id_kelas' => $id_kelas]);

            foreach ($mapel_data as &$m) {
                // Fetch the teacher's name using id_user_guru
                $teacher_data = $model->tampilWhere('user', ['id_user' => $m['id_user_guru']]);
                $m['guru'] = !empty($teacher_data) ? $teacher_data[0]['username'] : 'Unknown';

                // Fetch the block associated with this mapel
                $block_data = $model->tampilWhere('blok', ['id_blok' => $m['id_blok']]);
                $m['blok'] = !empty($block_data) ? $block_data[0]['nama_blok'] : 'Unknown Block';

                // Fetch the questions for this subject using id_soal
                if (!empty($m['id_soal'])) {
                    $soal_ids = explode(',', $m['id_soal']); // Assuming multiple soal IDs are comma-separated
                    $questions = [];
                    foreach ($soal_ids as $id_soal) {
                        $question_data = $model->tampilWhere('soal', ['id_soal' => $id_soal]);
                        if (!empty($question_data)) {
                            $questions[] = $question_data[0]['soal'];
                        }
                    }
                    $m['soal'] = $questions;
                } else {
                    $m['soal'] = []; // If no soal assigned, return empty array
                }
            }

            $data['mapel'] = $mapel_data; // Update mapel with teacher, block, and questions data

            // Load the views with data
            echo view('header');
            echo view('menu');
            echo view('form1', $data);  
        } else {
            // Handle case when no user data is found
            return redirect()->to('/error_page')->with('error', 'User data not found.');
        }
    } else {
        // Redirect to login page if session level is invalid
        return redirect()->to('/home/login');
    }
}


public function aksi_t_jawaban()
{
    $user_id = session()->get('id');
    $jawaban_data = $this->request->getPost('jawaban');

    // Instantiate the model
    $model = new M_burger;

    // Loop through the answers and update the 'jawaban' column for each 'guru_mapel' record
    foreach ($jawaban_data as $id_guru_mapel => $jawaban) {
        $data = [
            'jawaban' => $jawaban,
        ];

        // Update the 'guru_mapel' table with the provided answers
        $model->updatejwbn('guru_mapel', $id_guru_mapel, $data);
    }

    // Log the user activity after submitting answers
    $model->logActivity($user_id, 'user', 'User submitted an answer');

    // Redirect the user after the operation is completed
    return redirect()->to('http://localhost:8080/home/form');
}










public function data_jadwal()
{
    if (session()->get('level') > 0) {
        $model = new M_burger();
        
        // Adjust the join logic
        $data['jel'] = $model->joinFourTables('guru_mapel',
            'user',         
            'blok',         
            'kelas',        
            'guru_mapel.id_user_guru = user.id_user',     // Join guru_mapel with user
            'guru_mapel.id_blok = blok.id_blok',          // Join guru_mapel with blok
            'guru_mapel.id_kelas = kelas.id_kelas',   'guru_mapel.id_guru_mapel'
        );
        
        $user_id = session()->get('id');
        $model->logActivity($user_id, 'user', 'User in data jadwal page');

        echo view('header');
        echo view('menu', $data);
        echo view('data_jadwal', $data);
    } else {
        return redirect()->to(base_url('home/login'));
    }
}




public function supervisi()
{
    if (session()->get('level')> 0) {
        $model = new M_burger();
        // $data['jel'] = $model->tampil('supervisi');
        $data['jel']=$model->query('select * from supervisi  where deleted_at IS NULL');

        
        $user_id = session()->get('id');
        $model->logActivity($user_id, 'user', 'User in supervisi page');

        echo view('header');
        echo view('menu', $data);
        echo view('supervisi', $data);
    } else {
        return redirect()->to(base_url('home/login'));
    }
}

public function aksi_t_supervisi()
{
    $user_id = session()->get('id');
    $a = $this->request->getPost('nama_guru');
    $c = $this->request->getPost('kerajinan_guru');
    $b = $this->request->getPost('silabus');
    $d = $this->request->getPost('modul');
    $e = $this->request->getPost('cv');
    $f = $this->request->getPost('atp');
    $g = $this->request->getPost('prota');
    $h = $this->request->getPost('media_pembelajaran');
    $i = $this->request->getPost('kreatif');
    $j = $this->request->getPost('sesuai_materi');
    $k = $this->request->getPost('keterangan');
    
    // Get current timestamp
    $created_at = date('Y-m-d H:i:s');

    // Prepare the data for inserting into the 'supervisi' table
    $sis = array(
        'nama_guru' => $a,
        'kerajinan_guru' => $c,
        'silabus' => $b, 
        'modul' => $d, 
        'cv' => $e,
        'atp' => $f,  
        'prota' => $g, 
        'media_pembelajaran' => $h, 
        'kreatif' => $i, 
        'sesuai_materi' => $j, 
        'keterangan' => $k,
        'created_at' => $created_at // Add current timestamp
    );

    // Instantiate the model and add the new supervision data
    $model = new M_burger;
    $model->tambah('supervisi', $sis);

    // Log the activity
    $model->logActivity($user_id, 'user', 'User added a new supervision data');

    // Redirect the user after the operation is completed
    return redirect()->to('http://localhost:8080/home/supervisi');
}


public function restore()
{
    if (session()->get('level')>0) {
        $model= new M_burger;
        $user_id = session()->get('id');
        $data['jel']=$model->query('select * from supervisi where deleted_at IS NOT NULL');
        $model->logActivity($user_id, 'user', 'User in restore page');
        echo view('header');
        echo view('menu',$data);
        echo view('restore',$data);
    }else{
        return redirect()->to('http://localhost:8080/home/login');
    }
}
public function aksi_restore($id)
{
    $user_id = session()->get('id');
    $model = new M_burger();

    $where= array('id_supervisi'=>$id);
    $isi = array(
        'deleted_at'=>NULL
    );
    $model->edit('supervisi', $isi,$where);
    $model->logActivity($user_id, 'supervisi', 'User restore a data');  

    return redirect()->to('home/restore');
}
public function h_supervisi($id)
{
    $model= new M_burger;
    $user_id = session()->get('id');
    $kil= array('id_supervisi'=>$id);
    $isi= array(
        'deleted_at'=>date('Y-m-d H:i:s'));
    $model->edit('supervisi',$isi,$kil);
    $model->logActivity($user_id, 'user', 'User deleted a supervisi data');
    // $model->hapus('makanan',$kil);
    return redirect()-> to('http://localhost:8080/home/supervisi');
}




public function setting()
{
    if (session()->get('level') > 0) {
        $model = new M_burger();
        $user_id = session()->get('id');
        $data['jes'] = $model->tampilgambar('toko'); // Mengambil data dari tabel 'toko'
        $model->logActivity($user_id, 'setting', 'User in setting page');
        $data['jes'] = $model->tampilgambar('toko');
        
        echo view('header');
        echo view('menu', $data); // Mengirimkan data ke menu.php
        echo view('setting', $data); // Mengirimkan data ke setting.php
    } else {
        return redirect()->to('http://localhost:8080/home/login');
    }
}

public function aksietoko()
{
    $model = new M_burger();
    $user_id = session()->get('id');
    $nama = $this->request->getPost('nama');
    $id = $this->request->getPost('id');
    $uploadedFile = $this->request->getFile('foto');

    $where = array('id_toko' => $id);

    $isi = array(
        'nama_toko' => $nama
    );

    // Cek apakah ada file yang diupload
    if ($uploadedFile && $uploadedFile->isValid() && !$uploadedFile->hasMoved()) {
        $foto = $model->uploadgambar($uploadedFile); // Mengupload file baru dan hapus yang lama
        $isi['logo'] = $foto; // Menambahkan nama file baru ke array data
    }

    $model->logActivity($user_id, 'user', 'User changed a profile company');

    $model->editgambar('toko', $isi, $where);

    return redirect()->to('home/setting');
}




public function laporan()
{
    if (session()->get('level')>0) {
        $model = new M_burger();
        $user_id = session()->get('id');
        $model->logActivity($user_id, 'laporan', 'User in laporan');
        echo view('header');
        echo view('menu');
        echo view('laporan');
    } else {
        return redirect()->to('http://localhost:8080/home/login');
    }
}

public function generate_report()
{
    if (session()->get('level') > 0) {
        $start_date = $this->request->getPost('start_date');
        $end_date = $this->request->getPost('end_date');
        $report_type = $this->request->getPost('report_type');

        switch ($report_type) {
            case 'pdf':
            $this->generate_pdf($start_date, $end_date);
            break;
            case 'excel':
            $this->generate_excel($start_date, $end_date);
            break;
            case 'window':
            $this->generate_window_result($start_date, $end_date);
            break;
            default:
            return redirect()->to('home/error');
        }
    } else {
        return redirect()->to('home/login');
    }
}


private function generate_pdf($start_date, $end_date)
{
    $model = new M_burger();
    $data['laporan'] = $model->getLaporanByDate($start_date, $end_date);

    $options = new Options();
    $options->set('defaultFont', 'Arial');
    $dompdf = new Dompdf($options);
    $html = view('laporan_pdf', $data);
    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'portrait');
    $dompdf->render();
    $dompdf->stream("laporan.pdf", array("Attachment" => false));
}

private function generate_excel($start_date, $end_date)
{
    $model = new M_burger();
    $data['laporan'] = $model->getLaporanByDateForExcel($start_date, $end_date);

    $spreadsheet = new Spreadsheet();
    $spreadsheet->getProperties()->setCreator("Your Name")->setLastModifiedBy("Your Name")
    ->setTitle("Laporan Loker")->setSubject("Laporan Loker")
    ->setDescription("Laporan Transaksi")->setKeywords("Spreadsheet")
    ->setCategory("Report");

    $sheet = $spreadsheet->getActiveSheet();
    $sheet->setCellValue('A1', 'nama guru')
    ->setCellValue('B1', 'kerajinan guru')
    ->setCellValue('C1', 'silabus')
    ->setCellValue('D1', 'modul')
    ->setCellValue('E1', 'media pembelajaran')
    ->setCellValue('F1', 'kesesuaian materi');

    $rowCount = 2;
    foreach ($data['laporan'] as $row) {
        $sheet->setCellValue('A' . $rowCount, $row['nama_guru'])
        ->setCellValue('B' . $rowCount, $row['kerajinan_guru'])
        ->setCellValue('C' . $rowCount, $row['silabus'])
        ->setCellValue('D' . $rowCount, $row['modul'])
        ->setCellValue('E' . $rowCount, $row['media_pembelajaran'])
        ->setCellValue('F' . $rowCount, $row['sesuai_materi']);

        $rowCount++;
    }

    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="laporan_transaksi.xlsx"');
    header('Cache-Control: max-age=0');

    $writer = new Xlsx($spreadsheet);
    $writer->save('php://output');
}

private function generate_window_result($start_date, $end_date)
{
    $model = new M_burger();
    $data['formulir'] = $model->getLaporanByDate($start_date, $end_date);
    echo view('cetak_hasil', $data);
}



}
