<!-- File: /app/View/Contracts/index.ctp -->

<h1><?php echo ($this->element('menu')); ?> </h1>

<p></p>
<h2>Contract List</h2>

<table>
    <tr>
        <th>Package</th>
        <th>Contract Name</th>
        <th>Contractor</th>
        <th>Date of Sign</th>
        <th>Commencement Date</th>
    </tr>

    <?php //pr($contract); ?>
    <?php pr($user); ?>

    <?php foreach ($contract as $data): ?>
    <?php if ($data['Contract']['vo_no']>0) { continue; } ?>
    <?php //pr($data); ?>
    <tr>
        <td><?php echo $this->Html->link(
                $data['Contract']['code'],
                array('action' => 'view',
                $data['Contract']['code'])); ?></td>
        <td><?php echo $data['Contract']['contract_name']; ?></td>
        <td><?php echo $data['Contract']['contractor']; ?></td>
        <td><?php echo $data['Contract']['date_sign']; ?></td>
        <td><?php echo $data['Contract']['date_commencement']; ?></td>
        <td><?php echo $this->Html->link('invoice', 
                array('controller' => 'Payments',
                    'action' => 'paylist', $data['Contract']['code'])); ?></td>
    </tr>
    <?php endforeach; ?>

</table>

<p></p>
<p><?php if (AuthComponent::user()) {
            echo $this->Html->link('Add Contract Data', array('action' => 'add')); } ?></p>
