<!-- File: /app/View/Correspondences/corres_list.ctp -->


<body>
<div id="sidebar">
    <?php echo ($this->element('menu')); ?>
</div>

<div id='main'>
<h2><?php echo 'Package ',$contract['0']['Contract']['code']; ?>
    <?php echo ' : ',$contract['0']['Contract']['contract_name']; ?></h2>
<h2>Correspondences</h2>
<p><?php echo 'Engineer: Tokyo Engineering Consultants, Co., Ltd.'; ?></p>
<p><?php echo 'Contractor: ',$contract['0']['Contract']['contractor']; ?></p>

<p><?php if (AuthComponent::user('role')=='admin') {
            echo $this->Html->link('Add Correspondence Data', 
                      array('action' => 'add', $contract['0']['Contract']['code'])); } 
    ?></p>
<p><?php
        echo $this->Paginator->first('<<<  ', $options = array());
        echo $this->Paginator->prev('< Previous  ', array(), null, array('class' => 'prev disabled'));
        echo $this->Paginator->numbers(array('separator' => '|'));
        echo $this->Paginator->next('  Next >', array(), null, array('class' => 'next disabled'));
        echo $this->Paginator->last('  >>>', $options = array());
    ?></p>
<table>
    <tr>
        <th>From</th>
        <th>Ref. No.</th>
        <th>Date</th>
        <th>Subject</th>
        <th>Replied To</th>
        <th>PDF Files</th>
    </tr>

    <?php //pr($correspondence); ?>

    <?php foreach ($correspondence as $data): ?>

    <tr>
        <td><?php echo $data['Correspondence']['from']; ?></td>
        <td><?php echo $data['Correspondence']['ref_no']; ?></td>
        <td><?php echo $data['Correspondence']['date']; ?></td>
        <td><?php echo $data['Correspondence']['subject']; ?></td>
        <td><?php echo $data['Correspondence']['reply_to']; ?></td>
        <td><?php foreach ($data['Scan'] as $scan): ?>
            <?php //ファイルをダウンロードする場合のコードです。
                /*echo $this->Html->link($scan['filename'],
                        array('controller' => 'Scans', 
                            'action' => 'download', 
                            $scan['filename']));*/ ?>
            <?php echo $this->Html->link($scan['filename'],
                        array('controller' => 'Scans', 
                            'action' => 'view', 
                            $scan['filename'])); ?><br>
            <?php //正しいやり方は、linkメソッドで、webroot直下のファイルを表示させることらしい。
                  //これをやると、URLがhome/users/0/soie-whitesnow.jp/,,,みたいになってしまう。
                    /*echo $this->Html->link($scan['filename'],
                        APP.'tmp/'.$scan['filename']);*/ ?>



            <?php endforeach; ?></td>

            <?php if (AuthComponent::user('role')=='admin'): ?>
                <td><?php echo $this->Html->link('Add File', 
                                array('controller' => 'Scans', 
                                    'action' => 'add', 
                                    $data['Correspondence']['id'])); ?><br>
                    <?php echo $this->Html->link('Edit', 
                                array('controller' => 'Correspondences',
                                    'action' => 'edit',
                                    $data['Correspondence']['id'])); ?></td>
            <?php endif; ?>
    </tr>

    <?php endforeach; ?>

</table>
<p><?php
        echo $this->Paginator->first('<<<  ', $options = array());
        echo $this->Paginator->prev('< Previous  ', array(), null, array('class' => 'prev disabled'));
        echo $this->Paginator->numbers(array('separator' => '|'));
        echo $this->Paginator->next('  Next >', array(), null, array('class' => 'next disabled'));
        echo $this->Paginator->last('  >>>', $options = array());
    ?></p>
</div>
</body>