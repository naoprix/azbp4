<!-- File: /app/View/Payments/paylist.ctp -->

<h1><?php echo ($this->element('menu')); ?> </h1>

<h2><?php echo 'Package ',$contract['0']['Contract']['code']; ?>
    <?php echo ' : ',$contract['0']['Contract']['contract_name']; ?></h2>
<h2>Payment Record</h2>
<p><?php echo 'Contractor: ',$contract['0']['Contract']['contractor'];?></p>
<p><?php echo 'Date of Contract Signing: ',$contract['0']['Contract']['date_sign'];?></p>
<p><?php echo 'Date of Commencement: ',$contract['0']['Contract']['date_commencement'];?></p>

<p><?php if (AuthComponent::user('role')=='admin') {
            echo $this->Html->link('Add Invoice Data', 
                      array('action' => 'add_invoice', $contract['0']['Contract']['code'])); } 
    ?></p>
<table>
    <tr>
        <?php 
            $t_headder = array("Invoice No.", "Date", "Work done", "Retention", "Release of Retention", "Advance Payment", "Repayment of Advance Pay.", "Total", "VAT", "Total Due"); 
            foreach ($t_headder as $head) { echo "<th>".$head."</th>"; } 
        ?>
    </tr>
    
    <?php foreach ($payment as $data): ?>
            <?php 
                $total_bill = $data['Payment']['bill01']
                        + $data['Payment']['bill02']
                        + $data['Payment']['bill03']
                        + $data['Payment']['bill04']
                        + $data['Payment']['bill05']
                        + $data['Payment']['bill06']
                        + $data['Payment']['bill07']
                        + $data['Payment']['bill08']
                        + $data['Payment']['bill09']
                        + $data['Payment']['bill10'];
                $total_price = $total_bill 
                        + $data['Payment']['daywork']
                        + $data['Payment']['p-sum'];
                //$price_vat = round($total_price*1.18,2); 

                $total_due_net = $total_price 
                        - $data['Payment']['retention']
                        + $data['Payment']['release_ret']
                        + $data['Payment']['advance']
                        - $data['Payment']['repay-adv'];

                $vat = round($total_due_net*.18,2);

                $total_due = $total_due_net + $vat; 

            ?>
    <tr>    <td><?php echo $this->Html->link($data['Payment']['invoice_no'],
                            array('action' => 'view', $data['Payment']['id'])); ?></td>
            <td><?php echo $data['Payment']['date']; ?></td>
            <td style="text-align: right"><?php echo number_format($total_price,2); ?></td>
            <td style="text-align: right"><?php echo number_format($data['Payment']['retention'],2); ?></td>
            <td style="text-align: right"><?php echo number_format($data['Payment']['release_ret'],2); ?></td>
            <td style="text-align: right"><?php echo number_format($data['Payment']['advance'],2); ?></td>
            <td style="text-align: right"><?php echo number_format($data['Payment']['repay-adv'],2); ?></td>
            <td style="text-align: right"><?php echo number_format($total_due_net,2); ?></td>
            <td style="text-align: right"><?php echo number_format($vat,2); ?></td>
            <td style="text-align: right"><?php echo number_format($total_due,2); ?></td>
            <td><?php if (AuthComponent::user('role')=='admin') {
                        echo $this->Html->link('Edit', 
                            array('action' => 'edit_invoice', $data['Payment']['id']));
                    } ?></td>

    </tr>
    <?php endforeach; ?>

</table>


