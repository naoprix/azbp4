<!-- File: /app/View/Documents/add.ctp -->

<h1>Add File</h1>

<?php //// 以下はサンプルソースからコピー////; ?>

<?php 

	//pr($contractdocument_id);
	//pr($contractdocument);

	echo $this->Form->create(
		null,
		array('url' => array('action' => 'add', $contractdocument_id), 'type'=>'file')); 

	echo $this->Form->input(
		'file',
		array('type' => 'file', 'label' => 'File Upload'));

	echo $this->Form->input(
		'doc_list_id',
		array('type' => 'hidden', 'value' => $contractdocument_id));


	//echo $this->Form->submit('Upload');
	echo $this->Form->end('Upload');

?>

