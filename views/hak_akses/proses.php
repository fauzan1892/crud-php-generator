
<?php
    if(!empty(getGet("aksi") == "tambah")) {
                $data[] =  getPost("hak_akses", TRUE);

    $sql = "INSERT INTO hak_akses (hak_akses ) VALUES ( ?)";
    $row = $connectdb->prepare($sql);
    $row->execute($data);
    
    set_flashdata("Berhasil","tambah telah sukses !","success");
    redirect("index.php");

    }

    if(!empty(getGet("aksi") == "update")) {
        $id =  (int)$_POST["id"];
                $data[] =  getPost("hak_akses", TRUE);

    $data[] = $id;
    $sql = "UPDATE hak_akses SET hak_akses = ?  WHERE id = ? ";

    $row = $connectdb->prepare($sql);
    $row->execute($data);

    set_flashdata("Berhasil","edit telah sukses !","success");
    redirect("edit.php?id=".$id);

    }

    if(!empty(getGet("aksi") == "delete")) {
        
    $id =  (int)$_GET["id"]; // should be integer (id)
    $sql = "SELECT * FROM hak_akses WHERE id = ?";
    $row = $connectdb->prepare($sql);
    $row->execute(array($id));
    $cek = $row->rowCount();
    if($cek > 0)
    {
        $sql_delete = "DELETE FROM hak_akses WHERE id = ?";
        $row_delete = $connectdb->prepare($sql_delete);
        $row_delete->execute(array($id));
        set_flashdata("Berhasil","delete telah sukses !","success");
        redirect("index.php");
    }else{
        set_flashdata("Gagal","delete telah gagal !","danger");
        redirect("index.php");
    }
    
    }
    