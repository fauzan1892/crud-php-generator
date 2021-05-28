
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <?php if(!empty(flashdata())){ echo flashdata(); }?>
                <a href="tambah.php" class="btn btn-primary" role="button">Add Users</a>
                <br><br>
                <div class="card">
                    <div class="header">
                        <h4 class="title">Daftar Users</h4>
                    </div>
                    <div style="border-top:1px solid #ddd;margin-top:12px;"></div>
                    <div class="content">
                        
        <div class="table-responsive">
            <table class="table table-striped" id="example1">
                <thead>
                    <tr>
                        <th>No</th>
            
                <th>Full Name</th>
                <th>Username</th>
                <th>Akses</th>
                <th>Active</th>
                <th>Created at</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                $no =1;
                $sql = "SELECT hak_akses.hak_akses, users.* FROM users LEFT JOIN hak_akses 
                        ON users.akses = hak_akses.id ORDER BY users.id DESC";
                $row = $connectdb->prepare($sql);
                $row->execute();
                $hasil = $row->fetchAll(PDO::FETCH_OBJ);
                foreach($hasil as $r){

            ?>
            <tr>
                <td><?= $no;?></td>
                <td><?=$r->name;?></td>      
                <td><?=$r->user;?></td>      
                <td><?=$r->hak_akses;?></td>      
                <td><?php if($r->active == '1'){ echo 'Y';}else{ echo 'N'; }?></td>      
                <td><?=$r->created_at;?></td>
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

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>