<?php
////
//Topsコントローラ

class TopsController extends AppController {//クラス名はテーブル名と整合をとること。
    
    public $helpers = array('Html', 'Form', 'Session');
    public $uses = array('Contract', 'Payment', 'User', 'Correspondence');


    public function index() {
        $contract = $this->Contract->find('all', 
        					array('conditions' => array('vo_no' => '0'),
        						'order' => array('code' => 'asc')));
        $this->set('contract',$contract);
    }

}
