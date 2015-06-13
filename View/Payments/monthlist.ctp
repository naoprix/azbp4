<!-- File: /app/View/Payplans/monthlist.ctp -->

<h1><?php echo ($this->element('menu')); ?> </h1>
<h2><?php 

    $report_day = new DateTime($report_month."-01");
    $prev_month = ($report_day->format("Y-")).sprintf("%02d",($report_day->format("m")-1));
    $next_month = ($report_day->format("Y-")).sprintf("%02d",($report_day->format("m")+1));      

    echo $this->Html->link('<<　前月', array('action' => 'monthlist', $prev_month));
    echo '  '.mb_substr($report_month,0,4)."年".mb_substr($report_month,5,2)."月　支払予定  "; 
    echo $this->Html->link('次月　>>', array('action' => 'monthlist', $next_month));

?></h2>

<p><?php //echo $this->Html->link('Add Teciprojectlist', array('action' => 'add')); ?></p>
<p><?php echo $this->Html->link('Upload File', array('action' => 'upload')); ?></p>

<table>
    <tr>
        <th>件　番</th>
        <th>件　名</th>
        <th>契約金額</th>
        <th>実行予算</th>
        <th>支出（発注ベース）<br>
        支出（実績）</th>
        <th>差引（発注ベース）<br>
        差引（実績）</th>
        <th>進捗率</th>
        <th>PM</th>
    </tr>

<?php //pr($month_list);//Fetchデータを配列で取得 ?>

<!-- ここで$month_list配列をループして、投稿情報を表示 -->
    
    <?php pr($project_list);//この変数がキーになるようだ。内容がよくわからない。 ?>


    <?php foreach ($project_list as $value): ?>
    <tr>
        <td>
        <?php echo $this->Html->link(
            $value['Teciproject']['id'], 
                array('action' => 'view', 
                    $value['Teciproject']['id'])); ?>
        </td>
        <td><?php echo $value['Teciproject']['project_name']; ?></td>
        <td style="text-align: right"><?php echo $value['Teciproject']['contract_amount']; ?></td>
        <td style="text-align: right"><?php echo $value['Teciproject']['budget_at_completion']; ?></td>

        <?php
            $id = null;
            if (!empty($value['Payplan'])):
                foreach ($value['Payplan'] as $mon_data):
                    if($mon_data['report_month'] == $report_month):
                        $id = $mon_data['id']; 
                        $mon_cont_exp = $mon_data['personnel_expense'] 
                                      + $mon_data['subcontract_amount']
                                      + $mon_data['travel_expense']
                                      + $mon_data['print_expense']
                                      + $mon_data['miscellaneous_wage']
                                      + $mon_data['other_expense'];
                        $mon_actl_exp = $mon_data['personnel_expense'] 
                                      + $mon_data['subcontract_expense']
                                      + $mon_data['travel_expense']
                                      + $mon_data['print_expense']
                                      + $mon_data['miscellaneous_wage']
                                      + $mon_data['other_expense'];
            ?>
                <td style="text-align: right"><?php echo $mon_cont_exp ?><br>
                    <?php echo $mon_actl_exp ?></td>
                <td style="text-align: right"><?php echo $value['Teciproject']['budget_at_completion']-$mon_cont_exp ?><br>
                    <?php echo $value['Teciproject']['budget_at_completion']-$mon_actl_exp ?></td>
                <td><?php
                    if (!is_null($mon_data['progress'])){
                        echo $mon_data['progress']; 
                    }else{
                        echo $this->Html->link('未入力', array(
                            'action' => 'add', $value['Teciproject']['id']."_".$report_month));
                    }
                    ?></td>

                    <?php endif; ?>
                <?php endforeach; ?>
            <?php endif; ?>
            <?php if ($id == null) : ?>
            <td>---</td>
            <td>---</td>
            <td><?php echo $this->Html->link('未入力', array(
                        'action' => 'add', $value['Teciproject']['id']."_".$report_month)); ?></td>
            <?php endif; ?>
        
        <td><?php echo $value['User']['staff_code']; ?></td>

        <td>
            <?php echo $this->Html->link('編集', array('action' => 'edit', $id)); ?>
        </td> 
    </tr>
    <?php endforeach; ?>

</table>
