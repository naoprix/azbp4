<!-- File: /app/View/Contracts/add.ctp -->

<h1>Add Variation Order Data</h1>

<?php

echo $this->Form->create('Contract');
echo $this->Form->input('id', array('type'=> 'hidden'));
echo $this->Form->input('code', array('rows' => '1'));
echo $this->Form->input('contract_name', array('rows' => '1'));
echo $this->Form->input('contractor', array('rows' => '1'));
echo $this->Form->input('vo_no', array('value' => '0', 'rows' => '1'));
echo $this->Form->input('date_sign', array('rows' => '1'));
echo $this->Form->input('date_commencement', array('rows' => '1'));
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
echo $this->Form->input('contingency', array('rows' => '1'));

echo $this->Form->end('Add Data');
?>




