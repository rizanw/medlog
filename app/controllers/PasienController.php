<?php

use Phalcon\Mvc\Controller;
use Phalcon\Http\Response;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class PasienController extends Controller
{
    public function sendToken($token, $email, $nama)
    {
        $message = file_get_contents(APP_PATH . '/templates/email/verify-email.html');
        $message = str_replace('%token%', $token, $message);

        $mail = new PHPMailer(true);
        try {
            //Server settings
            $mail->SMTPDebug = 2;
            $mail->isSMTP();
            $mail->Host = 'mail.rzndwb.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'medlog@rzndwb.com';
            $mail->Password = 'aplikasiku';
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;

            //Recipients
            $mail->setFrom('medlog@rzndwb.com', 'MedLog');
            $mail->addAddress($email, $nama);


            //Content
            $mail->isHTML(true);
            $mail->Subject = 'Verifikasi Alamat Email - MedLog';
            $mail->MsgHTML($message);
            $mail->CharSet = "utf-8";
            $mail->AltBody = 'Berikut adalah kode untuk verifikasi email = ' . $token;

            $mail->send();
            echo 'Message has been sent';
           // print_r('Message has been sent');
            //die();
        } catch (Exception $e) {
            echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
            //print_r('Message could not be sent. Mailer Error: ', $mail->ErrorInfo);
            //die();
        }
    }

    public function sendToken2($token, $email, $nama)
    {
        $message = file_get_contents(APP_PATH . '/templates/email/reset-email.html');
        $message = str_replace('%token%', $token, $message);

        $mail = new PHPMailer(true);
        try {
            //Server settings
            $mail->SMTPDebug = 2;
            $mail->isSMTP();
            $mail->Host = 'mail.rzndwb.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'medlog@rzndwb.com';
            $mail->Password = 'aplikasiku';
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;

            //Recipients
            $mail->setFrom('medlog@rzndwb.com', 'MedLog');
            $mail->addAddress($email, $nama);


            //Content
            $mail->isHTML(true);
            $mail->Subject = 'Reset password - MedLog';
            $mail->MsgHTML($message);
            $mail->CharSet = "utf-8";
            $mail->AltBody = 'Berikut adalah kode untuk reset password = ' . $token;

            $mail->send();
            echo 'Message has been sent';
           // print_r('Message has been sent');
            //die();
        } catch (Exception $e) {
            echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
            //print_r('Message could not be sent. Mailer Error: ', $mail->ErrorInfo);
            //die();
        }
    }

    public function pasienverifikasiAction()
    {
        $_isPasien = $this->session->get('auth')['tipe'];
        if ($_isPasien == 1){
            return $this->response->redirect('dokter/home');
        }elseif($_isPasien != 2){
            return $this->response->redirect('pasien/login');
        }
    }

    public function verifikasiAction()
    {
        $data = Pasien::findFirst(
            [
                'columns' => '*',
                'conditions' => 'idpasien = ?1 AND token = ?2',
                'bind' => [
                    1 => $this->session->get('auth')['id'],
                    2 => $this->request->getPost('token'),
                ]
            ]
        );

        if ($data) {
            $data->status = 1;
            if ($data->save() === false) {
                foreach ($data->getMessages() as $message) {
                    echo $message, "\n";
                }
            } else {
                $this->response->redirect('pasien/home');
            }
        }
    }

    /*
     * Register for Dokter
     */
    public function lupapasswordAction()
    {

    }

    public function resetpasswordAction()
    {

    }

    public function resetpasswordstoreAction()
    {
        $data = Pasien::findFirst(
            [
                'columns' => '*',
                'conditions' => 'username = ?1 AND token2 = ?2',
                'bind' => [
                    1 => $this->request->getPost('username'),
                    2 => $this->request->getPost('token'),
                ]
            ]
        );

        if ($data) {
            $data->status2 = 1;
            $password = $this->request->getPost('password');
            $data->password = $this->security->hash($password);
            if ($data->save() === false) {
                foreach ($data->getMessages() as $message) {
                    echo $message, "\n";
                }
            } else {
                $this->response->redirect('pasien/home');
            }
        }
    }

    public function lupapasswordstoreAction()
    {
        $username = $this->request->getPost('username');
        $user = Pasien::findFirst("username='$username'");
        $email = $user->email;
        if ($user) {
            $token = substr(md5($email . mt_rand()), 0, 10);
            $this->sendToken2($token, $email, $username);
            $user->token2 = $token;
            $user->save();
            return $this->response->redirect('pasien/resetpassword');
        }
    }

    /*
     * Register for pasien
     */
    public function createAction()
    {
        $_isPasien = $this->session->get('auth')['tipe'];
        if ($_isPasien == 1) {
            return $this->response->redirect('dokter/home');
        } elseif ($_isPasien == 2) {
            return $this->response->redirect('pasien/home');
        }
    }

    public function storeAction()
    {
        $pasien = new Pasien();

        $username = $this->request->getPost('username');
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');
        
        $data = Pasien::findFirst(
            [
                'columns' => '*',
                'conditions' => 'username = ?1 OR email = ?2',
                'bind' => [
                    1 => $username,
                    2 => $email,
                ]
            ]
        );

        if($data)
        {
            echo "gunakan username atau email lain";
            echo "<a href=".$this->url->getBasePath() ."> back</a>";
        }
        else{
            $pasien->username = $username;
            $pasien->email = $email;
            $pasien->password = $this->security->hash($password);
            $token = substr(md5($email . mt_rand()), 0, 10);
            $pasien->token = $token;
            //kirim email verifikasi
            $this->sendToken($token, $email, $username);
            if ($pasien->save() === false) {
                foreach ($pasien->getMessages() as $message) {
                    echo $message, "\n";
                }
            } else {
                $this->response->redirect();
            }
        }
        
    }

    /*
     * Create and store login session for pasien
     */
    public function create1Action()
    {
        $_isPasien = $this->session->get('auth')['tipe'];
        if ($_isPasien == 1) {
            return $this->response->redirect('dokter/home');
        } elseif ($_isPasien == 2) {
            return $this->response->redirect('pasien/home');
        }
    }

    public function store1Action()
    {
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $user = Pasien::findFirst("email='$email'");

        if ($user) {
            if ($this->security->checkHash($password, $user->password)) {
                $this->session->set(
                    'auth',
                    [
                        'id' => $user->idpasien,
                        'username' => $user->username,
                        'tipe' => '2',
                    ]
                );

                (new Response())->redirect('pasien/home')->send();
            } else {
                $this->security->hash(rand());
                (new Response())->redirect('pasien/login')->send();
            }
        } else {
            (new Response())->redirect('pasien/login')->send();
        }
    }

    /*
     * logout and destroy session for pasien
     */
    public function destroyAction()
    {
        $this->session->destroy();
        $this->response->redirect();
    }

    /*
     * Homepage for pasien
     */
    public function homeAction()
    {
        $_isPasien = $this->session->get('auth')['tipe'];
        if ($_isPasien == 1){
            return $this->response->redirect('dokter/home');
        }elseif($_isPasien != 2){
            return $this->response->redirect('pasien/login');
        }
        $id = $this->session->get('auth')['id'];
        $user = Pasien::findFirst("idpasien='$id'");
        if ($user->status == 0) {
            (new Response())->redirect('pasien/pasienverifikasi')->send();
        }
    }

    public function datapasienAction()
    {
        
        $_isPasien = $this->session->get('auth')['tipe'];
        if ($_isPasien == 1){
            return $this->response->redirect('dokter/home');
        }elseif($_isPasien != 2){
            return $this->response->redirect('pasien/login');
        }
        $id = $this->session->get('auth')['id'];
        $user = Pasien::findFirst("idpasien='$id'");
        if ($user->status == 0) {
            (new Response())->redirect('pasien/pasienverifikasi')->send();
        }
        $this->view->user = Pasien::findFirst("idpasien='$id'");

        // $this->view->user = $user;
    }

    public function datapasienstoreAction()
    {
        $id = $this->session->get('auth')['id'];
        $pasien = Pasien::findFirst("idpasien='$id'");

        $email = $this->request->getPost('email');
        $nama = $this->request->getPost('nama');
        $alamat = $this->request->getPost('alamat');
        $telepon = $this->request->getPost('telepon');
        $nik = $this->request->getPost('nik');
        $pekerjaan = $this->request->getPost('pekerjaan');
        $foto = $this->request->getPost('foto');
        $tgllahir = $this->request->getPost('tgllahir');
        if($this->request->getPost('gender')=='pria')
        $pasien->jkel = 'L';
        else if($this->request->getPost('gender')=='wanita')
        $pasien->jkel = 'P';

        if($this->request->hasFiles() == true){
            $file = file_get_contents($_FILES['foto']['tmp_name']);
            $efile = base64_encode($file);


        }

        $pasien->email = $email;
        $pasien->nama = $nama;
        $pasien->tgllahir = $tgllahir;
        $pasien->alamat = $alamat;
        $pasien->telepon = $telepon;
        $pasien->nik = $nik;
        $pasien->pekerjaan = $pekerjaan;
        $pasien->foto = $efile;

        if ($pasien->save() === false) {
            foreach ($pasien->getMessages() as $message) {
                echo $message, "\n";
            }
        } else {
            $this->response->redirect('pasien/home');
        }
    }

    public function rekapAction()
    {
        $_isPasien = $this->session->get('auth')['tipe'];
        if ($_isPasien == 1)
        {
            return $this->response->redirect('dokter/home');   
        }
        else if($_isPasien != 2){
            return $this->response->redirect('pasien/login');
        }
        $id = $this->session->get('auth')['id'];
        $user = Pasien::findFirst("idpasien='$id'");
        if ($user->status == 0) {
            (new Response())->redirect('pasien/pasienverifikasi')->send();
        }
        
    }

    public function rekapdataAction(){
            $id = $this->session->get('auth')['id'];
            $pasiens = Pemeriksaan::find("idpasien='$id'");
            $data = array();
            
            foreach ($pasiens as $pasien){
            
                
                    $data[] = array(
                        'tglpemeriksaan' => $pasien->tglperiksa,
                        'keluhan' => $pasien->anamnesa,
                    );
                    
               
            }
            

            $content = json_encode($data);
            return $this->response->setContent($content);
        
    }
}