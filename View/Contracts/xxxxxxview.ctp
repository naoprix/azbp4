<!-- File: /app/View/Contracts/view.ctp -->

<h1><?php //echo ($this->element('menu')); ?> </h1>

<!--
<h2><?php //echo 'Contract No.: ',$contract['Contract']['code']; ?></h2>
<h2><?php //echo 'Title: ',$contract['Contract']['contract_name']; ?></h2>
<h2><?php //echo 'Contractor: ',$contract['Contract']['contractor'];?></h2>
<h2><?php //echo 'Date of Contract Signing: ',$contract['Contract']['date_sign'];?></h2>
<h2><?php //echo 'Date of Commencement: ',$contract['Contract']['date_commencement'];?></h2>

<p><?php //echo $this->Html->link('Add Teciprojectlist', array('action' => 'add')); ?></p>
<p><?php //echo $this->Html->link('Upload File', array('action' => 'upload')); ?></p>
-->
<p><?php pr($contract); ?></p>

<table>
    <tr>
        <th>Variation Order</th>
        <th>Bill No.1</th>
        <th>Bill No.2</th>
        <th>Bill No.3</th>
        <th>Bill No.4</th>
        <th>Bill No.5</th>
        <th>Bill No.6</th>
        <th>Bill No.7</th>
        <th>Bill No.8</th>
        <th>Bill No.9</th>
        <th>Bill No.10</th>
        <th>Day Work</th>
        <th>Provisional Sum</th>
        <th>Contingency</th>
    </tr>
<!--
<?php //pr($month_list);//Fetchデータを配列で取得 ?>

    
    <?php pr($project_list);//この変数がキーになるようだ。内容がよくわからない。 ?>

    <?php //echo count($contract); ?>
    <!--<?php for ($i = 0; 4; $i++): ?>
        <?php echo 'number',$i; ?>
    <!--
    <?php foreach ($contract as $value): ?>
        <?php $total_bill = $value[$i]['Contract']['bill01']
                          + $value[$i]['Contract']['bill02']
                          + $value[$i]['Contract']['bill03']
                          + $value[$i]['Contract']['bill04']
                          + $value[$i]['Contract']['bill05']
                          + $value[$i]['Contract']['bill06']
                          + $value[$i]['Contract']['bill07']
                          + $value[$i]['Contract']['bill08']
                          + $value[$i]['Contract']['bill09']
                          + $value[$i]['Contract']['bill10'];
              $total_bill_psum = $total_bill 
                               + $value[$i]['Contract']['daywork']
                               + $value[$i]['Contract']['p-sum'];
              $total_price = $total_bill_psum + $contingency;
              $vat = round($total_price*0.18,2);
              $contract_amount = $total_price + $vat; ?>
    <tr>
        <td>
        <?php echo $this->Html->link(
            $value[$i]['Contract']['vo_no'], 
                array('action' => 'view', 
                    $value[$i]['Contract']['vo_no'])); ?>
        </td>
        <td style="text-align: right"><?php echo $value[$i]['Contract']['bill01']; ?></td>
        <td style="text-align: right"><?php echo $value[$i]['Contract']['bill02']; ?></td>
        <td style="text-align: right"><?php echo $value[$i]['Contract']['bill03']; ?></td>
        <td style="text-align: right"><?php echo $value[$i]['Contract']['bill04']; ?></td>
        <td style="text-align: right"><?php echo $value[$i]['Contract']['bill05']; ?></td>
        <td style="text-align: right"><?php echo $value[$i]['Contract']['bill06']; ?></td>
        <td style="text-align: right"><?php echo $value[$i]['Contract']['bill07']; ?></td>
        <td style="text-align: right"><?php echo $value[$i]['Contract']['bill08']; ?></td>
        <td style="text-align: right"><?php echo $value[$i]['Contract']['bill09']; ?></td>
        <td style="text-align: right"><?php echo $value[$i]['Contract']['bill10']; ?></td>
        <td style="text-align: right"><?php echo $total_bill; ?></td>
        <td style="text-align: right"><?php echo $value[$i]['Contract']['daywork']; ?></td>
        <td style="text-align: right"><?php echo $value[$i]['Contract']['p-sum']; ?></td>
        <td style="text-align: right"><?php echo $total_bill_psum; ?></td>
        <td style="text-align: right"><?php echo $value[$i]['Contract']['contingency']; ?></td>
        <td style="text-align: right"><?php echo $total_price; ?></td>
        <td style="text-align: right"><?php echo $contract_amount; ?></td>

        <td><?php echo $this->Html->link('編集', array('action' => 'edit', $id)); ?></td> 
    </tr>
    <?php endforeach; ?>
    <?php endfor; ?>-->

</table>
