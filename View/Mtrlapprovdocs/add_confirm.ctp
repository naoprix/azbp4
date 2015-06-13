<!-- File: /app/View/Mtrlapprovdocs/add_confirm.ctp -->

<?php 

echo h($mergeData['Mtrlapprovdoc']['type']);
echo h($mergeData['Mtrlapprovdoc']['date']);
echo h($mergeData['Mtrlapprovdoc']['status']);

echo $this->Form->create('Mtrlapprovdoc', array(
						'action' => 'add_confirm'));
echo $echo $this->Form->input('dummy', 'type' => 'hidden');

echo $this->Form->submit('Add Data');
echo $this->Form->end();

?>