<?php
App::uses('AppModel','Model');
class Document extends AppModel {
    public $belongsTo = array(
        'Contractdocument');

    /*public $bindFields = array(
        array('field'=>'filename')
    );*/
}

