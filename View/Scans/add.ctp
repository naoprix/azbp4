<!-- File: /app/View/Scans/add.ctp -->

<h1>Add File</h1>

<?php //// 以下はサンプルソースからコピー////; ?>

<?php 

	//pr($correspondence_id);
	//pr($correspondence);

	echo $this->Form->create(
		null,
		array('url' => array('action' => 'add', $correspondence_id), 'type'=>'file')); 

	echo $this->Form->input(
		'file',
		array('type' => 'file', 'label' => 'File Upload'));

	echo $this->Form->input(
		'corres_id',
		array('type' => 'hidden', 'value' => $correspondence_id));


	//echo $this->Form->submit('Upload');
	echo $this->Form->end('Upload');

?>

