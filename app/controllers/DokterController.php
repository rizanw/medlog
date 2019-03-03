<?php

use Phalcon\Mvc\Controller;
use Phalcon\Http\Response;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class DokterController extends Controller
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
        } catch (Exception $e) {
            echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
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

    public function dokterverifikasiAction()
    {
        $_isDokter = $this->session->get('auth')['tipe'];
        if ($_isDokter == 2) {
            return $this->response->redirect('pasien/home');
        } elseif ($_isDokter != 1) {
            return $this->response->redirect('dokter/login');
        }
    }

    public function verifikasiAction()
    {
        $data = Dokter::findFirst(
            [
                'columns' => '*',
                'conditions' => 'iddokter = ?1 AND token = ?2',
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
                $this->response->redirect('dokter/home');
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
        $data = Dokter::findFirst(
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
                $this->response->redirect('dokter/home');
            }
        }
    }

    public function lupapasswordstoreAction()
    {
        $username = $this->request->getPost('username');
        $user = Dokter::findFirst("username='$username'");
        $email = $user->email;
        if ($user) {
            $token = substr(md5($email . mt_rand()), 0, 10);
            $this->sendToken2($token, $email, $username);
            $user->token2 = $token;
            $user->save();
            return $this->response->redirect('dokter/resetpassword');
        }
    }

    public function createAction()
    {
        $_isDokter = $this->session->get('auth')['tipe'];
        if ($_isDokter == 2) {
            return $this->response->redirect('pasien/home');
        } elseif ($_isDokter == 1) {
            return $this->response->redirect('dokter/home');
        }

    }

    public function storeAction()
    {
        $dokter = new Dokter();

        $username = $this->request->getPost('username');
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        

        $data = Dokter::findFirst(
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
            echo "gunakan username atau email lain!";
            echo "<a href=".$this->url->getBasePath() ."> back</a>";
        }
        else{
            $dokter->username = $username;
            $dokter->email = $email;
            $dokter->password = $this->security->hash($password);
            //generate verifikasi code (token)
            $token = substr(md5($email . mt_rand()), 0, 10);
            $dokter->token = $token;
            //kirim email verifikasi
            $this->sendToken($token, $email, $username);

            if ($dokter->save() === false) {
                foreach ($dokter->getMessages() as $message) {
                    echo $message, "\n";
                }
            } else {
                return $this->response->redirect('dokter/login');
            }
        }
    }

    /*
     * Create and Store Login session for Dokter
     */
    public function create1Action()
    {
        $_isDokter = $this->session->get('auth')['tipe'];
        if ($_isDokter == 2) {
            return $this->response->redirect('pasien/home');
        } elseif ($_isDokter == 1) {
            return $this->response->redirect('dokter/home');
        }
    }

    public function store1Action()
    {

        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $user = Dokter::findFirst("email='$email'");

        if ($user) {
            if ($this->security->checkHash($password, $user->password)) {
                $this->session->set(
                    'auth',
                    [
                        'id' => $user->iddokter,
                        'username' => $user->username,
                        'tipe' => '1',
                    ]
                );
                (new Response())->redirect('dokter/home')->send();
            } else {
                $this->security->hash(rand());
                (new Response())->redirect('dokter/login')->send();
            }
        } else {
            (new Response())->redirect('dokter/login')->send();
        }
    }

    /*
    * Logout and destroy session for Dokter
    */
    public function destroyAction()
    {
        $this->session->destroy();
        $this->response->redirect();
    }


    /*
     * Dokter's homepage
     */
    public function homeAction()
    {
        $_isDokter = $this->session->get('auth')['tipe'];
        if ($_isDokter == 2) {
            return $this->response->redirect('pasien/home');
        } elseif ($_isDokter != 1) {
            return $this->response->redirect('dokter/login');
        }
        $id = $this->session->get('auth')[id];
        $user = Dokter::findFirst("iddokter='$id'");
        if ($user->status == 0) {
            (new Response())->redirect('dokter/dokterverifikasi')->send();
        }

    }

    public function datadokterAction()
    {
        $_isDokter = $this->session->get('auth')['tipe'];
        if ($_isDokter == 1) {
            $id = $this->session->get('auth')['id'];
            $this->view->user = Dokter::findFirst("iddokter='$id'");
        } elseif ($_isDokter != 1) {
            return $this->response->redirect('dokter/login');
        }

        $user = Dokter::findFirst("iddokter='$id'");
        if ($user->status == 0) {
            (new Response())->redirect('dokter/dokterverifikasi')->send();
        }
        // $this->view->user = $user;
    }

    public function datadokterstoreAction()
    {
        $_isDokter = $this->session->get('auth')['tipe'];
        if ($_isDokter != 1) {
            return $this->response->redirect('dokter/login');
        }

        $id = $this->session->get('auth')['id'];
        $dokter = Dokter::findFirst("iddokter='$id'");

        $email = $this->request->getPost('email');
        $nama = $this->request->getPost('nama');
        $alamat = $this->request->getPost('alamat');
        $telepon = $this->request->getPost('telepon');
        $spesialis = $this->request->getPost('spesialis');
        $provinsi = $this->request->getPost('provinsi');
        $kota = $this->request->getPost('kota');
        $alumni = $this->request->getPost('alumni');
        $tgllahir = $this->request->getPost('tgllahir');
        if ($this->request->getPost('gender') == 'pria')
            $dokter->jkel = 'L';
        else if ($this->request->getPost('gender') == 'wanita')
            $dokter->jkel = 'P';

            if ($this->request->hasFiles() == true) {
                $file = file_get_contents($_FILES['foto']['tmp_name']);
                $efile = base64_encode($file);
            }

        $dokter->email = $email;
        $dokter->nama = $nama;
        $dokter->tgllahir = $tgllahir;
        $dokter->alamat = $alamat;
        $dokter->telepon = $telepon;
        $dokter->spesialis = $spesialis;
        $dokter->provinsi = $provinsi;
        $dokter->kota = $kota;
        $dokter->alumni = $alumni;
        $dokter->foto = $efile;
        // $dokter->fotosize = $file_size;
        // $dokter->fototype = $file_type;


        //$file->moveTo($baseLocation . $file->getName());

        if ($dokter->save() === false) {
            foreach ($dokter->getMessages() as $message) {
                echo $message, "\n";
            }
        } else {
            $this->response->redirect('dokter/home');
        }

    }

    public function lihatpasienAction()
    {
        $_isDokter = $this->session->get('auth')['tipe'];
        if ($_isDokter != 1) {
            return $this->response->redirect('dokter/login');
        }
        $id = $this->session->get('auth')['id'];
        $user = Dokter::findFirst("iddokter='$id'");
        if ($user->status == 0) {
            (new Response())->redirect('dokter/dokterverifikasi')->send();
        }

        //Updated upstream
        // $this->view->datas = Memeriksa::find("iddokter='$id'");

    }

    public function lihatpasiendataAction()
    {
        $id = $this->session->get('auth')['id'];
        $pasiens = Memeriksa::find("iddokter='$id'");
            $data = array();

            foreach ($pasiens as $pasien) {
                $pasien2 = Pasien::find("idpasien='$pasien->idpasien'");
                foreach ($pasien2 as $datpasien) {
                    $data[] = array(
                        'id' => $datpasien->idpasien,
                        'nama' => $datpasien->username,
                        'jkel' => $datpasien->jkel,
                        'link' => $datpasien->idpasien,
                    );
                }


            }
            
            $content = json_encode($data);
            return $this->response->setContent($content);
    }

    public function tambahpasienAction()
    {
        $_isDokter = $this->session->get('auth')['tipe'];
        if ($_isDokter != 1) {
            return $this->response->redirect('dokter/login');
        }
        $id = $this->session->get('auth')[id];
        $user = Dokter::findFirst("iddokter='$id'");
        if ($user->status == 0) {
            (new Response())->redirect('dokter/dokterverifikasi')->send();
        }

    }

    public function tambahpasienstoreAction()
    {

        $id = $this->session->get('auth')['id'];
        $idpasien = $this->request->getPost('idpasien');
        // echo $username;
        $data = Pasien::findFirst("idpasien='$idpasien'");
        // var_dump($data);
        if ($data) {
            $data2 = Memeriksa::findFirst(
                [
                    'columns' => '*',
                    'conditions' => 'idpasien = ?1 AND iddokter = ?2',
                    'bind' => [
                        1 => $data->idpasien,
                        2 => $id,
                    ]
                ]
            );
            if ($data2) {
                echo "data sudah ada";
            } else {
                $memeriksa = new Memeriksa();
                // $memeriksa->username = $username;
                $memeriksa->iddokter = $id;
                $memeriksa->idpasien = $data->idpasien;
                $memeriksa->username = $data->username;

                if ($memeriksa->save() === false) {
                    foreach ($memeriksa->getMessages() as $message) {
                        echo $message, "\n";
                    }
                } else {
                    $this->response->redirect('dokter/lihatpasien');
                }
            }
        } else {
            echo "pasien tidak ditemukan";
//         $pasiens = Memeriksa::find("iddokter='$id'");
//         foreach($pasiens as $pasien)
//         {
//             $this->view->datas = Pasien::find("idpasien='$pasien->idpasien'");
// //Stashed changes
//         }


        }
    }

    public function detailpasienAction($idp)
    {
        $_isDokter = $this->session->get('auth')['tipe'];
        if ($_isDokter != 1) {
            return $this->response->redirect('dokter/login');
        }
        $this->view->pasien = Pasien::findFirst("idpasien='$idp'");
        $this->view->datas = Pemeriksaan::find("idpasien='$idp'");

        

    }

    public function detailpasiendataAction($idp)
    {
        
            $histories = Pemeriksaan::find("idpasien='$idp'");
            $data = array();

            foreach ($histories as $history) {
                $data[] = array(
                    'tgl' => $history->tglperiksa,
                    'keluhan' => $history->keluhan,
                    'prognosis' => $history->prognosis,
                    'link' => $history->idpemeriksaan
                );
            }

            $content = json_encode($data);
            return $this->response->setContent($content);
        
    }

    public function rekammedisAction($idp)
    {
        
        return $this->view->data = Pemeriksaan::findFirst("idpemeriksaan='$idp'");
    }

    public function downloadAction($idp)
    {

        $data2 = Pemeriksaan::findFirst("idpemeriksaan='$idp'");
        $name = $data2->idpasien;
        $type = $data2->filetype;
        $file = base64_decode($data2->filepenunjang);
        $size = $data2->filesize;
        $fileext = $data2->fileext;
        
        header('Content-type: '.$type);
        header('Content-Disposition: attachment; filename="'.$name.'.'.$fileext.'"');
        header('Content-length: '.$size);
        header('Content-Transfer-Encoding: binary'); 
        // header('Expires: 0');
        // header('Pragma: no-cache');
        // ob_clean();
        // flush();
        echo $file;

    }

    public function hapuspasienAction($idp)
    {
        $_isDokter = $this->session->get('auth')['tipe'];
        if ($_isDokter != 1) {
            return $this->response->redirect('dokter/login');
        }
        $id = $this->session->get('auth')['id'];
        $data = Memeriksa::findFirst(
            [
                'columns' => '*',
                'conditions' => 'idpasien = ?1 AND iddokter = ?2',
                'bind' => [
                    1 => $idp,
                    2 => $id,
                ]
            ]
        );

        if ($data !== false) {
            if ($data->delete() === false) {
                $messages = $data->getMessages();

                foreach ($messages as $message) {
                    echo $message, "\n";
                }
            } else {
                return $this->response->redirect('dokter/lihatpasien');
            }
        }


    }

    public function periksaAction($idp)
    {
        $_isDokter = $this->session->get('auth')['tipe'];
        if ($_isDokter != 1) {
            return $this->response->redirect('dokter/login');
        }
        $pasien = Pasien::findFirst("idpasien='$idp'");
        $this->view->pasien2 = $pasien;
        // var_dump($pasien);
        // die();
        if ($pasien->idrekammedis) {
            echo "ada";
        } else {
            echo "tidak ada";
        }
    }

    public function storeperiksaAction()
    {

        $id = $this->session->get('auth')['id'];
        $idpasien = $this->request->getPost('idpasien');
        $pasien = Pasien::findFirst("idpasien='$idpasien'");
        if ($pasien) {
            $pemeriksaan = new Pemeriksaan();

            $pemeriksa = $id;
            $tglperiksa = $this->request->getPost('tglperiksa');
            $anamnesa = $this->request->getPost('anamnesa');
            $objektif = $this->request->getPost('objektif');
            $assesment = $this->request->getPost('assesment');
            $planning = $this->request->getPost('planning');
            $prognosis = $this->request->getPost('prognosis');
            $keluhan = $this->request->getPost('keluhan');
            $lab = $this->request->getPost('lab');
            $icd10 = $this->request->getPost('icd10');


            // if ($this->request->hasFiles() == true) {
            //     $tmp_name = $_FILES['fupload']['tmp_name'];
            //     $file_name = $_FILES['fupload']['name'];
            //     $file_size = $_FILES['fupload']['size']; 
            //     $file_type = $_FILES['fupload']['type']; 

            //     $fp = fopen($tmp_name, 'r'); // open file (read-only, binary)
            //     $file_content = fread($fp, $file_size) or die("Tidak dapat membaca source file"); // read file
                    
            //     // $file_content = $mysqli->real_escape_string($file_content);
    
            //      fclose($fp);
            // }
            if ($this->request->hasFiles() == true) {
                $file = file_get_contents($_FILES['fupload']['tmp_name']);
                $file_type = $_FILES['fupload']['type']; 
                $file_ext=strtolower(end(explode('.',$_FILES['fupload']['name'])));
                $file_size = $_FILES['fupload']['size']; 
                $efile = base64_encode($file);
            }

            $pemeriksaan->pemeriksa = $pemeriksa;
            $pemeriksaan->anamnesa = $anamnesa;
            $pemeriksaan->tglperiksa = $tglperiksa;
            $pemeriksaan->objektif = $objektif;
            $pemeriksaan->assesment = $assesment;
            $pemeriksaan->planning = $planning;
            $pemeriksaan->prognosis = $prognosis;
            $pemeriksaan->keluhan = $keluhan;
            $pemeriksaan->lab = $lab;
            $pemeriksaan->icd10 = $icd10;
            $pemeriksaan->idpasien = $idpasien;
            $pemeriksaan->filepenunjang = $efile;
            $pemeriksaan->filetype = $file_type;
            $pemeriksaan->filesize = $file_size;
            $pemeriksaan->fileext = $file_ext;

            if ($pemeriksaan->save() === false) {
                foreach ($pemeriksaan->getMessages() as $message) {
                    echo $message, "\n";
                }
            } else {
                if (!$pasien->norekammedis) {
                    $pasien->norekammedis = $idpasien;
                    $pasien->save();
                }
                $this->response->redirect('dokter/lihatpasien');
            }


        }
    }


}