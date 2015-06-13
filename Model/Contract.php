<?php
App::uses('AppModel','Model');
class Contract extends AppModel {


    public $validate = array(
        'code' => array(
            'rule' => 'notEmpty',
            'message' => 'Input contract code'
        ),
        'contract_name' => array(
            'rule' => 'notEmpty',
            'message' => 'Input contract name'
        ),
        'contractor' => array(
            'rule' => 'notEmpty',
            'message' => 'Input name of the Contractor')

    );


    /*public $belongsTo = array(
        'User'=>array(
            'className' => 'User',
            'foreignKey'=> 'tecimember_staff_code'
        )
    );*/
    
    //public $hasMany = array(
    //    'Correspondence' => array(
    //        'className' => 'Correspondence',
    //        'foreignKey' => 'contract_code'));やっぱりうまくいかない。
    /*public $validate = array(
        'job_code' => array(
            'rule' => 'notEmpty',
            'message' => '件番を入力してください'
        )/*,
        'project_name' => array(
            'rule' => 'notEmpty',
            'message' => '件名を入力してください'
        )

    );*/
    //public $hasMany = array(
    //    'Payment' => array(
    //        'className' => 'Payment',
    //        'foreignKey' => 'code'));
}

