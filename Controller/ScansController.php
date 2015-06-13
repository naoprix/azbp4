<?php
//Scansコントローラ

//App::uses('FileSaver', 'Lib');//ファイルを書き出すクラスだったような。

class ScansController extends AppController {//クラス名はテーブル名と整合をとること。
    
    public $helpers = array('Html', 'Form', 'Session');
    //public $components = array('Session', 'Auth', 'Filebinder.Ring');
    public $uses = array('Scan','Correspondence', 'Contract');


    public function index() {
        $scan = $this->Scan->find('all');
        $this->set('scan',$scan);
    }


    public function add($correspondence_id=null) {
        ////
        //良くわからないので、パラメータがない場合のエラー処理を入れてみた。
        if (!$correspondence_id) {
            throw new NotFoundException(__('No parameter is given'));
        }

        $this->set('correspondence_id',$correspondence_id);

        $correspondence = $this->Correspondence->findById($correspondence_id);
        $this->set('correspondence',$correspondence);

        if ($this->request->is('post')) {

            if ($this->request->data) {
                
                $file = $this->request->data['Scan']['file'];//アップロードされたファイルのデータを格納

                $original_filename = $file['name'];
                $uploaded_file = $file['tmp_name'];
                $filesize = $file['size'];
                $filetype = $file['type'];

                $corres_id = $this->request->data['Scan']['corres_id'];//フォーム側から渡されたコレポンID

                $newdata_no = $this->Scan->find('count', 
                                                    array('conditions' => 
                                                        array('Scan.correspondence_id' => $corres_id)))
                                +1;//新データ番号なので一を足しておいた。

                if (strpos($filetype, "pdf")){
                    $fileext = "pdf";
                }elseif (strpos($filetype, "jpeg")){
                    $fileext = "jpg";
                }else{
                    $fileext = "invalid";
                }

                if ($fileext == 'invalid') {
                    $this->Session->setFlash(__('Invalid Filetype'));
                    return $this->redirect(array('action' => 'add', $correspondence_id));
                }else{
                    $ref_no = preg_replace("/(\W)+/","",$correspondence['Correspondence']['ref_no']);
                    $newfilename = $correspondence['Correspondence']['contract_code'].'-'.
                                    $ref_no.'-'.
                                    $correspondence['Correspondence']['date'].'-'.
                                    $newdata_no.'.'.
                                    $fileext;

                    $newdata = array('correspondence_id' => $corres_id,
                                'filename' => $newfilename);
                    $this->Scan->save($newdata);

                    $dest_fullpath = APP.'tmp/'.$newfilename;

                    move_uploaded_file($file['tmp_name'], $dest_fullpath);
                   
                    $this->Session->setFlash(__('File Uploaded'));
                }

            }else{

                $this->Session->setFlash(__('Failed to File Upload'));

            }

            return $this->redirect(array('controller' => 'Correspondences',
                                 'action' => 'corres_list', 
                                 $correspondence['Correspondence']['contract_code']));
        }
    }


    public function download($filename=null) {
        $this->set('filename', $filename);
        $this->autoRender = false; // オートレンダーをOFF。つまりViewを使いません。
        
        if (!$filename) {
            throw new NotFoundException(__('No parameter is given'));
        }

        $this->response->file(
                        APP.'tmp/'.$filename,
                        array('download' => true,
                            'name' => $filename));

        return $this->response->download($filename);
    }


    public function view($filename=null) {
        $this->autoRender = false; // オートレンダーをOFF。つまりViewを使いません。
        
        if (!$filename) {
            throw new NotFoundException(__('No parameter is given'));
        }

        $sfile = APP.'tmp/'.$filename;
        //$content_type = $this->response->type('application/pdf');
        header('Content-Type: application/pdf');
        readfile($sfile);
    }

}


