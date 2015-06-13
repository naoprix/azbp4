<!-- File: /app/View/Correspondences/add.ctp -->

<div>

<h1>Add Correpondences Data</h1>

<?php

$entity = array('TEC'=>'TEC',
				'Contractor' => 'Contractor',
				'Azersu' => 'Azersu',
				'JICA' => 'JICA',
				'Other' => 'Other');
//pr($correspondence);
$letters = array();//セレクタ用の連想配列を宣言しました。
foreach ($correspondence as $data) {
	$letter = $data['Correspondence']['ref_no'].' ('.$data['Correspondence']['date'].')';
	$letters[$letter] = $letter;//ラベルと値が同じ連想配列を生成しています。
}

echo 'Contract Package : '.$contract_code;

echo $this->Form->create('Correspondence', array('action' => 'add'));
echo $this->Form->input('id', array('type'=> 'hidden'));
echo $this->Form->input('contract_code', array('value' => $contract_code, 'type' => 'hidden'));
echo $this->Form->label('from', 'FROM');
echo $this->Form->select('from', $entity);
echo $this->Form->label('to', 'TO');
echo $this->Form->select('to',  $entity);
echo $this->Form->input('ref_no', array('rows' => '1'));
echo $this->Form->label('date', 'Date (YYYY-MM-DD)');
echo $this->Form->input('date', array('dateformat' => 'YYYY-MM-DD'));
echo $this->Form->input('subject', array('rows' => '1'));
//echo $this->Form->input('language', array('rows' => '1'));
echo $this->Form->label('reply_to', 'Reply To (Letter No.)');
echo $this->Form->select('reply_to', $letters);
//echo $this->Form->input('letter', array('type' => 'file'));

echo $this->Form->end('Add Data');
?>

</div>


