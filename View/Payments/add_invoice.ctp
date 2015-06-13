<!-- File: /app/View/Payments/add_invoice.ctp -->

<h1>Add Invoice Data</h1>

<?php

//pr($contract);

$code = $contract['Contract']['code'];
$contract_name = $contract['Contract']['contract_name'];
$contractor = $contract['Contract']['contractor'];
$date_commencemnet = $contract['Contract']['date_commencement'];

echo 'Package', $code;
echo 'Contract', $contract_name;

echo $this->Form->create('Payment');
echo $this->Form->input('id', array('type'=> 'hidden'));
echo $this->Form->input('code', array('value' => $code,'type' => 'hidden'));
echo $this->Form->input('invoice_no', array('rows' => '1'));
echo $this->Form->input('date', array('rows' => '1'));
echo $this->Form->input('bill01', array('rows' => '1'));
echo $this->Form->input('bill02', array('rows' => '1'));
echo $this->Form->input('bill03', array('rows' => '1'));
echo $this->Form->input('bill04', array('rows' => '1'));
echo $this->Form->input('bill05', array('rows' => '1'));
echo $this->Form->input('bill06', array('rows' => '1'));
echo $this->Form->input('bill07', array('rows' => '1'));
echo $this->Form->input('bill08', array('rows' => '1'));
echo $this->Form->input('bill09', array('rows' => '1'));
echo $this->Form->input('bill10', array('rows' => '1'));
echo $this->Form->input('daywork', array('rows' => '1'));
echo $this->Form->input('p-sum', array('rows' => '1'));
echo $this->Form->input('retention', array('rows' => '1'));
echo $this->Form->input('release_ret', array('rows' => '1'));
echo $this->Form->input('advance', array('rows' => '1'));
echo $this->Form->input('repay-adv', array('rows' => '1'));

echo $this->Form->end('Add Data');
?>




