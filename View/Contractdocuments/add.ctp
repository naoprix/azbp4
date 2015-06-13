<!-- File: /app/View/Contractdocuments/add.ctp -->

<div>

<h1>Add Contract Document Data</h1>

<?php

//pr($contractdocument);

echo 'Contract Package : '.$contract_code;

echo $this->Form->create('Contractdocument', array('action' => 'add'));
echo $this->Form->input('id', array('type'=> 'hidden'));
echo $this->Form->input('contract_code', array('value' => $contract_code, 'type' => 'hidden'));
echo $this->Form->input('title', array('rows' => '1'));
echo $this->Form->input('ref_no', array('rows' => '1'));
echo $this->Form->label('date', 'Date (YYYY-MM-DD)');
echo $this->Form->input('date', array('dateformat' => 'YYYY-MM-DD'));
echo $this->Form->select('language', array('English', 'Azerbaijani'));

echo $this->Form->end('Add Data');
?>

</div>


