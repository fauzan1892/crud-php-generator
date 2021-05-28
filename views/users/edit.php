
<?php
    $id =  (int)$_GET["id"];
    $sql = "SELECT * FROM users WHERE id = ?";
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
                        <h4 class="title">Edit Users</h4>
                    </div>
                    <div style="border-top:1px solid #ddd;margin-top:12px;"></div>
                    <div class="content">
                        <form action="proses.php?aksi=update" method="post">
                            
                <div class="form-group">
                                <label for="">Full Name</label>
                                <input type="text" class="form-control" value="<?= $edit->name;?>" name="name" id="name" placeholder=""/>
                            </div>
                        
                            <div class="form-group">
                                <label for="">Akses</label>
                                
                                <?php 
                                    $sql1   = "SELECT * FROM hak_akses";
                                    $row1   = $connectdb->prepare($sql1);
                                    $row1->execute();
                                    $hsl    = $row1->fetchAll(PDO::FETCH_OBJ);
                                    $n = 0;
                                    foreach($hsl as $r) {
                                ?>
                                    <br>
                                    <input type="radio" name="akses" value="<?= $r->id;?>"
                                        <?php if($r->id == $edit->akses){ echo 'checked';}?>> <?= $r->hak_akses;?>

                                <?php $n++;}?>
                            </div>
            
                            <div class="form-group">
                                <label for="">Active</label>
                                <select class="form-control" name="active">
                                    <option 
                                        value="Y" 
                                        <?php if($edit->active == '1'){ echo 'selected';}?>>
                                        Y
                                    </option>
                                    <option 
                                        value="N" 
                                        <?php if($edit->active == '0'){ echo 'selected';}?>>
                                        N
                                    </option>
                                </select>
                            </div>
                        
                            <div class="form-group">
                                <label for="">Username</label>
                                <input type="text" class="form-control" value="<?= $edit->user;?>" name="user" id="user" placeholder=""/>
                            </div>
                        
                            <div class="form-group">
                                <label for="">Password</label>
                                <input type="password" class="form-control" value="" name="pass" id="pass" placeholder=""/>
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