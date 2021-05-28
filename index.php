<?php
/*
  |--------------------------------------------------------------------------
  | Codekop CRUD PHP Generator With Admin Template
  |--------------------------------------------------------------------------
  |
  | @package   : php-generator-v1
  | @author    : fauzan1892
  | @copyright : Copyright (c) 2019-2020 Codekop.com (https://www.codekop.com)
  |
  | free for everyone to development a simple crud generator project 
  | recommended php version for running is 7.0 but is run for php 5.6+
  | 
 */

    session_start();
    
    include 'setting.php';
    include 'helper.php';

    if(!empty($_SESSION['codekop_session'])){  }else{ redirect($baseURL.'login.php'); }

    $explode_url = explode('/',$_SERVER['REQUEST_URI']);
    $rowurl = count(explode('/',$baseURL));
    $row_url = count(parse_url($baseURL));
    $urlc = $rowurl-$row_url;
    $rurl = $urlc-1;
    $explode_url = array_slice($explode_url, $rurl);
    
    include 'layouts/header.php';
    include 'layouts/sidebar.php';

    if(!empty($explode_url[1]))
    {
        if(!empty($explode_url[2]))
        {
            if(!empty($explode_url[3]))
            {

                $fl = explode('.php',$explode_url[3]);
                if(empty($fl[0]))
                {
                    include 'views/errors/404.php';
                }else{
                    $files = explode('?',$explode_url[3]);
                    if(file_exists('views/'.$explode_url[1].'/'.$explode_url[2].'/'.$files[0]))
                    {
                        include 'views/'.$explode_url[1].'/'.$explode_url[2].'/'.$files[0];
                    }else{
                        include 'views/errors/404.php';
                    }
                }
                
            }else{
            
                $files = explode('?',$explode_url[2]);
                if(file_exists('views/'.$explode_url[1].'/'.$files[0]))
                {
                    include 'views/'.$explode_url[1].'/'.$files[0];
                }else{
                    include 'views/errors/404.php';
                }
            }

        }else{

            if($explode_url[1] != 'index.php')
            {
                if(file_exists('views/'.$explode_url[1].'/index.php'))
                {
                    include 'views/'.$explode_url[1].'/index.php';
                }else{
                    include 'views/errors/404.php';
                }
            }else{
                include 'views/home/index.php';
            }

        }
    }else{
        include 'views/home/index.php';
    }
    
    include 'layouts/footer.php';