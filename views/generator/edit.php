<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <?php if(!empty(flashdata())){ echo flashdata(); }?>
                <div class="card">
                    <div class="header">
                        <h4 class="title">Crud Generator</h4>
                    </div>
                    <div style="border-top:1px solid #ddd;margin-top:12px;"></div>
                    <div class="content">
                        <form action="proses.php?aksi=update" method="post">
                            <?php
                                $id =  (int)$_GET["id"];
                                $sql = "SELECT * FROM menu WHERE id = ?";
                                $row = $connectdb->prepare($sql);
                                $row->execute(array($id));
                                $edit = $row->fetch(PDO::FETCH_OBJ);
                            ?>
                            <div class="form-group">
                                <label for="">Name menu</label>
                                <input type="text" class="form-control" value="<?= $edit->name_menu;?>" name="name_menu" id="name_menu" placeholder=""/>
                            </div>

                            <div class="form-group">
                                <label for="">Url</label>
                                <input type="text" readonly class="form-control" value="<?= $edit->url;?>" name="url" id="url" placeholder=""/>
                            </div>

                            <div class="form-group">
                                <label for="">Redirect</label>
                                <input type="text" class="form-control" value="<?= $edit->redirect;?>" name="redirect" id="redirect" placeholder=""/>
                            </div>

                            <div class="form-group">
                                <label for="">Active</label>
                                <select class="form-control" name="active">
                                    <option 
                                        value="Y" 
                                        <?php if($edit->active == 'Y'){ echo 'selected';}?>>
                                        Y
                                    </option>
                                    <option 
                                        value="N" 
                                        <?php if($edit->active == 'N'){ echo 'selected';}?>>
                                        N
                                    </option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="">Hak Akses</label>
                                <?php 
                                    $sql1   = "SELECT * FROM hak_akses";
                                    $row1   = $connectdb->prepare($sql1);
                                    $row1->execute();
                                    $hsl    = $row1->fetchAll(PDO::FETCH_OBJ);
                                    $n = 0;
                                    foreach($hsl as $r) {
                                        $akses = explode(',', $edit->akses);
                                        if($akses[$n] == null)
                                        {
                                            $ak = $edit->akses;
                                        }else{
                                            $ak = $akses[$n];
                                        }
                                ?>
                                    <br>
                                    <input type="checkbox" name="akses[]" value="<?= $r->id;?>"
                                        <?php if($r->id == $ak){ echo 'checked';}?>> <?= $r->hak_akses;?>

                                <?php $n++;}?>
                            </div>
                            <input type="hidden" class="form-control" value="<?= $edit->id;?>" name="id" placeholder=""/>
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