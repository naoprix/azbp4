<?php
//Documentsコントローラ

//App::uses('FileSaver', 'Lib');//ファイルを書き出すクラスだったような。

class DocumentsController extends AppController {//クラス名はテーブル名と整合をとること。
    
    public $helpers = array('Html', 'Form', 'Session');
    //public $components = array('Session', 'Auth', 'Filebinder.Ring');
    public $uses = array('Document','Contractdocument', 'Contract');


    public function index() {
        $document = $this->Document->find('all');
        $this->set('document',$document);
    }


    public function add($contractdocument_id=null) {
        ////
        //良くわからないので、パラメータがない場合のエラー処理を入れてみた。
        if (!$contractdocument_id) {
            throw new NotFoundException(__('No parameter is given'));
        }

        $this->set('contractdocument_id',$contractdocument_id);

        $contractdocument = $this->Contractdocument->findById($contractdocument_id);
        $this->set('contractdocument',$contractdocument);

        if ($this->request->is('post')) {

            if ($this->request->data) {
                
                $file = $this->request->data['Document']['file'];//アップロードされたファイルのデータを格納

                $original_filename = $file['name'];
                $uploaded_file = $file['tmp_name'];
                $filesize = $file['size'];
                $filetype = $file['type'];

                $doc_list_id = $this->request->data['Document']['doc_list_id'];//フォーム側から渡された書類番号ID

                $newdata_no = $this->Document->find('count', 
                                                    array('conditions' => 
                                                        array('Document.contractdocument_id' => $doc_list_id)))
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
                    return $this->redirect(array('action' => 'add', $contractdocument_id));
                }else{
                    $title = preg_replace("/(\W)+/","",$contractdocument['Contractdocument']['title']);
 
                    $newfilename = $contractdocument['Contractdocument']['contract_code'].'-'.
                                    $title.'-'.
                                    $contractdocument['Contractdocument']['date'].'-'.
                                    $newdata_no.'.'.
                                    $fileext;

                    $newdata = array('contractdocument_id' => $doc_list_id,
                                'filename' => $newfilename);
                    $this->Document->save($newdata);

                    $dest_fullpath = APP.'tmp/'.$newfilename;

                    move_uploaded_file($file['tmp_name'], $dest_fullpath);
                   
                    $this->Session->setFlash(__('File Uploaded'));
                }

            }else{

                $this->Session->setFlash(__('Failed to File Upload'));

            }

            return $this->redirect(array('controller' => 'Contractdocuments',
                                 'action' => 'document_list', 
                                 $contractdocument['Contractdocument']['contract_code']));
        }
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

}


