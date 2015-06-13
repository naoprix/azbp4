<?php
App::uses('AppModel','Model');
class Contractdocument extends AppModel {

    public $hasMany = array(
        'Document');


    public $validate = array(
        'contract_code' => array(
            'rule' => 'notEmpty',
            'message' => 'Input contract code'
        ),
        'date' => array(
            'rule' => array('date', 'ymd')
        ),
        'title' => array(
            'rule' => 'notEmpty',
            'message' => 'Input document title'
        )
    );


    public function beforeSave($options = array()){
        if(isset($this->data['Contractdocument']['ref_no'])) {
            $this->data['Contractdocument']['ref_no'] 
            = htmlspecialchars($this->data['Contractdocument']['ref_no'],ENT_QUOTES);
        }
        if(isset($this->data['Contractdocument']['title'])){
            $this->data['Contractdocument']['title'] 
            = htmlspecialchars($this->data['Contractdocument']['title'],ENT_QUOTES);
        }
        return true;
    }
    
    ////
    //FileBinderを実装します。
/*
    public $actAs = array('Filebinder.Bindable');

    public $bindFields = array(array('field' => 'letter'));
*/
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

