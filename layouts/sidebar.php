
<div class="wrapper">
    <div class="sidebar" data-color="purple" data-image="<?= $baseURL;?>assets/img/sidebar-5.jpg">
<!--

    Tip 1: you can change the color of the sidebar using: data-color="blue | azure | green | orange | red | purple"
    Tip 2: you can also add an image using data-image tag

-->
    <div class="sidebar-wrapper">
        <div class="logo">
            <a href="<?= $baseURL;?>index.php" class="simple-text">
                <?= $title_apl;?>
            </a>
        </div>
        <ul class="nav">
            <?php
                $id     = (int)$_SESSION['codekop_session']['id'];
                $user   = $connectdb->query("SELECT * FROM users WHERE id = $id")->fetch(PDO::FETCH_OBJ);
                $sql    = "SELECT * FROM menu ORDER by urutan ASC";
                $menus  = $connectdb->query($sql)->fetchAll(PDO::FETCH_OBJ);
                foreach($menus as $r){
                    $url = explode('/',$r->url);
                    // akses
                    if(getSegments('4') == $url[0]) 
                    {
                        $akses = explode(',',$r->akses);
                        if(!empty($akses[0]))
                        {
                            if (in_array("$user->akses", $akses))
                            {
                                // echo "found";
                            }else{
                                redirect($baseURL.'404.php');
                            }
                        }else{
                            if($r->akses != $user->akses)
                            {
                                redirect($baseURL.'404.php');
                            }
                        }
                        if(isset($r->redirect))
                        {
                            redirect($baseURL.$r->redirect);
                        }
                    }
                if($r->active == 'Y')
                {
                    $akses1 = explode(',',$r->akses);
                    if(!empty($akses1[0]))
                    {
                        if (in_array("$user->akses", $akses1))
                        {
                            // echo "found";
                            $cekhref = 'Yes';
                        }else{
                            $cekhref = 'No';
                        }
                    }else{
                        if($r->akses != $user->akses)
                        {
                            $cekhref = 'No';
                        }else{
                            $cekhref = 'Yes';
                        }
                    }
                    if($cekhref == 'Yes')
                    {
            ?>
            <li <?php if(getSegments('4') == $url[0]){?> class="active" <?php }?>>
                <a href="<?= $baseURL.$r->url;?>">
                    <i class="pe-7s-plus"></i>
                    <p><?=$r->name_menu;?></p>
                </a>
            </li>
            <?php }}}?>
            <?php if($user->akses == 1) {?>
            <li <?php if(getSegments('4') == 'generator'){?> class="active" <?php }?>>
                <a href="<?= $baseURL.'generator/index.php';?>">
                    <i class="pe-7s-settings"></i>
                    <p>CRUD Generator</p>
                </a>
            </li>
            <?php }?>
        </ul>
    </div>
</div>

<div class="main-panel">
    <nav class="navbar navbar-default navbar-fixed">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-example-2">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#"></a>
            </div>
            <div class="collapse navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a href="<?= $baseURL;?>logout.php">
                            <i class="pe-7s-angle-right-circle"></i>
                            Logout
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
