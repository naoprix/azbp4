<?php
App::uses('AppModel','Model');
class Mtrlapprovdoc extends AppModel {

    public $belongsTo = array('Materialapproval');

    ////
    //FileBinderを実装します。

    public $actsAs = array('Filebinder.Bindable');

    //HPのサンプルコードでは'username'を指定しているが何のことかわからない。
    // public $displayField = '';

    //バーチャルフィールドの指定
    public $bindFields = array(array(
    						'field' => 'letter'
    						));


    public $validate = array(
    		    	'letter' => array(
            			// 'filesize' => array(			//ここなんて書けばいいんだろ？？？？？
            			// 		'rule' => array(
            			// 				'checkContentType', array(
            			// 					'image/jpeg', 'image/gif', 'image/png', 'application/pdf', 'application/msword')),
            			// 		'message' => 'Error. Invalid File Type'),
		            	'fileSize' => array(
		           				'rule' => array('checkFileSize', '20MB'),
		           				'message' => 'Error. Maximum file size is 20MB'),
		            	'fileExt' => array(
		           				'fule' => array('checkExtension', array('jpg', 'gif', 'png', 'pdf')),
		           				'message' => 'Invalid file type'),
		            	'illegalCode' => array(
		            			'rule' => 'funcCheckFile', 'checkIllegalCode'), 
		            			'allowEmpty' => true)
         			)
			    );

    ////
    //FileBinderのGitHubのサンプルコードより。不正なファイルをチェックしているようだ。

    public function checkIllegalCode($filePath){
        $fp = fopen($filePath, "r");
        $ofile = fread($fp, filesize($filePath));
        fclose($fp);

        if (preg_match('/<\\?php./i', $ofile)) {
            return false;
        }
        return true;
    }
}