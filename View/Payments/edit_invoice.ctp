<!-- File: /app/View/Payments/edit_invoice.ctp -->

<h1>Edit Invoice Data</h1>

<?php

echo 'Package: ', $payment['Payment']['code'];

echo $this->Form->create('Payment');
//echo $this->Form->input('id', array('value' => $payment['Payment']['id'], 'type'=> 'hidden'));
echo $this->Form->input('id', array('type'=> 'hidden'));
echo $this->Form->input('code', array('value' => $payment['Payment']['code'], 'type' => 'hidden'));
echo $this->Form->input('invoice_no', array('value' => $payment['Payment']['invoice_no'], 'rows' => '1'));
echo $this->Form->input('date', array('value' => $payment['Payment']['date'], 'rows' => '1'));
echo $this->Form->input('bill01', array('value' => $payment['Payment']['bill01'], 'rows' => '1'));
echo $this->Form->input('bill02', array('value' => $payment['Payment']['bill02'],'rows' => '1'));
echo $this->Form->input('bill03', array('value' => $payment['Payment']['bill03'], 'rows' => '1'));
echo $this->Form->input('bill04', array('value' => $payment['Payment']['bill04'],'rows' => '1'));
echo $this->Form->input('bill05', array('value' => $payment['Payment']['bill05'],'rows' => '1'));
echo $this->Form->input('bill06', array('value' => $payment['Payment']['bill06'],'rows' => '1'));
echo $this->Form->input('bill07', array('value' => $payment['Payment']['bill07'],'rows' => '1'));
echo $this->Form->input('bill08', array('value' => $payment['Payment']['bill08'],'rows' => '1'));
echo $this->Form->input('bill09', array('value' => $payment['Payment']['bill09'],'rows' => '1'));
echo $this->Form->input('bill10', array('value' => $payment['Payment']['bill10'],'rows' => '1'));
echo $this->Form->input('daywork', array('value' => $payment['Payment']['daywork'],'rows' => '1'));
echo $this->Form->input('p-sum', array('value' => $payment['Payment']['p-sum'],'rows' => '1'));
echo $this->Form->input('retention', array('value' => $payment['Payment']['retention'],'rows' => '1'));
echo $this->Form->input('release_ret', array('value' => $payment['Payment']['release_ret'],'rows' => '1'));
echo $this->Form->input('advance', array('value' => $payment['Payment']['advance'],'rows' => '1'));
echo $this->Form->input('repay-adv', array('value' => $payment['Payment']['repay-adv'],'rows' => '1'));
echo $this->Form->end('Update');
?>
