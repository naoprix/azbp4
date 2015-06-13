<?php
//Mtrlapprovdocsコントローラ

//App::uses('FileSaver', 'Lib');//ファイルを書き出すクラスだったような。

class MtrlapprovdocsController extends AppController {//クラス名はテーブル名と整合をとること。
    
    public $helpers = array('Html', 'Form', 'Session');
    public $components = array('Session', 'Auth', 'Filebinder.Ring');
    //ここにTransitionというコンポーネントが宣言されていたが。。。
    public $uses = array('Mtrlapprovdoc','Materialapproval', 'Contract');

    public function add($param=null) {

        // if(!$param) {
        //     throw new NotFoundException(__('No parameter is given'));
        // }

        $materialapproval = $this->Materialapproval->findById($param);
        $this->set('materialapproval', $materialapproval);

        if ($this->request->is('post')) {

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


        // $approv_type = substr($param, 0, 6);
        // if ($approv_type == 'propos') { 
        //     $type = 'proposal';
        // }elseif ($approv_type == 'review') { 
        //     $type = 'review';
        // }elseif ($approv_type == 'approv') { 
        //     $type = 'approval';
        // }
        // $this->set('approv_type', $type);

        // $materialapproval_id = substr($param, 6);
        // $materialapproval = $this->Materialapproval->findById($materialapproval_id);
        // $this->set('materialapproval',$materialapproval);

    }

/*
Transitionコンポーネントを使っているようだ。


    public function add_confirm() {

        $this->Transition->checkPrev(array('add'));
        $this->Transition->automate('add_success', false, 'add');
        $mergeData = $this->Transition->mergeData();
        $this->set('mergeData', $mergeData);

    }


    public function add_success() {

        $this->Transition->checkPrev(array('add', 'add_confirm'));
        $mergeData = $this->Transition->mergeData();

        if($this->Post->save($mergeData)) {
            $this->Transition->clearData();
            $this->Session->setFlash(__('Data Save Sucess'));
            $this->redirect(array('controller' => 'materialapprovals',
                                        'action' => 'approval_list', 
                                        $this->request->data['Mtrlapprovdoc']['contract_code']));
        }else{
            $this->Session->setFlash(__('Data Save Failed'));
            $this->redirect(array('controller' => 'materialapprovals',
                                        'action' => 'approval_list', 
                                        $this->request->data['Mtrlapprovdoc']['contract_code']));
        }

    }
*/

    /*
    public function add($param=null) {
        ////
        //良くわからないので、パラメータがない場合のエラー処理を入れてみた。
        if (!$param) {
            throw new NotFoundException(__('No parameter is given'));
        }

        $approv_type = substr($param, 0, 6);
        if ($approv_type == 'propos') { 
            $type = 'proposal';
        }elseif ($approv_type == 'review') { 
            $type = 'review';
        }elseif ($approv_type == 'approv') { 
            $type = 'approval';
        }
        $this->set('approv_type', $type);

        $materialapproval_id = substr($param, 6);
        $materialapproval = $this->Materialapproval->findById($materialapproval_id);
        $this->set('materialapproval',$materialapproval);

        if ($this->request->is('post')) {

            $this->Mtrlapprovdoc->create();
            if ($this->Mtrlapprovdoc->save($this->request->data)) {
                $this->Session->setFlash(__('Material Approval Data Added'));
                return $this->redirect(array('controller' => 'materialapprovals',
                                            'action' => 'approval_list', 
                                            $this->request->data['Mtrlapprovdoc']['contract_code']));
            }
            $this->Session->setFlash(__('Failed to Add Data'));
            return $this->redirect(array('controller' => 'materialapprovals',
                                        'action' => 'approval_list', 
                                        $this->request->data['Mtrlapprovdoc']['contract_code']));
        }
    }*/


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


