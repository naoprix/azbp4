<!-- File: /app/View/Mtrlapprovdocs/add.ctp -->

<h1>Add File</h1>

<?php ////    addがうまくいかない。　
		////　　フォーム入力した後に、azsujica/mtrlapprovdocs/addメソッドがないと言われる。////; ?>

<?php 
	////入力フォームのセレクタ用の配列を作成しています。
	//// 
	$status = array('Proposal' => 'Proposal', 
					'Review' => 'Review', 
					'Clarification' => 'Clarification',
					'Rejection' => 'Rejection',
					'Approval' => 'Approval'); 
/*
	$letters = array();
	$filename = $this->requestAction(array(
						'controller'=>'Correspondences', 
						'action'=>'letter_list', 
						$materialapproval['Materialapproval']['contract_code']
						)); 
	foreach ($filename as $data) {
			$letter = $data['Correspondence']['ref_no'].' ('.$data['Correspondence']['date'].')';
			$letters[$data['Correspondence']['id']] = $letter;//ラベルにリファレンスナンバー＋日付、値はコレポンテーブルのid
	}

	pr($approv_type);
*/
	//pr($materialapproval_id);
	pr($materialapproval);


echo $this->Form->create('Mtrlapprovdoc', array(
						'action' => 'add', 
						$materialapproval['Materialapproval']['id'],
						'type' => 'file'));
echo $this->Form->input('id', array('type'=> 'hidden'));
/*echo $this->Form->input('contract_code', array(
					'value' => $materialapproval['Materialapproval']['contract_code'], 
					'type' => 'hidden'));
これは入れようがないのです。
*/
echo $this->Form->input('materialapproval_id', array(
					'value' => $materialapproval['Materialapproval']['id'], 
					'type' => 'hidden'));
// echo $this->Form->input('type', array(
// 					'value' => $approv_type, 
// 					'type' => 'hidden'));
echo $this->Form->label('date', 'Date (YYYY-MM-DD)');
echo $this->Form->input('date', array('dateformat' => 'YYYY-MM-DD'));
echo $this->Form->label('status', 'Status');
echo $this->Form->select('status', $status);
echo $this->Form->label('letter', 'Letter');
echo $this->Form->input('letter', array('type'=>'file'));

echo $this->Form->submit('Add Data');
echo $this->Form->end();

?>