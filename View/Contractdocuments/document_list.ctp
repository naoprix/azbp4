<!-- File: /app/View/Contractdocuments/document_list.ctp -->

<h1><?php echo ($this->element('menu')); ?> </h1>


<h2><?php echo 'Package ',$contract['0']['Contract']['code']; ?>
    <?php echo ' : ',$contract['0']['Contract']['contract_name']; ?></h2>
<h2>Contract Documents</h2>
<p><?php echo 'Engineer: Tokyo Engineering Consultants, Co., Ltd.'; ?></p>
<p><?php echo 'Contractor: ',$contract['0']['Contract']['contractor']; ?></p>


<p><?php if (AuthComponent::user('role')=='admin') {
            echo $this->Html->link('Add Contractdocument Data', 
                      array('action' => 'add', $contract['0']['Contract']['code'])); } 
    ?></p>
    
<table>
    <tr>
        <th>Title</th>
        <th>Ref. No.</th>
        <th>Date</th>
        <th>Language</th>
        <th>PDF Files</th>
    </tr>

    <?php //pr($contractdocument); ?>

    <?php foreach ($contractdocument as $data): ?>

    <tr>
        <td><?php echo $data['Contractdocument']['title']; ?></td>
        <td><?php echo $data['Contractdocument']['ref_no']; ?></td>
        <td><?php echo $data['Contractdocument']['date']; ?></td>
        <td><?php echo $data['Contractdocument']['language']; ?></td>
        <td><?php foreach ($data['Document'] as $document): ?>
            <?php echo $this->Html->link($document['filename'],
                        array('controller' => 'Documents', 
                            'action' => 'view', 
                            $document['filename'])); ?><br>
            <?php endforeach; ?></td>
            <?php if (AuthComponent::user('role')=='admin'): ?>
                <td><?php echo $this->Html->link('Add File', 
                                array('controller' => 'Documents', 
                                    'action' => 'add', 
                                    $data['Contractdocument']['id'])); ?><br>
                    <?php echo $this->Html->link('Edit', 
                                array('controller' => 'Contractdocuments',
                                    'action' => 'edit',
                                    $data['Contractdocument']['id'])); ?></td>
            <?php endif; ?>
    </tr>

    <?php endforeach; ?>

</table>


