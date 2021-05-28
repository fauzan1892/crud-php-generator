<?php

    function redirect($url)
    {
        echo '<script>window.location="'.$url.'";</script>';
    }

    function getSegments($segment)
    {
        $explode_url = explode('/',$_SERVER['REQUEST_URI']);
        $rowurl = count(explode('/',$baseURL));
        $row_url = count(parse_url($baseURL));
        $urlc = $rowurl-$row_url;
        $rurl = $urlc-1;
        $cont = $segment + $rurl;
        $uriSegments = explode("/", parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
        return $uriSegments[$cont];
    }

    function set_flashdata($pesan, $aksi, $tipe)
    {
        $_SESSION['flash'] = [
            'pesan' => $pesan,
            'aksi'  => $aksi,
            'tipe'  => $tipe
        ];
    }

    function flashdata()
    {
        if( isset($_SESSION['flash']) ) {
            echo '<div class="alert alert-' . $_SESSION['flash']['tipe'] . '">
                    <strong>' . $_SESSION['flash']['pesan'] . '</strong> ' . $_SESSION['flash']['aksi'] . '
                </div>';
            unset($_SESSION['flash']);
        }
    }

    function getPost($name, $t = null)
    {
        if($t == TRUE)
        {
            return strip_tags($_POST[''.$name.'']);
        }else{
            return $_POST[''.$name.''];
        }
    }

    function getGet($name, $t = null)
    {
        if($t == TRUE)
        {
            return strip_tags($_GET[''.$name.'']);
        }else{
            return $_GET[''.$name.''];
        }
    }

    function deleteFolder($str) {
      //It it's a file.
        if (is_file($str)) {
            //Attempt to delete it.
            return unlink($str);
        }
        //If it's a directory.
        elseif (is_dir($str)) {
            //Get a list of the files in this directory.
            $scan = glob(rtrim($str,'/').'/*');
            //Loop through the list of files.
            foreach($scan as $index=>$path) {
                //Call our recursive function.
                deleteFolder($path);
            }
            //Remove the directory itself.
            return @rmdir($str);
        }
    }