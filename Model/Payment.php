<?php
App::uses('AppModel','Model');
class Payment extends AppModel {

    public $validate = array(
        'contract_code' => array(
            'rule' => 'notEmpty',
            'message' => 'Input contract code'
        ),
        'invoice_no' => array(
            'rule' => 'notEmpty',
            'message' => 'Input invoice number'
        ),
        'date' => array(
            'rule' => array('date', 'ymd')
        )
    );

}

