<!-- File: /app/View/Elements/menu.ctp -->

<head>
<?php echo ($this->Html->css('mycss.css')); ?>
</head>

<body>
<div id="login_status"><?php 
    if (AuthComponent::user()) {
        echo 'User: '. AuthComponent::user(['username']);
        echo '  '. $this->Html->link('[Logout]', array('controller'=>'Users', 'action'=>'logout'));
    }else{
        echo $this->Html->link('[Login]', array('controller'=>'Users', 'action'=>'login'));    } 
    ?></div>

<div id="sidebar">
<?php $index_list = $this->requestAction(array('controller'=>'Contracts', 'action'=>'index_list')); ?>
<?php foreach ($index_list as $data): ?>
    <?php $code = $data['Contract']['code']; ?>
    <?php if ($code == 'CS') {
            if(AuthComponent::user('tec') != 'tec' )  {
                continue; 
            } } ?> 
        <div id="menu"><?php echo 'Package '. $code ; ?><br></div>
        <div id="submenu"><?php echo $this->Html->link('> Contract', 
                                array('controller'=>'Contracts', 
                                    'action'=>'view', $code)); ?><br></div>
        <div id="submenu"><?php echo $this->Html->link('> Payment', 
                                array('controller'=>'Payments', 
                                    'action'=>'paylist', $code)); ?><br></div>
        <div id="submenu"><?php echo $this->Html->link('> Correspondence', 
                                array('controller'=>'Correspondences', 
                                    'action'=>'corres_list', $code)); ?><br></div>
        <div id="submenu"><?php echo $this->Html->link('> Contract Document', 
                                array('controller'=>'Contractdocuments', 
                                    'action'=>'document_list', $code)); ?><br></div><br>
        <div id="submenu"><?php echo $this->Html->link('> Material Approval', 
                                array('controller'=>'Materialapprovals', 
                                    'action'=>'approval_list', $code)); 
                                ?><br></div><br>
                            
<?php endforeach; ?>

<?php 
    ////
    //パンくずリストに挑戦中です。
    /*
    $crumb = array();
    foreach ($index_list as $data): 
        if ($data['Contract']['vo_no']>0) {continue;}
        $this->Html->addCrumb('Package '.$data['Contract']['code'], 
                            array('controller'=>'Contracts', 
                                'action'=>'view', 
                                $data['Contract']['code']));
        echo $this->Html->getCrumbList(array(
                                            'separator' => '&gt;',
                                            'firstClass' => 'first',
                                            'lastClass' => 'last'),
                                            'Top');
        echo $this->Html->getCrumbs('&gt;', array('text' => 'Top', 'url' => '/')); 
        $this->Html->addCrumb('Package '.$data['Contract']['code'], 
                            array('controller'=>'Contracts', 
                                'action'=>'view', 
                                $data['Contract']['code']));
        $this->Html->addCrumb('Payment', 
                            array('controller'=>'Payments', 
                                'action'=>'view', 
                                $data['Contract']['code']));
        $this->Html->addCrumb('Correspondence', 
                            array('controller'=>'Correspondences', 
                                'action'=>'corres_list', 
                                $data['Contract']['code']));
        $this->Html->addCrumb('Contract Document', 
                            array('controller'=>'Contractdocuments', 
                                'action'=>'document_list', 
                                $data['Contract']['code']));
    endforeach; 

    echo $this->Html->getCrumbs('&gt;', array('text' => 'Top', 'url' => '/'));
    */
    ?>
</div>
</body>