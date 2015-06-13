<?php
App::uses('AppModel','Model');
class Correspondence extends AppModel {
    

    public $hasMany = array('Scan');


    public $validate = array(
        'contract_code' => array(
            'rule' => 'notEmpty',
            'message' => 'Input contract code'
        ),
        'from' => array(
            'rule' => 'notEmpty',
            'message' => 'Select entitity'
        ),
        'to' => array(
            'rule' => 'notEmpty',
            'message' => 'Select entitity'
        ),
        'date' => array(
            'rule' => array('date', 'ymd')
        )
    );


    public function beforeSave($options = array()){
        if(isset($this->data['Correspondence']['ref_no'])) {
            $this->data['Correspondence']['ref_no'] 
            = htmlspecialchars($this->data['Correspondence']['ref_no'],ENT_QUOTES);
        }
        if(isset($this->data['Correspondence']['subject'])){
            $this->data['Correspondence']['subject'] 
            = htmlspecialchars($this->data['Correspondence']['subject'],ENT_QUOTES);
        }
        return true;
    }


    ////
    //FileBinderを実装します。

    public $actAs = array('Filebinder.Bindable');

    public $bindFields = array(array('field' => 'letter'));

    /*public $validate = array('letter' => array('illegalCode' => array(
                                            'rule' => 'funcCheckFile', 'checkIllegalCode'),
                                            'allowEmpty' => true)
                            );*/

    ////
    //FileBinderのGitHubのサンプルコードより。不正なファイル名をチェックしているようだ。

    /**
    * checkIllegalCode
    * check include illegal code
    *
    * @param $filePath
    * @return
    */
    public function checkIllegalCode($filePath){
        $fp = fopen($filePath, "r");
        $ofile = fread($fp, filesize($filePath));
        fclose($fp);

        if (preg_match('/<\\?php./i', $ofile)) {
            return false;
        }
        return true;
    }


    //var $primarykey = 'contract_code';//これはfindByIdするときにちゃんとデータとれるか要注意。
    //public $belongsTo = array(
    //    'Contract'=>array(
    //        'className' => 'Contract',
    //        'foreignKey'=> 'code'
    //    )
    //);
    

}

