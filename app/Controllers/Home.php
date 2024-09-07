<?php

namespace App\Controllers;
use App\Models\M_burger;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Dompdf\Dompdf;
use Dompdf\Options;

class Home extends BaseController
{
    public function dashboard()
    {
        if(session()->get('level')>0){ 
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
        $data['jel']= $model->tampil('user');
        echo view('header');
        echo view('register',$data);
    }
public function aksi_t_register()
    {
        $a= $this->request->getPost('nama');
        $b= md5($this->request->getPost('pass'));
        $c= $this->request->getPost('jk');

        $sis= array(
            'level'=>'1',
            'username'=>$a,
            'pw'=>$b,
            'jk'=>$c);
        $model= new M_burger;
        $model->tambah('user',$sis);
        return redirect()-> to ('http://localhost:8080/home/login');
    }


    public function activity_log() 
{   
    if(session()->get('level')>0){
    $model = new M_burger();
    $logs = $model->getActivityLogs();

    $data['logs'] = $logs;
    $data['jes'] = $model->tampilgambar('toko'); 

    $where = array(
        'id_toko' => 1
    );
    $data['setting'] = $model->getWhere('toko', $where);

    echo view('header');
    echo view('menu', $data);
    return view('activity_log', $data);
    }else{
            return redirect()->to('http://localhost:8080/home/login');
    }
}

public function error()   
{
    if(session()->get('level')>0){
            echo view('header');
            echo view('menu');
            echo view('error');
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
        $data['jel'] = $model->tampil('user');
        // $data['jes'] = $model->tampilgambar('toko');
        $id = 1; // id_toko yang diinginkan

        // Menyusun kondisi untuk query
        $where = array('id_toko' => $id);

        // Mengambil data dari tabel 'toko' berdasarkan kondisi
        $data['user'] = $model->getWhere('toko', $where);

        // Memuat view
        // $data['setting'] = $model->getWhere('toko', $where);

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
    $data['jes'] = $model->tampilgambar('toko'); // Mengambil data dari tabel 'toko'
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
    $b = md5($this->request->getPost('pass'));
    $c = $this->request->getPost('jk');
    $u = $this->request->getPost('level');

    // Prepare the data for inserting into the 'user' table
    $sis = array(
        'level' => $u,
        'username' => $a,
        'pw' => $b,
        'jk' => $c
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
    $b= md5($this->request->getPost('pw'));
    $c= $this->request->getPost('jk');
    $d= $this->request->getPost('level');
    $id=$this->request->getPost('id');
    $where = array('id_user'=>$id);
    $isi= array(
        'username'=>$a,
        'pw'=>$b,
        'jk'=>$c,
        'level'=>$d);
    $model->edit('user',$isi,$where);
    $model->logActivity($user_id, 'user', 'User updated a menu burger data');
    return redirect()-> to ('http://localhost:8080/home/user');
}

public function form()
{
    if (session()->get('level')>0) {
        $model = new M_burger();
        $data['jel'] = $model->tampil('form');

        $user_id = session()->get('id');
        $model->logActivity($user_id, 'user', 'User in form page');

        echo view('header');
        echo view('menu', $data);
        echo view('form', $data);
    } else {
        return redirect()->to(base_url('home/login'));
    }
}

public function aksi_t_form()
{
    $user_id = session()->get('id');
    $a = $this->request->getPost('nama');
    $b = $this->request->getPost('nis');
    $c = $this->request->getPost('jurusan');
    $d = $this->request->getPost('tahun_lulus');
    $e = $this->request->getPost('tempat_kerja');
    $f = $this->request->getPost('alamat_kerja');
    $g = $this->request->getPost('tempat_kuliah');
    $h = $this->request->getPost('alamat_kuliah');

    // Prepare the data for inserting into the 'user' table
    $sis = array(
        'nama' => $a,
        'nis' => $b,
        'jurusan' => $c,
        'tahun_lulus' => $d,
        'tempat_kerja' => $e,
        'alamat_kerja' => $f,
        'tempat_kuliah' => $g,
        'alamat_kuliah' => $h
    );

    // Instantiate the model and add the new user data
    $model = new M_burger;
    $model->tambah('form', $sis);

    $model->logActivity($user_id, 'user', 'User submit a data');  

    // Redirect the user after the operation is completed
    return redirect()->to('http://localhost:8080/home/form');
}

public function alumni()
{
    if (session()->get('level')>0) {
        $model = new M_burger();
        $data['jel'] = $model->tampil('form');

        $user_id = session()->get('id');
        $model->logActivity($user_id, 'user', 'User in form page');

        echo view('header');
        echo view('menu', $data);
        echo view('alumni', $data);
    } else {
        return redirect()->to(base_url('home/login'));
    }
}

public function loker()
{
    if (session()->get('level')>0) {
        $model = new M_burger();
        // $data['jel'] = $model->tampil('loker', 'lamaran', 'loker.id_lamaran=lamaran.id_lamaran', 'loker=id_loker');
        $data['jel']=$model->query('select * from loker  where deleted_at IS NULL');

        $user_id = session()->get('id');
        $model->logActivity($user_id, 'user', 'User in loker page');

        echo view('header');
        echo view('menu', $data);
        echo view('loker', $data);
    } else {
        return redirect()->to(base_url('home/login'));
    }
}

// public function h_loker($id)
// {
//     $model = new M_burger();
//     $id_user = session()->get('id');
//     $kil = array('id_loker' => $id);
//     $model->hapus('loker', $kil);
//     $model->logActivity($id_user, 'user', 'User deleted a loker data.');
//     return redirect()->to(base_url('home/loker'));
// }


public function aksi_t_loker()
{
    $user_id = session()->get('id');
    $a = $this->request->getPost('nama');
    $b = $this->request->getPost('posisi');
    $c = $this->request->getPost('lokasi');
    $d = $this->request->getPost('deskripsi');
    $e = $this->request->getPost('batas_lamaran');
    $f = $this->request->getPost('contact');
    $g = $this->request->getPost('syarat');
    $h = $this->request->getPost('jenis_pekerjaan');

    // Prepare the data for inserting into the 'user' table
    $sis = array(
        'nama' => $a,
        'posisi' => $b,
        'lokasi' => $c,
        'deskripsi' => $d,
        'batas_lamaran' => $e,
        'contact' => $f,
        'syarat' => $g,
        'jenis_pekerjaan' => $h
    );

    // Instantiate the model and add the new user data
    $model = new M_burger;
    $model->tambah('loker', $sis);

    $model->logActivity($user_id, 'user', 'User submit a new loker');  

    // Redirect the user after the operation is completed
    return redirect()->to('http://localhost:8080/home/loker');
}

public function aksi_e_loker()
{
    $model = new M_burger; // Pastikan model ini sesuai dengan nama model yang digunakan
    $user_id = session()->get('id');

    $id = $this->request->getPost('id_loker'); // Perbaiki nama parameter untuk ID
    $a = $this->request->getPost('nama');
    $b = $this->request->getPost('posisi');
    $c = $this->request->getPost('lokasi');
    $d = $this->request->getPost('deskripsi');
    $e = $this->request->getPost('batas_lamaran');
    $f = $this->request->getPost('contact');
    $g = $this->request->getPost('syarat');
    $h = $this->request->getPost('jenis_pekerjaan');

    $where = array('id_loker' => $id);
    $isi = array(
        'nama' => $a,
        'posisi' => $b,
        'lokasi' => $c,
        'deskripsi' => $d,
        'batas_lamaran' => $e,
        'contact' => $f,
        'syarat' => $g,
        'jenis_pekerjaan' => $h
    );

    // Pastikan method edit pada model sesuai dengan parameter yang dibutuhkan
    $model->edit('loker', $isi, $where);
    $model->logActivity($user_id, 'user', 'User updated a loker data');

    // Redirect ke halaman yang sesuai setelah update
    return redirect()->to('http://localhost:8080/home/loker');
}


public function aksi_t_lamaran()
{
    $user_id = session()->get('id');
    $nama_depan = $this->request->getPost('nama_depan');
    $nama_belakang = $this->request->getPost('nama_belakang');
    $lokasi1 = $this->request->getPost('lokasi');
    $nomor = $this->request->getPost('nomor');
    $email = $this->request->getPost('email');
    $id_loker = $this->request->getPost('id_loker');

    // Prepare the data for inserting into the 'lamaran' table
    $lamaranData = array(
        'nama_depan' => $nama_depan,
        'nama_belakang' => $nama_belakang,
        'lokasi1' => $lokasi1,
        'nomor' => $nomor,
        'email' => $email,
        'id_loker' => $id_loker,
        'kode' => $this->generateKode()  // Generate a unique code if needed
    );

    // Instantiate the model and add the new lamaran data
    $model = new M_burger;
    $model->tambah('lamaran', $lamaranData);

    // Log the activity
    $model->logActivity($user_id, 'user', 'User submitted a new loker');  

    // Redirect the user after the operation is completed
    return redirect()->to('http://localhost:8080/home/loker');
}

private function generateKode()
{
    return uniqid(); // Or use a more sophisticated method to generate a unique code
}


public function inbox()
{
    if (session()->get('level')>0) {
        $model = new M_burger();
        $data['jel'] = $model->join('lamaran', 'loker', 'lamaran.id_loker=loker.id_loker', 'lamaran.id_lamaran');

        $user_id = session()->get('id');
        $model->logActivity($user_id, 'user', 'User in loker page');

        echo view('header');
        echo view('menu', $data);
        echo view('inbox', $data);
    } else {
        return redirect()->to(base_url('home/login'));
    }
}



public function hapusproduk($id){
    $model = new M_burger();
    $id_user = session()->get('id'); // Ambil ID user dari session
    $activity = 'Menghapus produk'; // Deskripsi aktivitas
    $this->addLog($id_user, $activity);

    // Data yang akan diupdate untuk soft delete
    $data = [
        'isdelete' => 1,
        'deleted_by' => $id_user,
        'deleted_at' => date('Y-m-d H:i:s') // Format datetime untuk deleted_at
    ];

    // Update data produk dengan kondisi id_produk sesuai
    $model->logActivity($id_user, 'user', 'User deleted a product');
    $model->edit('loker', $data, ['id_makanan' => $id]);

  return redirect()->to('home/loker');
}
public function restore()
{
    if (session()->get('level')>0) {
        $model= new M_burger;
        $user_id = session()->get('id');
        $data['jel']=$model->query('select * from loker where deleted_at IS NOT NULL');
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

    $where= array('id_loker'=>$id);
    $isi = array(
        'deleted_at'=>NULL
    );
    $model->edit('loker', $isi,$where);
    $model->logActivity($user_id, 'loker', 'User restore a data');  

    return redirect()->to('home/restore');
}
public function h_loker($id)
{
    $model= new M_burger;
    $user_id = session()->get('id');
    $kil= array('id_loker'=>$id);
    $isi= array(
        'deleted_at'=>date('Y-m-d H:i:s'));
    $model->edit('loker',$isi,$kil);
    $model->logActivity($user_id, 'user', 'User deleted a loker');
    // $model->hapus('makanan',$kil);
    return redirect()-> to('http://localhost:8080/home/loker');
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
    $sheet->setCellValue('A1', 'nama')
        ->setCellValue('B1', 'posisi')
        ->setCellValue('C1', 'lokasi')
        ->setCellValue('D1', 'batas lamaran')
        ->setCellValue('E1', 'contact')
        ->setCellValue('F1', 'jenis_pekerjaan');

    $rowCount = 2;
    foreach ($data['laporan'] as $row) {
        $sheet->setCellValue('A' . $rowCount, $row['nama'])
            ->setCellValue('B' . $rowCount, $row['posisi'])
            ->setCellValue('C' . $rowCount, $row['lokasi'])
            ->setCellValue('D' . $rowCount, $row['batas_lamaran'])
            ->setCellValue('E' . $rowCount, $row['contact'])
            ->setCellValue('F' . $rowCount, $row['jenis_pekerjaan']);
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
