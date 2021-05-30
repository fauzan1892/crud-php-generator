<?php
    
    if(!empty($_GET['aksi'] == 'tambah')) {

        $table = getPost('table', TRUE);

        $column = $connectdb->prepare("SELECT 1 FROM $table LIMIT 1");
        $column->execute();
        $tcount = $column->rowCount();

        if($tcount == 0)
        {
            set_flashdata("Gagal","Tabel tidak ditemukan !","danger");
            redirect("tambah.php");
            exit;
        }

        $kolom = $connectdb->prepare("SELECT * FROM $table LIMIT 0");
        $kolom->execute();
        if (!is_dir( dirname(__DIR__) .'/'.$table)) //FCPATH is absolute path to the project directory
      	{
			mkdir( dirname(__DIR__) .'/'.$table, 0777, true ); //although 0755 is just fine and recomended for uploading and reading
		}

    $html_code_tabel .= '
        <div class="table-responsive">
            <table class="table table-striped" id="example1">
                <thead>
                    <tr>
                        <th>No</th>
            ';
        // for basic form ---
    for ($i = 0; $i < $kolom->columnCount(); $i++) {
        $col = $kolom->getColumnMeta($i);
        $col['name'];
        // echo $col['native_type'].' =>'.$col['name'].'<br>';
        $label = ucfirst(preg_replace('/[^a-zA-Z0-9\']/', ' ', $col['name']));
        //tipe kolom
        if($col['native_type'] == 'LONG')
        {
            $type = 'number';
        }else if($col['native_type'] == 'BLOB'){
            $type = 'textarea';
        }else if($col['native_type'] == 'DATE'){
            $type = 'date';
        }else if($col['native_type'] == 'TIMESTAMP'){
            $type = 'datetime-local';
        }else{
            $type = 'text';
        }

        if($type == 'textarea')
        {
            $inputmode = '<textarea class="form-control" required name="'.$col['name'].'" id="'.$col['name'].'" placeholder=""></textarea>';
            $inputmode_update = '<textarea class="form-control" name="'.$col['name'].'" id="'.$col['name'].'" placeholder=""><?= $edit->'.$col['name'].';?></textarea>';
        }else{
            $inputmode = '<input type="'.$type.'" class="form-control" required name="'.$col['name'].'" id="'.$col['name'].'" placeholder="">';
            $inputmode_update = '<input type="'.$type.'" class="form-control" value="<?= $edit->'.$col['name'].';?>" name="'.$col['name'].'" id="'.$col['name'].'" placeholder=""/>';
        }

        if($col['name'] != 'id')
        {
            $html_tambah .= '
                <div class="form-group">
                    <label for="">'.$label.'</label>
                    '.$inputmode.'
                </div>
                ';
            $html_update .= '
                <div class="form-group">
                    <label for="">'.$label.'</label>
                    '.$inputmode_update.'
                </div>
            ';
            $html_code_tabel .= '
                <th>'. $label.'</th>'; 
        }
    }
    $html_code_tabel .= '
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                $no =1;
                $sql = "SELECT * FROM '.$table.' ORDER BY id DESC";
                $row = $connectdb->prepare($sql);
                $row->execute();
                $hasil = $row->fetchAll(PDO::FETCH_OBJ);
                foreach($hasil as $r){
            ?>
            <tr>
                <td><?= $no;?></td>
    ';

    for ($i = 0; $i < $kolom->columnCount(); $i++) {
        $col = $kolom->getColumnMeta($i);
        $col['name'];
        
        // echo $col['native_type'].' =>'.$col['name'].'<br>';
        $label = ucfirst(preg_replace('/[^a-zA-Z0-9\']/', ' ', $col['name']));

        if($col['name'] != 'id')
        {
$html_code_tabel .= '      
            <td><?=$r->'.$col['name'].';?></td>'; 
$crud_insert .= '        $data[] =  getPost("'.$col['name'].'", TRUE);
';   
$crud_update .= '        $data[] =  getPost("'.$col['name'].'", TRUE);
';     
        }

    }

$crud_insert .= '
    $sql = "INSERT INTO '.$table.' (';
$crud_update .= '
    $data[] = $id;
    $sql = "UPDATE '.$table.' SET ';
    $n = $kolom->columnCount();
    $a = $n - 1;
    $r = 1;
    for ($i = 0; $i < $kolom->columnCount(); $i++) {
        $col = $kolom->getColumnMeta($i);
        $col['name'];
        // echo $col['native_type'].' =>'.$col['name'].'<br>';
        $label = ucfirst(preg_replace('/[^a-zA-Z0-9\']/', ' ', $col['name']));
        if($col['name'] != 'id')
        {
            if($a == $r){
                $crud_insert .= "".$col['name']."";   
                $tanda .= "?";
                $crud_update .= "".$col['name']." = ? ";  
            }else{
                if($a == 1){
                    $crud_insert .= "".$col['name']."";   
                    $crud_update .= "".$col['name']." = ?";  
                    $tanda .= "?";
                }else{
                    $crud_insert .= "".$col['name'].",";   
                    $crud_update .= "".$col['name']." = ?, ";  
                    $tanda .= "?,";
                }
            }
            $r++;
        }
    }
   
$crud_insert .= ' ) VALUES ( '.$tanda.')";
    $row = $connectdb->prepare($sql);
    $row->execute($data);
    
    set_flashdata("Berhasil","tambah telah sukses !","success");
    redirect("index.php");
';
$crud_update .= ' WHERE id = ? ";

    $row = $connectdb->prepare($sql);
    $row->execute($data);

    set_flashdata("Berhasil","edit telah sukses !","success");
    redirect("edit.php?id=".$id);
';

$crud_delete .= '
    $id =  (int)$_GET["id"]; // should be integer (id)
    $sql = "SELECT * FROM '.$table.' WHERE id = ?";
    $row = $connectdb->prepare($sql);
    $row->execute(array($id));
    $cek = $row->rowCount();
    if($cek > 0)
    {
        $sql_delete = "DELETE FROM '.$table.' WHERE id = ?";
        $row_delete = $connectdb->prepare($sql_delete);
        $row_delete->execute(array($id));
        set_flashdata("Berhasil","delete telah sukses !","success");
        redirect("index.php");
    }else{
        set_flashdata("Gagal","delete telah gagal !","danger");
        redirect("index.php");
    }
    ';

$html_code_tabel .= '
                <td>
                    <a href="<?= "edit.php?id=".$r->id;?>" 
                        class="btn btn-success btn-sm" title="Edit">
                        <i class="fa fa-edit"></i> 
                    </a> 
                    <a href="<?= "proses.php?aksi=delete&id=".$r->id;?>" 
                        class="btn btn-danger btn-sm" 
                        onclick="javascript:return confirm(`Data ingin dihapus ?`);" title="Delete">
                        <i class="fa fa-times"></i> 
                    </a>
                </td>
            </tr>
            <?php $no++; }?>
        </tbody>
    </table>
</div>
';

        $my_file1 = dirname(__DIR__) .'/'.$table.'/tambah.php';
        $my_file2 = dirname(__DIR__) .'/'.$table.'/edit.php';
        $my_file3 = dirname(__DIR__) .'/'.$table.'/index.php';
        $my_file4 = dirname(__DIR__) .'/'.$table.'/proses.php';

$data1 = '
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <div class="card">
                    <div class="header">
                        <h4 class="title">Add '.$_POST["name_menu"].'</h4>
                    </div>
                    <div style="border-top:1px solid #ddd;margin-top:12px;"></div>
                    <div class="content">
                        <form action="proses.php?aksi=tambah" method="post">
                            '.$html_tambah.'
                            <button type="submit" class="btn btn-primary btn-md">Save</button>
                            <a href="index.php" class="btn btn-danger btn-md">Back</a>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-3"></div>
        </div>
    </div>
</div>';

$data2 = '
<?php
    $id =  (int)$_GET["id"];
    $sql = "SELECT * FROM '.$table.' WHERE id = ?";
    $row = $connectdb->prepare($sql);
    $row->execute(array($id));
    $edit = $row->fetch(PDO::FETCH_OBJ);
?>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
            <?php if(!empty(flashdata())){ echo flashdata(); }?>
                <div class="card">
                    <div class="header">
                        <h4 class="title">Edit '.$_POST["name_menu"].'</h4>
                    </div>
                    <div style="border-top:1px solid #ddd;margin-top:12px;"></div>
                    <div class="content">
                        <form action="proses.php?aksi=update" method="post">
                            '.$html_update.'
                            <input type="hidden" name="id" value="<?= $id;?>">
                            <button type="submit" class="btn btn-primary btn-md">Save</button>
                            <a href="index.php" class="btn btn-danger btn-md">Back</a>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-3"></div>
        </div>
    </div>
</div>';

$data3 = '
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <?php if(!empty(flashdata())){ echo flashdata(); }?>
                <a href="tambah.php" class="btn btn-primary" role="button">Add '.$_POST["name_menu"].'</a>
                <br><br>
                <div class="card">
                    <div class="header">
                        <h4 class="title">Daftar '.$_POST["name_menu"].'</h4>
                    </div>
                    <div style="border-top:1px solid #ddd;margin-top:12px;"></div>
                    <div class="content">
                        '.$html_code_tabel.'
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>';

$data4 = '
<?php
    if(!empty(getGet("aksi") == "tambah")) {
        '.$crud_insert.'
    }

    if(!empty(getGet("aksi") == "update")) {
        $id =  (int)$_POST["id"];
        '.$crud_update.'
    }

    if(!empty(getGet("aksi") == "delete")) {
        '.$crud_delete.'
    }
    ';

        $handle1 = fopen($my_file1, 'w') or die('Cannot open file:  '.$my_file1);
        $handle2 = fopen($my_file2, 'w') or die('Cannot open file:  '.$my_file2);
        $handle3 = fopen($my_file3, 'w') or die('Cannot open file:  '.$my_file3);
        $handle4 = fopen($my_file4, 'w') or die('Cannot open file:  '.$my_file4);

        fwrite($handle1, $data1);
        fwrite($handle2, $data2);
        fwrite($handle3, $data3);
        fwrite($handle4, $data4);

        if($_POST["akses"] == NULL)
        {
            $label = "";
        }else{
            $label =  implode(',',$_POST["akses"]);
        }

        $data[] =  htmlspecialchars($_POST["name_menu"]);
        $data[] =  $table;
        $data[] =  $table.'/'.htmlspecialchars($_POST["url"]);
        $data[] =  $label;
        $data[] =  htmlspecialchars($_POST["active"]);
        $data[] =  date('Y-m-d H:i:s');

       $sql = "INSERT INTO menu (name_menu,tabel,url,akses,active,created_at ) VALUES ( ?,?,?,?,?,?)";
        $row = $connectdb->prepare($sql);
        $row->execute($data);
        set_flashdata('Berhasil','tambah telah sukses !','success');
        redirect("index.php");
    }

    if(!empty($_GET['aksi'] == 'update')) {

        if($_POST["akses"] == NULL)
        {
            $label = "";
        }else{
            $label =  implode(',',$_POST["akses"]);
        }

        if(!empty(htmlspecialchars($_POST["redirect"])))
        {
            $redir = htmlspecialchars($_POST["redirect"]);
        }else{
            $redir = NULL;
        }

        $id     =  (int)$_POST["id"]; // should be integer (id)
        $data[] =  htmlspecialchars($_POST["name_menu"]);
        $data[] =  htmlspecialchars($_POST["url"]);
        $data[] =  $redir;
        $data[] =  htmlspecialchars($_POST["active"]);
        $data[] =  $label;
        $data[] =  date('Y-m-d H:i:s');
        $data[] =  $id;

        $sql = "UPDATE menu SET name_menu = ?, url = ?, redirect = ?, active = ?, akses =?, created_at = ?  WHERE id = ? ";

        $row = $connectdb->prepare($sql);
        $row->execute($data);
        
        set_flashdata('Berhasil','edit telah sukses !','success');
        redirect("edit.php?id=".$id);
    }

    if(!empty($_GET['aksi'] == 'delete')) {

        $id =  (int)$_GET["id"]; // should be integer (id)
        $sql = "SELECT * FROM menu WHERE id = ?";
        $row = $connectdb->prepare($sql);
        $row->execute(array($id));
        $cek = $row->rowCount();
        if($cek > 0)
        {
            $hsl = $row->fetch();
            
            deleteFolder(dirname(__DIR__) .'/'.$hsl['tabel']);

            $sql_delete = "DELETE FROM menu WHERE id = ?";
            $row_delete = $connectdb->prepare($sql_delete);
            $row_delete->execute(array($id));

            set_flashdata('Berhasil','delete telah sukses !','success');
            redirect("index.php");

        }else{
            set_flashdata('Gagal','delete telah gagal !','success');
            redirect("index.php");
        }

    }

    if(!empty($_GET['aksi'] == 'order')) {
 
        $orderlist = explode(',', $_POST['order']);
        foreach ($orderlist as $k => $order) {
            $sql = "UPDATE menu SET urutan = $k+1 WHERE id = $order";
            $row = $connectdb->prepare($sql);
            $row->execute();
        }  
        echo 'sukses';
    }
   