<?php
//Contractsコントローラ

//App::uses('CutoffDate', 'Lib');//締日の計算クラスのはず
//App::uses('FileSaver', 'Lib');//ファイルを書き出すクラスだったような。

class ContractsController extends AppController {//クラス名はテーブル名と整合をとること。
    
    public $helpers = array('Html', 'Form', 'Session');
    //public $components = array('Session', 'Auth');
    public $uses = array('Contract', 'Payment', 'User', 'Correspondence');


    public function index() {
        $contract = $this->Contract->find('all', array('order' => array('code' => 'asc', 'vo_no'=> 'asc')));
        $this->set('contract',$contract);
    }


    public function add() {
        if ($this->request->is('post')) {
            $this->Contract->create();
            if ($this->Contract->save($this->request->data)) {
                $this->Session->setFlash(__('Contract Data Added'));
                return $this->redirect(array('controller' => 'Tops','action' => 'index'));
            }
            $this->Session->setFlash(__('Failed to add Contract Data'));
        }
    }


    public function view($code) {
        if (!$code) {
            throw new NotFoundException(__('不正な入力です'));
        }

        $contract = $this->Contract->find('all', 
                    array('conditions' => array('Contract.code'=>$code)));
        $correspondence = $this->Correspondence->find('all',
                    array('conditions' => array('Correspondence.contract_code'=>$code)));
        
        if (!$contract) {
            throw new NotFoundException(__('不正な入力です'));
        }
        
        $this->set('contract', $contract);
        $this->set('correspondence', $correspondence);

    }


    public function add_vo($code) {
        $contract = $this->Contract->find('first', 
                    array('conditions' => array('Contract.code' =>$code)) );
        $this->set('contract', $contract);
        if ($this->request->is('post')) {
            $this->Contract->create();
            if ($this->Contract->save($this->request->data)) {
                $this->Session->setFlash(__('Contract Data Added'));
                return $this->redirect(array('controller'=>'Contracts', 'action' => 'index'));
            }
            $this->Session->setFlash(__('Failed to add Contract Data'));
        }
    }


    public function edit($id=null) {
        if (!$id) {
            throw new NotFoundException(__('パラメータが来てませんよ-'));
        }
        $contract = $this->Contract->findById($id);

        $this->set('contract', $contract);

        if (!$contract) {
            throw new NotFoundException(__('不正な入力です'));
        }

        if ($this->request->is(array('post', 'put'))) {
            $this->Contract->id = $id;
            if ($this->Contract->save($this->request->data)) {
                $this->Session->setFlash(__('Data Updated'));
                return $this->redirect(array(
                    'controller'=>'Contracts',
                    'action' => 'index'));
            }
            $this->Session->setFlash(__('Failed Update'));
        }
    }

    public function index_list() {
        $index_list = $this->Contract->find('all', 
                                array('conditions' => array('Contract.vo_no' => '0'),
                                    'order' => array('code' => 'asc')));
        return $index_list;
    
    }



    public function upload() {
        if ($this->request->data) {
            $file = $this->request->data['Contract']['file'];//アップロードされたファイルのデータを格納

            $original_filename = $file['name'];
            $uploaded_file = $file['tmp_name'];
            $filesize = $file['size'];
            $filetype = $file['type'];

            $dest_fullpath = APP.'tmp/'.md5(uniqid(rand(), true));

            move_uploaded_file($file['tmp_name'], $dest_fullpath);
        }
    }

}


