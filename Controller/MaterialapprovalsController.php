<?php
//Materialapprovalsコントローラ

//App::uses('FileSaver', 'Lib');//ファイルを書き出すクラスだったような。

class MaterialapprovalsController extends AppController {//クラス名はテーブル名と整合をとること。
    
    public $helpers = array('Html', 'Form', 'Session');
    public $components = array('Session', 'Filebinder.Ring');
    public $uses = array('Materialapproval', 'Contract', 'Correspondence');

    ////
    //このロジックは、ユーザーの権限を制限するためのロジックらしい。
    /*public function isAuthorized($user) {
        // 登録済ユーザーは投稿できる
        if ($this->action === 'add') {
            return true;
        }

        /*　　このロジックちょっと難しそう。投稿オーナーは編集削除可というものらしい。
        // 投稿のオーナーは編集や削除ができる
        if (in_array($this->action, array('edit', 'delete'))) {
            $postId = (int) $this->request->params['pass'][0];
            if ($this->Post->isOwnedBy($postId, $user['id'])) {
                return true;
            }
        }
        
        return parent::isAuthorized($user);
    }*/

    public function index() {
        $materialapproval = $this->Materialapproval->find('all');
        $this->set('materialapproval',$materialapproval);
        ////これは簡単だからいいよね。
    }

    public function approval_list($code) {
        $contract = $this->Contract->find('all',
                            array('conditions' => array('Contract.code'=>$code),
                                'order' => array('Contract.vo_no' => 'asc')
                                ));
        $materialapproval = $this->Materialapproval->find('all',
                            array('conditions' => array('Materialapproval.contract_code'=>$code),
                                //'order' => array('Materialapproval.date' => 'desc')
                                ));

        $contract_code = $this->Contract->find('all', 
                    array('conditions' => array('Contract.code'=>$code)));

        $this->set('contract',$contract);
        $this->set('materialapproval',$materialapproval);
        $this->set('contract_code',$contract_code);

    }


    public function add($code=null) {
        $materialapproval = $this->Materialapproval->find('all', 
                    array('conditions' => array('Materialapproval.contract_code' => $code),
                        //'order' => array('Materialapproval.date' => 'desc')
                        ));
        $this->set('materialapproval', $materialapproval);
        $this->set('contract_code', $code);//契約番号をViewに渡す。
        if ($this->request->is('post')) {

            $this->Ring->bindUp();
            //これでFileBinderが実装できるらしい。

            $this->Materialapproval->create();
            if ($this->Materialapproval->save($this->request->data)) {
                $this->Session->setFlash(__('Materialapproval Data Added'));
                return $this->redirect(array('action' => 'approval_list', 
                                $this->request->data['Materialapproval']['contract_code']));
            }
            $this->Session->setFlash(__('Failed to add Materialapproval Data'));
            return $this->redirect(array('action' => 'approval_list', 
                                $this->request->data['Materialapproval']['contract_code']));

        }
    }


    public function edit($id) {
        if (!$id) {
            throw new NotFoundException(__('パラメータが来てませんよ-'));
        }

        $materialapproval = $this->Materialapproval->findById($id);
        if (!$materialapproval) {
            throw new NotFoundException(__('不正な入力です'));
        }

        $this->set('materialapproval', $materialapproval);

        if ($this->request->is(array('post', 'put'))) {
            $this->Materialapproval->id = $id;
            if ($this->Materialapproval->save($this->request->data)) {
                $this->Session->setFlash(__('Correspond Data Updated'));
                //return $this->redirect(array('controller' => 'tops', 'action' => 'index'));    
                return $this->redirect(array('action' => 'document_list', $materialapproval['Materialapproval']['contract_code']));
                                    //$this->request->data['Materialapproval']['contract_code']));
            }
            $this->Session->setFlash(__('Failed Update'));
            return $this->redirect(array('action' => 'document_list', 
                                    $this->request->data['Materialapproval']['contract_code']));
        }
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
            $file = $this->request->data['Contractdocument']['file'];//アップロードされたファイルのデータを格納

            $original_filename = $file['name'];
            $uploaded_file = $file['tmp_name'];
            $filesize = $file['size'];
            $filetype = $file['type'];

            $dest_fullpath = APP.'tmp/'.md5(uniqid(rand(), true));

            move_uploaded_file($file['tmp_name'], $dest_fullpath);
        }
    }


}


