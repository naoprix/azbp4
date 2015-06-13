<!-- File: /app/View/Contractdocuments/edit.ctp -->

<h1>Edit Contract Document Data</h1>

<?php

//pr($contractdocument);

$id = $contractdocument['Contractdocument']['id'];
$code = $contractdocument['Contractdocument']['contract_code'];
//$from = $contractdocument['Contractdocument']['from'];
//$to = $contractdocument['Contractdocument']['to'];
$ref_no = $contractdocument['Contractdocument']['ref_no'];
$date = $contractdocument['Contractdocument']['date'];
$title = $contractdocument['Contractdocument']['title'];
$language = $contractdocument['Contractdocument']['language'];

echo 'Package: ', $code;
echo 'Ref No: ', $ref_no;

echo $this->Form->create('Contractdocument');//, array('action' => 'edit', $id));
echo $this->Form->input('id', array('value' => $id, 'type'=> 'hidden'));
echo $this->Form->input('code', array('value' => $code, 'type' => 'hidden'));
//echo $this->Form->input('from', array('value' => $from));
//echo $this->Form->input('to', array('value' => $to));
echo $this->Form->input('title', array('value' => $title, 'rows' => '1'));
echo $this->Form->input('ref_no', array('value' => $ref_no, 'rows' => '1'));
echo $this->Form->input('date', array('value' => $date, 'rows' => '1'));
echo $this->Form->select('language', array('English', 'Azerbaijani'));
foreach ($contractdocument['Document'] as $document) {
	echo 'Scanned Document: '.$document['filename'];
}

echo $this->Form->end('Update');

?>
