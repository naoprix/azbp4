<!-- File: /app/View/Correspondences/edit.ctp -->

<h1>Edit Correspondence Data</h1>

<?php

//pr($correspondence);

////
//$this->Form->select('ラベル', $entity)と書くとセレクトできるよ。規定値をどう表現するのか不明。
$entity = array('TEC'=>'TEC',
				'Contractor' => 'Contractor',
				'Azersu' => 'Azersu',
				'JICA' => 'JICA',
				'Other' => 'Other');

$id = $correspondence['Correspondence']['id'];
$code = $correspondence['Correspondence']['contract_code'];
$from = $correspondence['Correspondence']['from'];
$to = $correspondence['Correspondence']['to'];
$ref_no = $correspondence['Correspondence']['ref_no'];
$date = $correspondence['Correspondence']['date'];
$subject = $correspondence['Correspondence']['subject'];
$reply_to = $correspondence['Correspondence']['reply_to'];

echo 'Package: ', $code;
echo 'Ref No: ', $ref_no;

echo $this->Form->create('Correspondence');//, array('action' => 'edit', $id));
echo $this->Form->input('id', array('value' => $id, 'type'=> 'hidden'));
echo $this->Form->input('code', array('value' => $code, 'type' => 'hidden'));
echo $this->Form->input('from', array('value' => $from));
echo $this->Form->input('to', array('value' => $to));
echo $this->Form->input('ref_no', array('value' => $ref_no, 'rows' => '1'));
echo $this->Form->input('date', array('value' => $date, 'rows' => '1'));
echo $this->Form->input('subject', array('value' => $subject, 'rows' => '1'));
echo $this->Form->input('reply_to', array('value' => $reply_to, 'rows' => '1'));
foreach ($correspondence['Scan'] as $scan) {
	echo 'Scanned File: '.$scan['filename'];
}

echo $this->Form->end('Update');

?>
