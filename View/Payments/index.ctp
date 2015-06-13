<!-- File: /app/View/Payments/index.ctp -->

<h1><?php echo ($this->element('menu')); ?> </h1>

<h2>Payment Record</h2>

<?php //pr($contract); ?>

<table>
    <tr>
        <th>Contract Code</th>
        <th>Contract Name</th>
        <th>Contractor</th>
        <th>Date of Sign</th>
        <th>Commencement Date</th>
    </tr>

    <?php foreach ($contract as $data): ?>
    <?php if ($data['Contract']['vo_no']>0){ continue; } ?>
    <tr>
        <td><?php echo $this->Html->link(
                $data['Contract']['code'],
                array('action' => 'paylist',
                $data['Contract']['code'])); ?></td>
        <td><?php echo $data['Contract']['contract_name']; ?></td>
        <td><?php echo $data['Contract']['contractor']; ?></td>
        <td><?php echo $data['Contract']['date_sign']; ?></td>
        <td><?php echo $data['Contract']['date_commencement']; ?></td>
    </tr>
    <?php endforeach; ?>

</table>

