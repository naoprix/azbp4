<?php
//Paymentsコントローラ

//App::uses('CutoffDate', 'Lib');//締日の計算クラスのはず
//App::uses('FileSaver', 'Lib');//ファイルを書き出すクラスだったような。

class PaymentsController extends AppController {//クラス名はテーブル名と整合をとること。
    
    public $helpers = array('Html', 'Form', 'Session');
    public $uses = array('Payment', 'Contract', 'User');


    public function index() {
        $contract = $this->Contract->find('all', array('order' => array('code' => 'asc', 'vo_no'=> 'asc')));
        $this->set('contract',$contract);
    }


    public function paylist($code) {
        if (!$code) {
            throw new NotFoundException(__('Invalid Access'));
        }

        $contract = $this->Contract->find('all', 
                    array('conditions' => array('Contract.code'=>$code),
                        'order'=> array('code'=>'asc')));
        $payment = $this->Payment->find('all', 
                    array('conditions' => array('Payment.code'=>$code),
                        'order' => array('invoice_no'=>'asc')));

        $this->set('contract', $contract);
        $this->set('payment', $payment);
    }


    public function add_invoice($code) {
        $contract = $this->Contract->find('first', 
                    array('conditions' => array('Contract.code' =>$code)) );
        $this->set('contract', $contract);
        if ($this->request->is('post')) {
            $this->Payment->create();
            if ($this->Payment->save($this->request->data)) {
                $this->Session->setFlash(__('Invoice Data Added'));
                return $this->redirect(array('controller'=>'Payments', 'action' => 'paylist', $contract['Contract']['code']));
            }
            $this->Session->setFlash(__('Failed to add Invoice Data'));
        }
    }


    public function edit_invoice($id = null) {
        if (!$id) {
            throw new NotFoundException(__('No parameter is given'));
        }
 
        $payment = $this->Payment->findById($id);
        $this->set('payment', $payment);

        if (!$payment) {
            throw new NotFoundException(__('不正な入力です'));
        }
        
        if ($this->request->is(array('post', 'put'))) {
            $this->Payment->id = $id;
            if ($this->Payment->save($this->request->data)) {
                $this->Session->setFlash(__('Invoice Data Updated'));
                return $this->redirect(array('controller'=>'Payments', 'action' => 'paylist', $payment['Payment']['code']));
            }
            $this->Session->setFlash(__('Failed to update Invoice Data'));
        }

        if (!$this->request->data){
            $this->request->data = $payment;
        }
    }


    public function view($id) {
        if (!$id) {
            throw new NotFoundException(__('Invalid Access'));
        }

        $invoice = $this->Payment->findById($id);
        $paid = $this->Payment->find('all',
                    array('conditions' => array('and' => 
                        array('Payment.code' => $invoice['Payment']['code'],
                                'Payment.date <' => $invoice['Payment']['date']))));
        $contract = $this->Contract->find('all', 
                    array('conditions' => array('and' =>
                        array('Contract.code'=>$invoice['Payment']['code'],
                                'Contract.date_sign <=' => $invoice['Payment']['date'])),
                    array('order' => array('vo_no' => 'desc'))));//ここの並べ替えが利かない。

        $this->set('invoice', $invoice);
        $this->set('paid', $paid);
        $this->set('contract', $contract);
    }

}


