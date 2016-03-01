<?php
App::uses('AppModel','Model');
class Materialapproval extends AppModel {
    
    public $hasMany = array(
        'Mtrlapprovdoc');

}

