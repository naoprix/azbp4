<?php
//Correspondencesコントローラ

//App::uses('FileSaver', 'Lib');//ファイルを書き出すクラスだったような。

class CorrespondencesController extends AppController {//クラス名はテーブル名と整合をとること。
    
    public $helpers = array('Html', 'Form', 'Session');
    public $components = array('Session', 'Filebinder.Ring');
    public $uses = array('Correspondence', 'Contract');

    public function index() {
        $correspondence = $this->Correspondence->find('all');
        $this->set('correspondence',$correspondence);
    }

    public function corres_list($code) {
        $contract = $this->Contract->find('all',
                            array('conditions' => array('Contract.code'=>$code),
                                'order' => array('Contract.vo_no' => 'asc')
                                ));
        $this->paginate = array('Correspondence' => array(
                                'conditions' => array('Correspondence.contract_code' =>$code),
                                'limit' => 20,
                                'order' => array('Correspondence.date' => 'desc',
                                                'Correspondence.ref_no' => 'desc')));
        
        $contract_code = $this->Contract->find('all', 
                    array('conditions' => array('Contract.code'=>$code)));

        $this->set('contract',$contract);
        $this->set('correspondence',$this->Paginate());
        $this->set('contract_code',$contract_code);

    }


    public function add($code=null) {
        $correspondence = $this->Correspondence->find('all', 
                    array('conditions' => array('Correspondence.contract_code' => $code),
                        'fields' => array('Correspondence.ref_no', 'Correspondence.date'),
                        'order' => array('Correspondence.date' => 'desc'),
                        'limit' => 30));
        $this->set('correspondence', $correspondence);
        $this->set('contract_code', $code);//契約番号をViewに渡す。
        if ($this->request->is('post')) {

            //$this->Ring->bindUp();
            //これでFileBinderが実装できるらしい。

            $this->Correspondence->create();
            if ($this->Correspondence->save($this->request->data)) {
                $this->Session->setFlash(__('Correspondence Data Added'));
                return $this->redirect(array('action' => 'corres_list', 
                                $this->request->data['Correspondence']['contract_code']));
            }
            $this->Session->setFlash(__('Failed to add Correspondence Data'));
            return $this->redirect(array('action' => 'corres_list', 
                                $this->request->data['Correspondence']['contract_code']));

        }
    }


    public function edit($id) {
        if (!$id) {
            throw new NotFoundException(__('パラメータが来てませんよ-'));
        }

        $correspondence = $this->Correspondence->findById($id);
        if (!$correspondence) {
            throw new NotFoundException(__('不正な入力です'));
        }

        $this->set('correspondence', $correspondence);

        if ($this->request->is(array('post', 'put'))) {
            $this->Correspondence->id = $id;
            if ($this->Correspondence->save($this->request->data)) {
                $this->Session->setFlash(__('Correspond Data Updated'));
                //return $this->redirect(array('controller' => 'tops', 'action' => 'index'));    
                return $this->redirect(array('action' => 'corres_list', $correspondence['Correspondence']['contract_code']));
                                    //$this->request->data['Correspondence']['contract_code']));
            }
            $this->Session->setFlash(__('Failed Update'));
            return $this->redirect(array('action' => 'corres_list', 
                                    $this->request->data['Correspondence']['contract_code']));
        }
    }


    public function letter_list($code) {
        $letter_list = $this->Correspondence->find('all');//, 
                                //array('conditions' => array('Contract.vo_no' => '0'),
                                //    'order' => array('code' => 'asc')));
        return $letter_list;
    
    }


////////////以下FileBinderサイトのサンプルコード 
//// Transitionコンポーネントが前提になっているので難

    /**
     * add
     
    public function add() {
        $this->Ring->bindUp();
        $this->Transition->checkData('add_confirm');
        $this->Transition->clearData();
    }

    /**
     * add_confirm
     
    public function add_confirm(){
        $this->Transition->checkPrev(array('add'));

        $this->Transition->automate('add_success',
                                    false,
                                    'add');
        $mergedData = $this->Transition->mergedData();
        $this->set('mergedData', $mergedData);
    }

    /**
     * add_success
    
    public function add_success(){
        $this->Transition->checkPrev(array('add',
                                           'add_confirm'));
        $mergedData = $this->Transition->mergedData();

        if ($this->Post->save($mergedData)) {
            $this->Transition->clearData();
            $this->Session->setFlash(sprintf(__('The %s has been saved', true), 'post'));
            $this->redirect(array('action' => 'index'));
        } else {
            $this->Session->setFlash(sprintf(__('The %s could not be saved. Please, try again.', true), 'post'));
            $this->redirect(array('action' => 'add'));
        }
    }
    */
////////////////




    public function upload() {
        if ($this->request->data) {
            $file = $this->request->data['Correspondence']['file'];//アップロードされたファイルのデータを格納

            $original_filename = $file['name'];
            $uploaded_file = $file['tmp_name'];
            $filesize = $file['size'];
            $filetype = $file['type'];

            $dest_fullpath = APP.'tmp/'.md5(uniqid(rand(), true));

            move_uploaded_file($file['tmp_name'], $dest_fullpath);
        }
    }


}


