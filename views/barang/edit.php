
<?php
    $id =  (int)$_GET["id"];
    $sql = "SELECT * FROM barang WHERE id = ?";
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
                        <h4 class="title">Edit Barang</h4>
                    </div>
                    <div style="border-top:1px solid #ddd;margin-top:12px;"></div>
                    <div class="content">
                        <form action="proses.php?aksi=update" method="post">
                            
                <div class="form-group">
                    <label for="">Nama barang</label>
                    <input type="text" class="form-control" value="<?= $edit->nama_barang;?>" name="nama_barang" id="nama_barang" placeholder=""/>
                </div>
            
                <div class="form-group">
                    <label for="">Harga</label>
                    <input type="number" class="form-control" value="<?= $edit->harga;?>" name="harga" id="harga" placeholder=""/>
                </div>
            
                <div class="form-group">
                    <label for="">Jenis</label>
                    <input type="text" class="form-control" value="<?= $edit->jenis;?>" name="jenis" id="jenis" placeholder=""/>
                </div>
            
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
</div>