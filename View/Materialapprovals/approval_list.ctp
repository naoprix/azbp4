<!-- File: /app/View/Materialapprovals/approval_list.ctp -->

<h1><?php echo ($this->element('menu')); ?> </h1>


<h2><?php echo 'Package ',$contract['0']['Contract']['code']; ?>
    <?php echo ' : ',$contract['0']['Contract']['contract_name']; ?></h2>
<h2>Material Approval List</h2>
<p><?php echo 'Engineer: Tokyo Engineering Consultants, Co., Ltd.'; ?></p>
<p><?php echo 'Contractor: ',$contract['0']['Contract']['contractor']; ?></p>


<p><?php if (AuthComponent::user('role')=='admin') {
            echo $this->Html->link('Add Material Approval Data', 
                      array('action' => 'add', $contract['0']['Contract']['code'])); } 
    ?></p>
    
<table>
    <tr>
        <th>Item</th>
        <th>Contracot's Proposal</th>
        <th>Employer's Review</th>
        <th>Engineer's Approval</th>
        <th>Status</th>
    </tr>

    <?php pr($materialapproval); ?>

    <?php foreach ($materialapproval as $data): ?>

    <tr>
        <td>
            <?php echo $data['Materialapproval']['item']; ?>
        </td>
        
        <td>
            <?php foreach ($data['Mtrlapprovdoc'] as $document): ?>
                <?php if ($document['type'] == 'proposal'): ?>
                    <?php echo $document['status']; ?><br>
                    <?php if ($document['image']) {
                            echo $this->Html->link($document['image'],
                                            array('controller' => 'Mtrlapprovdocs',
                                                'action' => 'view',
                                                $document['image'])); } ?><br>
                <?php endif; ?>
            <?php endforeach; ?>
        </td>

        <td>
            <?php foreach ($data['Mtrlapprovdoc'] as $document): ?>
                <?php if ($document['type'] == 'review'): ?>
                    <?php echo $document['status']; ?><br>
                    <?php if ($document['image']) {
                            echo $this->Html->link($document['image'],
                                            array('controller' => 'Mtrlapprovdocs',
                                                'action' => 'view',
                                                $document['image'])); } ?><br>
                <?php endif; ?>
            <?php endforeach; ?>
        </td>

        <td>
            <?php foreach ($data['Mtrlapprovdoc'] as $document): ?>
                <?php if ($document['type'] == 'approval'): ?>
                    <?php echo $document['status']; ?><br>
                    <?php if ($document['image']) {
                            echo $this->Html->link($document['image'],
                                            array('controller' => 'Mtrlapprovdocs',
                                                'action' => 'view',
                                                $document['image'])); } ?><br>
                <?php endif; ?>
            <?php endforeach; ?>

            <?php if (AuthComponent::user('role')=='admin'): ?>

                <?php echo $this->Html->link('Add', 
                                array('controller' => 'Mtrlapprovdocs', 
                                    'action' => 'add', 
                                    $data['Materialapproval']['id'])); ?>

<!--                 <?php echo $this->Html->link('Add', 
                                array('controller' => 'Materialapprovals', 
                                    'action' => 'add', 
                                    'approv'.$data['Materialapproval']['id'])); ?>
 -->

            <?php endif; ?>
        </td>
    </tr>

    <?php endforeach; ?>

</table>


