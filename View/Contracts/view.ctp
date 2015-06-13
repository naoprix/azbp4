<!-- File: /app/View/Contracts/view.ctp -->

<h1><?php echo ($this->element('menu')); ?> </h1>

<h2><?php echo 'Package ',$contract['0']['Contract']['code']; ?>
    <?php echo ' : ',$contract['0']['Contract']['contract_name']; ?></h2>
<h2>Contract Data</h2>
<p><?php echo 'Contractor: ',$contract['0']['Contract']['contractor'];?></p>
<p><?php echo 'Date of Contract Signing: ',$contract['0']['Contract']['date_sign'];?></p>
<p><?php echo 'Date of Commencement: ',$contract['0']['Contract']['date_commencement'];?></p>

<p><?php if (AuthComponent::user('role')=='admin') {
            echo $this->Html->link('Add Variaton Order Data', 
                      array('action' => 'add_vo', $contract['0']['Contract']['code'])); }
    ?></p>


<?php 
//表のヘッダーコラムを作りました。
    $r[0][0] = '';
    for ($j=1; $j<11; $j++) { $r[$j][0] = "Bill No.{$j}"; }
    $r[11][0] = 'Total Bill';
    $r[12][0] = 'Daywork';
    $r[13][0] = 'Provisional Sum';
    $r[14][0] = 'Contingency';
    $r[15][0] = 'Total Price';
    $r[16][0] = 'VAT';
    $r[17][0] = 'Contract Amount';
    $r[18][0] = '';

//二元配列を作ってみました。
for ($i=0; $i<count($contract); $i++) {

    $total_bill = $contract[$i]['Contract']['bill01']
                + $contract[$i]['Contract']['bill02']
                + $contract[$i]['Contract']['bill03']
                + $contract[$i]['Contract']['bill04']
                + $contract[$i]['Contract']['bill05']
                + $contract[$i]['Contract']['bill06']
                + $contract[$i]['Contract']['bill07']
                + $contract[$i]['Contract']['bill08']
                + $contract[$i]['Contract']['bill09']
                + $contract[$i]['Contract']['bill10'];
    $total_price = $total_bill 
                 + $contract[$i]['Contract']['daywork']
                 + $contract[$i]['Contract']['p-sum']
                 + $contract[$i]['Contract']['contingency'];
    $vat = round($total_price*0.18,2);
    $contract_amount = $total_price + $vat; 

    $r[0][] = $contract[$i]['Contract']['vo_no'];
    for ($j=1; $j<11; $j++) {
        $bill_no = sprintf("%02d",$j);
        $r[$j][] = $contract[$i]['Contract']["bill{$bill_no}"]+0; }
    $r[11][] = $total_bill;
    $r[12][] = $contract[$i]['Contract']['daywork']+0;
    $r[13][] = $contract[$i]['Contract']['p-sum']+0;
    $r[14][] = $contract[$i]['Contract']['contingency']+0;
    $r[15][] = $total_price;
    $r[16][] = $vat;
    $r[17][] = $contract_amount;
    $r[18][] = $contract[$i]['Contract']['id'];

} 
?>

<table>
    <tr><?php for ($x=0; $x<count($contract)+1; $x++){
            if ($x != 0) {
              echo "<th>".'VO No. '.$r[0][$x]."</th>"; 
            }else{
              echo "<th>".'Item'."</th>";
            } } ?></tr>
    <?php for ($y=1; $y<18; $y++): ?>
        <tr><?php for ($x=0; $x<count($contract)+1; $x++){
            if (is_string($r[$y][$x])) {
                echo "<td>".$r[$y][$x]."</td>";
            }else{
                echo "<td style=\"text-align: right\">".number_format($r[$y][$x],2)."</td>";
            } } ?></tr>
    <?php endfor; ?>
    <tr><?php for ($x=0; $x<count($contract)+1; $x++){
      if($x !=0) {
        if (AuthComponent::user('role')=='admin') {
            echo "<td style=\"text-align: center\">".$this->Html->link('edit', array('action' => 'edit', $r[18][$x]))."</td>"; 
            } 
        }else{
            echo "<td></td>"; } } ?></tr>

</table>


