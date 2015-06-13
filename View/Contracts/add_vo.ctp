<!-- File: /app/View/Contracts/add.ctp -->

<h1>Add Variation Order Data</h1>

<?php

//pr($contract);

$code = $contract['Contract']['code'];
$contract_name = $contract['Contract']['contract_name'];
$contractor = $contract['Contract']['contractor'];
$date_commencemnet = $contract['Contract']['date_commencement'];

echo 'Package', $code;
echo 'Contract', $contract_name;

echo $this->Form->create('Contract');
echo $this->Form->input('id', array('type'=> 'hidden'));
echo $this->Form->input('code', array('value' => $code,'type' => 'hidden'));
echo $this->Form->input('contract_name', array('value' => $contract_name,'type' => 'hidden'));
echo $this->Form->input('contractor', array('value' => $contractor, 'type' => 'hidden'));
echo $this->Form->input('vo_no', array('rows' => '1'));
echo $this->Form->input('date_sign', array('rows' => '1'));
echo $this->Form->input('date_commencement', array('value' => $date_commencemnet, 'type' => 'hidden'));
echo $this->Form->input('bill01', array('value' => $contract['Contract']['bill01'], 'rows' => '1'));
echo $this->Form->input('bill02', array('value' => $contract['Contract']['bill02'], 'rows' => '1'));
echo $this->Form->input('bill03', array('value' => $contract['Contract']['bill03'], 'rows' => '1'));
echo $this->Form->input('bill04', array('value' => $contract['Contract']['bill04'], 'rows' => '1'));
echo $this->Form->input('bill05', array('value' => $contract['Contract']['bill05'], 'rows' => '1'));
echo $this->Form->input('bill06', array('value' => $contract['Contract']['bill06'], 'rows' => '1'));
echo $this->Form->input('bill07', array('value' => $contract['Contract']['bill07'], 'rows' => '1'));
echo $this->Form->input('bill08', array('value' => $contract['Contract']['bill08'], 'rows' => '1'));
echo $this->Form->input('bill09', array('value' => $contract['Contract']['bill09'], 'rows' => '1'));
echo $this->Form->input('bill10', array('value' => $contract['Contract']['bill10'], 'rows' => '1'));
echo $this->Form->input('daywork', array('value' => $contract['Contract']['daywork'], 'rows' => '1'));
echo $this->Form->input('p-sum', array('value' => $contract['Contract']['p-sum'], 'rows' => '1'));
echo $this->Form->input('contingency', array('value' => $contract['Contract']['contingency'], 'rows' => '1'));

echo $this->Form->end('Add Data');
?>




