<?php
//Materialapprovalsコントローラ

//App::uses('FileSaver', 'Lib');//ファイルを書き出すクラスだったような。

class MaterialapprovalsController extends AppController {//クラス名はテーブル名と整合をとること。
    
    public $helpers = array('Html', 'Form', 'Session');
    public $components = array('Session', 'Auth', 'Filebinder.Ring');
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
                                ));

        $contract_code = $this->Contract->find('all', 
                    array('conditions' => array('Contract.code'=>$code)));

        $this->set('contract',$contract);
        $this->set('materialapproval',$materialapproval);
        $this->set('contract_code',$contract_code);

    }


    public function add_item($code=null) {
        $materialapproval = $this->Materialapproval->find('all', 
                    array('conditions' => array('Materialapproval.contract_code' => $code),
                        ));
        $this->set('materialapproval', $materialapproval);
        $this->set('contract_code', $code);//契約番号をViewに渡す。

        if ($this->request->is('post')) {

            $this->Materialapproval->create();
            if ($this->Materialapproval->save($this->request->data)) {
                $this->Session->setFlash(__('Material Approval Item Added'));
                return $this->redirect(array('action' => 'approval_list', 
                                $this->request->data['Materialapproval']['contract_code']));
            }
            $this->Session->setFlash(__('Failed to add Material Approval Item'));
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



}


