<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <?php if(!empty(flashdata())){ echo flashdata(); }?>
                <div class="card">
                    <div class="header">
                        <h4 class="title">Add Crud Generator</h4>
                    </div>
                    <div style="border-top:1px solid #ddd;margin-top:12px;"></div>
                    <div class="content">
                        <form action="proses.php?aksi=tambah" method="post">
                            <div class="form-group">
                                <label for="">Table Name</label>
                                <input type="text" required
                                    class="form-control" name="table" placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="">Menu Name</label>
                                <input type="text" required
                                    class="form-control" name="name_menu" placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="">Url</label>
                                <input type="text" required class="form-control" value="index.php" name="url" id="url" placeholder="">
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
                                ?>
                                    <br>
                                    <input type="checkbox" name="akses[]" 
                                        value="<?= $r->id;?>"> <?= $r->hak_akses;?>
                                <?php $n++;}?>
                            </div>
                            <div class="form-group">
                                <label for="">Active</label>
                                
                                <select class="form-control" name="active">
                                    <option value="Y">
                                        Y
                                    </option>
                                    <option value="N">
                                        N
                                    </option>
                                </select>
                            </div>
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