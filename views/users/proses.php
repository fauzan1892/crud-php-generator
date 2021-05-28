
<?php
    if(!empty(getGet("aksi") == "tambah")) {
        
        $pass = password_hash(htmlspecialchars($_POST["pass"]), PASSWORD_DEFAULT);

        $data[] =  htmlspecialchars($_POST["name"]);
        $data[] =  htmlspecialchars($_POST["user"]);
        $data[] =  $pass;
        $data[] =  $_POST["akses"];
        $data[] =  $_POST["active"];
        $data[] =  date('Y-m-d H:i:s');

        $sql = "INSERT INTO users (name,user,pass,akses,active,created_at ) VALUES (?,?,?,?,?,?)";
        $row = $connectdb->prepare($sql);
        $row->execute($data);
        
        set_flashdata("Berhasil","tambah telah sukses !","success");
        redirect("index.php");

    }

    if(!empty(getGet("aksi") == "update")) {
        $id =  (int)$_POST["id"];
        
        $pass = password_hash(htmlspecialchars($_POST["pass"]), PASSWORD_DEFAULT);

        $data[] =  htmlspecialchars($_POST["name"]);
        $data[] =  htmlspecialchars($_POST["user"]);
        $data[] =  $pass;
        $data[] =  htmlspecialchars($_POST["akses"]);
        $data[] =  htmlspecialchars($_POST["active"]);
        $data[] =  date('Y-m-d H:i:s');

        $data[] = $id;
        $sql = "UPDATE users SET name = ?, user = ?, pass = ?, akses = ?, active = ?, created_at = ?  WHERE id = ? ";

        $row = $connectdb->prepare($sql);
        $row->execute($data);

        set_flashdata("Berhasil","edit telah sukses !","success");
        redirect("edit.php?id=".$id);

    }

    if(!empty(getGet("aksi") == "delete")) {
        
        $id =  (int)$_GET["id"]; // should be integer (id)
        $sql = "SELECT * FROM users WHERE id = ?";
        $row = $connectdb->prepare($sql);
        $row->execute(array($id));
        $cek = $row->rowCount();
        if($cek > 0)
        {
            $sql_delete = "DELETE FROM users WHERE id = ?";
            $row_delete = $connectdb->prepare($sql_delete);
            $row_delete->execute(array($id));
            set_flashdata("Berhasil","delete telah sukses !","success");
            redirect("index.php");
        }else{
            set_flashdata("Gagal","delete telah gagal !","success");
            redirect("index.php");
        }
    
    }
    