<?php
//Mtrlapprovdocsコントローラ

//App::uses('FileSaver', 'Lib');//ファイルを書き出すクラスだったような。

class MtrlapprovdocsController extends AppController {//クラス名はテーブル名と整合をとること。
    
    public $helpers = array('Html', 'Form', 'Session');
    public $components = array('Session', 'Auth', 'Filebinder.Ring');
    public $uses = array('Mtrlapprovdoc','Materialapproval', 'Contract');


    public function letter($param) {
        $letter = $this->Mtrlapprovdoc->findById($param);
        return $letter;
    }


    public function add_event($param=null) {

        $materialapproval = $this->Materialapproval->findById($param);
        $this->set('materialapproval', $materialapproval);

        if ($this->request->is('post')) {

            //File名を変更するつもりなのですが、、、うまくいきません。
            $this->request->data['Mtrlapprovdoc']['letter']['file_name'] = 'ABCDEFGHIJKLMN.pdf';

            //FileBinderを実装する。
            $this->Ring->bindUp('Mtrlapprovdoc');

            $this->Mtrlapprovdoc->create();
            if ($this->Mtrlapprovdoc->save($this->request->data)) {
                $mtapp = $this->Materialapproval->findById(
                                                    $this->request->data
                                                    ['Mtrlapprovdoc']['materialapproval_id']);

                $this->Session->setFlash(__('Material Approval Document Added'));
                return $this->redirect(array('controller'=>'Materialapprovals', 
                                            'action' => 'approval_list', 
                                            $mtapp['Materialapproval']['contract_code']));
            }
            $this->Session->setFlash(__('Failed to add Material Aapproval Document'));
            return $this->redirect(array('controller'=>'Materialapprovals', 
                                         'action' => 'approval_list', 
                                         $mtapp['Materialapproval']['contract_code']));
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

}


