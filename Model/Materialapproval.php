<?php
App::uses('AppModel','Model');
class Materialapproval extends AppModel {
    
    ////
    //FileBinderを実装します。

    public $actAs = array('Filebinder.Bindable');

    //HPのサンプルコードでは'username'を指定しているが何のことかわからない。
    // public $displayField = '';

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
    
    public $hasMany = array(
        'Mtrlapprovdoc');// => array(
    //        'className' => 'Payment',
    //        'foreignKey' => 'code'));
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
}

