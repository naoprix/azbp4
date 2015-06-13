<!-- File: /app/View/Contracts/upload.ctp -->

<h1>Upload File</h1>

<?php

echo $this->Form->create(null, array('type' => 'file'));
echo $this->Form->input('file', 
					array('type'=> 'file', 'label' => 'FILE'));

echo $this->Form->submit('Upload File');
echo $this->Form->end();

?>




