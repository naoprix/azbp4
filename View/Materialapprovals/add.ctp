<!-- File: /app/View/Materialapprovals/add.ctp -->

<div>

<h1>Add Material Approval Data</h1>

<?php

//pr($materialapproval);

echo 'Contract Package : '.$contract_code;

echo $this->Form->create('Materialapproval', array('action' => 'add', 'type'=>'file'));
echo $this->Form->input('id', array('type'=> 'hidden'));
echo $this->Form->input('contract_code', array('value' => $contract_code, 'type' => 'hidden'));
echo $this->Form->input('item', array('rows' => '1'));
echo $this->Form->label('proposed_date', 'Date (YYYY-MM-DD)');
echo $this->Form->input('proposed_date', array('dateformat' => 'YY-MM-DD'));
echo $this->Form->select('proposed_status', array('proposal', 'clarification'));
echo $this->Form->label('review_date', 'Date (YYYY-MM-DD)');
echo $this->Form->input('review_date', array('dateformat' => 'YYYY-MM-DD'));
echo $this->Form->select('review_status', array('proposal', 'clarification'));
echo $this->Form->label('approved_date', 'Date (YYYY-MM-DD)');
echo $this->Form->input('approved_date', array('dateformat' => 'YYYY-MM-DD'));
echo $this->Form->select('approval_status', array('proposal', 'clarification'));

echo $this->Form->input('file', array('type'=>'file'));

echo $this->Form->end('Add Data');
?>

</div>