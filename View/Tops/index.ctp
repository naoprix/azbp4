<!-- File: /app/View/Tops/index.ctp -->

<h1><?php echo ($this->element('menu')); ?> </h1>

<p></p>
<h2>JICA Project (AZBP4)</h2>

<table>
    <tr>
        <th>Package</th>
        <th>Contract Name</th>
        <th>Contractor</th>
    </tr>

    <?php foreach ($contract as $data): ?>
        <?php if($data['Contract']['code'] == 'CS') {
            if (Authcomponent::user('tec') !='tec'){
                continue;
            }
        } ?>
        <tr>
            <td><?php echo $data['Contract']['code']; ?></td>
            <td><?php echo $data['Contract']['contract_name']; ?></td>
            <td><?php echo $data['Contract']['contractor']; ?></td>
        </tr>
    <?php endforeach; ?>

</table>

<p></p>
<p><?php if (AuthComponent::user('role')=='admin') {
            echo $this->Html->link('Add Contract Data', array('controller' => 'contracts', 'action' => 'add')); } ?></p>
