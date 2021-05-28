<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <?php if(!empty(flashdata())){ echo flashdata(); }?>
                <a href="tambah.php" class="btn btn-primary" role="button">Add Generator</a>
                <br><br>
                <div class="card">
                    <div class="header">
                        <h4 class="title">Menu List</h4>
                    </div>
                    <hr>
                    <div class="content">
                        <div class="table-responsive">
                            <table class="table table-striped" id="example1">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>name menu</th>
                                        <th>url</th>
                                        <th>redirect</th>
                                        <th>active</th>
                                        <th>akses</th>
                                        <th>created at</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $no =1;
                                        $sql = "SELECT * FROM menu ORDER BY id DESC";
                                        $row = $connectdb->prepare($sql);
                                        $row->execute();
                                        $hasil = $row->fetchAll(PDO::FETCH_OBJ);
                                        foreach($hasil as $r){
                                    ?>
                                    <tr>
                                        <td><?= $no;?></td>      
                                        <td><?=$r->name_menu;?></td>      
                                        <td><?=$r->url;?></td>      
                                        <td><?=$r->redirect;?></td>      
                                        <td><?=$r->active;?></td>       
                                        <td><?=$r->akses;?></td>   
                                        <td><?=$r->created_at;?></td>
                                        <td>
                                            <a href="<?= "edit.php?id=".$r->id;?>" 
                                                class="btn btn-success btn-sm" title="Edit">
                                                <i class="fa fa-edit"></i> 
                                            </a> 
                                            <?php if($r->id != '1' && $r->id != '9'){?>
                                            <a href="<?= "proses.php?aksi=delete&id=".$r->id;?>" 
                                                class="btn btn-danger btn-sm" 
                                                onclick="javascript:return confirm(`Data ingin dihapus ?`);" title="Delete">
                                                <i class="fa fa-times"></i> 
                                            </a>
                                            <?php }?>
                                        </td>
                                    </tr>
                                    <?php $no++; }?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>      
</div>