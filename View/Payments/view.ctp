<!-- File: /app/View/Payments/view.ctp -->

<h1><?php echo ($this->element('menu')); ?> </h1>

<?php //pr($paid); ?>
<?php //pr($contract); ?>
<h2>Payment Record</h2>

<h2><?php echo 'Package: ',$contract['0']['Contract']['code']; ?>
    <?php echo ' : ',$contract['0']['Contract']['contract_name']; ?></h2>
<p><?php echo 'Contractor: ',$contract['0']['Contract']['contractor'];?></p>
<p><?php echo 'Date of Contract Signing: ',$contract['0']['Contract']['date_sign'];?></p>
<p><?php echo 'Date of Commencement: ',$contract['0']['Contract']['date_commencement'];?></p>
<h2><?php echo 'Invoice No.'.$invoice['Payment']['invoice_no']; ?></h2>
<p><?php echo 'Invoice Date.'.$invoice['Payment']['date']; ?></p>

<?php 
////
//表のヘッダーコラムを作りました。

    $r[0][0] = '';
    for ($j=1; $j<11; $j++) { $r[$j][0] = "Bill No.{$j}"; }
    $r[11][0] = 'Total Bill';
    $r[12][0] = 'Daywork';
    $r[13][0] = 'Provisional Sum';
    $r[14][0] = 'Contingency';
    $r[15][0] = 'Total Price';
    $r[16][0] = 'VAT (price)';
    $r[17][0] = 'Contract Amount';
    $r[18][0] = 'Retention Money';
    $r[19][0] = 'Release of Retention';
    $r[20][0] = 'Advance Payment';
    $r[21][0] = 'Repayment of Advance Payment';
    $r[22][0] = 'VAT total';
    $r[23][0] = 'Total Paid Amount';

////
//一列目にcontractデータを持ってくる

    $n = count($contract) - 1;
    //最後のデータを引っ張ってくる。最後のデータとはVO番号が大きい契約データです。

    $r[0][1] = 'Vo No.'.$contract[$n]['Contract']['vo_no'];
    $r[11][1] = 0;//初期化です。
    for ($j=1; $j<11; $j++) {
        $bill_no = sprintf("%02d",$j);
        $r[$j][1] = $contract[$n]['Contract']["bill{$bill_no}"]+0;
        $r[11][1] += $r[$j]['1']; }
    $r[12][1] = $contract[$n]['Contract']['daywork']+0;
    $r[13][1] = $contract[$n]['Contract']['p-sum']+0;
    $r[14][1] = $contract[$n]['Contract']['contingency']+0;
    $r[15][1] = $r[11]['1'] + $r[12]['1'] + $r[13]['1'] + $r[14]['1'];
    $r[16][1] = round($r[15][1]*0.18,2);
    $r[17][1] = $r[15][1] + $r[16][1];
    $r[22][1] = $r[16][1];
    $r[23][1] = $r[17][1];
    for ($j=18; $j<23; $j++) { $r[$j][1] = 0; }

////
//二列目にpaidデータとして累計値を持ってくる

    $r[0][2] = 'Paid Amount';
    for ($j=1; $j<11; $j++) {$r[$j][2]=0;}//初期化です。
    $r[12][2] = 0;//初期化です。
    $r[13][2] = 0;//初期化です。
    $r[18][2] = 0;//初期化です。
    $r[19][2] = 0;//初期化です。
    $r[20][2] = 0;//初期化です。
    $r[21][2] = 0;//初期化です。

    foreach ($paid as $data) {
        for ($j=1; $j<11; $j++) {
            $bill_no = sprintf("%02d",$j);
            $r[$j][2] += $data['Payment']["bill{$bill_no}"]+0; 
        }
    
        $r[11][2] = $r[1][2]+$r[2][2]+$r[3][2]+$r[4][2]+$r[5][2]+$r[6][2]+$r[7][2]+$r[8][2]+$r[9][2]+$r[10][2];
        $r[12][2] += $data['Payment']['daywork']+0;
        $r[13][2] += $data['Payment']['p-sum']+0;
        $r[14][2] = 0;// コンティンジェンシーの支払いは常にゼロ
        $r[15][2] = $r[11][2] + $r[12][2] + $r[13][2] + $r[14][2];
        $r[16][2] = round($r[15][2]*0.18,2);
        $r[17][2] = $r[15][2] + $r[16][2];
        $r[18][2] += $data['Payment']['retention']+0;
        $r[19][2] += $data['Payment']['release_ret']+0;
        $r[20][2] += $data['Payment']['advance']+0;
        $r[21][2] += $data['Payment']['repay-adv']+0;
        $r[22][2] = round(($r[15][2]-$r[18][2]+$r[19][2]+$r[20][2]-$r[21][2])*0.18,2);
        $r[23][2] = ($r[15][2]-$r[18][2]+$r[19][2]+$r[20][2]-$r[21][2]) + $r[22][2];
    }

////
//三列目にinvoiceデータを持ってくる

    $r[0][3] = 'Invoice No.'.$invoice['Payment']['invoice_no'];
    $r[11][3] =0;//初期化です。

    for ($j=1; $j<11; $j++) {
        $bill_no = sprintf("%02d",$j);
        $r[$j][3] = $invoice['Payment']["bill{$bill_no}"]+0;
        $r[11][3] += $r[$j]['3']; }

    $r[12][3] = $invoice['Payment']['daywork']+0;
    $r[13][3] = $invoice['Payment']['p-sum']+0;
    $r[14][3] = 0;//コンティンジェンシーなのでゼロ
    $r[15][3] = $r[11]['3'] + $r[12]['3'] + $r[13]['3'] + $r[14]['3'];
    $r[16][3] = round($r[15]['3']*0.18,2);
    $r[17][3] = $r[15][3] + $r[16][3];
    $r[18][3] = $invoice['Payment']['retention']+0;
    $r[19][3] = $invoice['Payment']['release_ret']+0;
    $r[20][3] = $invoice['Payment']['advance']+0;
    $r[21][3] = $invoice['Payment']['repay-adv']+0;
    $r[22][3] = round(($r[15][3]-$r[18][3]+$r[19][3]+$r[20][3]-$r[21][3])*0.18,2);
    $r[23][3] = ($r[15][3]-$r[18][3]+$r[19][3]+$r[20][3]-$r[21][3]) + $r[22][3];

////
//四列目にAccumulated

    $r[0][4] = 'Accumlated Amount';
    //for ($j=1; $j<24; $j++) { if (count($paid) == 0) {$r[$j][2] = 0 ;} }
    for ($j=1; $j<24; $j++) { 
        if (count($paid) == 0) { $r[$j][2] = 0; }
        $r[$j][4] = $r[$j][2] + $r[$j][3]+0 ;
    }

////
//五列目にBalance

    $r[0][5] = 'Balance';
    for ($j=1; $j<18; $j++) {
    $r[$j][5] = $r[$j][1] - $r[$j][4] +0; }
    for ($j=18; $j<24; $j++) {$r[$j][5] = 0;}

////
//六列目にパーセンテージ

    $r[0][6] = 'Percentage';
    for ($j=1; $j<24; $j++) { $r[$j][6] = $r[$j]['1'] !=0 ? round($r[$j]['4'] / $r[$j]['1'] * 100,2) : 0; }

?>

<table>
    <tr><?php for ($x=0; $x<7; $x++){
            echo $x != 0 ? "<th>".$r[0][$x]."</th>" : "<th>".'ITEM'."</th>"; } ?></tr>

    <?php for ($y=1; $y<24; $y++): ?>
        <tr><?php for ($x=0; $x<6; $x++){
                echo is_string($r[$y][$x]) ? 
                "<td>".$r[$y][$x]."</td>" : "<td style=\"text-align: right\">".number_format($r[$y][$x],2)."</td>"; 
            } ?>
            <?php echo "<td style=\"text-align: right\">".number_format($r[$y][6],2).'%'."</td>"; ?>
        </tr>

    <?php endfor; ?>

</table>