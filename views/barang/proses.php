
<?php
    if(!empty(getGet("aksi") == "tambah")) {
                $data[] =  getPost("nama_barang", TRUE);
        $data[] =  getPost("harga", TRUE);
        $data[] =  getPost("jenis", TRUE);

    $sql = "INSERT INTO barang (nama_barang,harga,jenis ) VALUES ( ?,?,?)";
    $row = $connectdb->prepare($sql);
    $row->execute($data);
    
    set_flashdata("Berhasil","tambah telah sukses !","success");
    redirect("index.php");

    }

    if(!empty(getGet("aksi") == "update")) {
        $id =  (int)$_POST["id"];
                $data[] =  getPost("nama_barang", TRUE);
        $data[] =  getPost("harga", TRUE);
        $data[] =  getPost("jenis", TRUE);

    $data[] = $id;
    $sql = "UPDATE barang SET nama_barang = ?, harga = ?, jenis = ?  WHERE id = ? ";

    $row = $connectdb->prepare($sql);
    $row->execute($data);

    set_flashdata("Berhasil","edit telah sukses !","success");
    redirect("edit.php?id=".$id);

    }

    if(!empty(getGet("aksi") == "delete")) {
        
    $id =  (int)$_GET["id"]; // should be integer (id)
    $sql = "SELECT * FROM barang WHERE id = ?";
    $row = $connectdb->prepare($sql);
    $row->execute(array($id));
    $cek = $row->rowCount();
    if($cek > 0)
    {
        $sql_delete = "DELETE FROM barang WHERE id = ?";
        $row_delete = $connectdb->prepare($sql_delete);
        $row_delete->execute(array($id));
        set_flashdata("Berhasil","delete telah sukses !","success");
        redirect("index.php");
    }else{
        set_flashdata("Gagal","delete telah gagal !","danger");
        redirect("index.php");
    }
    
    }
    