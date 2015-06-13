<?php
App::uses('AppModel','Model');
class Scan extends AppModel {
    public $belongsTo = array(
        'Correspondence');

    /*public $bindFields = array(
        array('field'=>'filename')
    );*/
}

