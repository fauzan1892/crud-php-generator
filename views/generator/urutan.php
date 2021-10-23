<style>
    body.dragging, body.dragging * {
        cursor: move !important;
    }

    .dragged {
        position: absolute;
        opacity: 0.5;
        z-index: 2000;
    }

    ul.list-unstyled li.placeholder {
        position: relative;
        /** More li styles **/
    }
    ul.list-unstyled li.placeholder:before {
        position: absolute;
        /** Define arrowhead **/
    }
</style>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <?php if(!empty(flashdata())){ echo flashdata(); }?>
                <a href="index.php" class="btn btn-danger" role="button">Back</a>
                <br><br>
                <div class="card">
                    <div class="header">
                        <h4 class="title">Urutan Menu</h4>
                    </div>
                    <hr>
                    <div class="content">
                        <ul id="sortable1" class="list-group list-unstyled">
                            <?php 
                                $sql = "SELECT * FROM menu ORDER BY urutan ASC";
                                $row = $connectdb->prepare($sql);
                                $row->execute();
                                $hasil = $row->fetchAll(PDO::FETCH_OBJ);
                                foreach($hasil as $r){
                            ?>
                            <li class="list-group-item" data-menu-id="<?= $r->id;?>">
                                <a href="javascript:void(0)" style="color:#326fa8;">
                                    <i class="fa fa-sort"> </i> <?= $r->name_menu;?>
                                </a>
                            </li>
                            <?php $no++; }?>
                        </ul>

                        <button type="button" id="saveOrderSubMenu" class="btn btn-primary float-right" onclick='saveOrder();'>
                            Save
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>      
</div>
<script>
    $("#sortable1").sortable();
    function saveOrder(){
        var menuorder="";
        $("#sortable1 li").each(function(i) {
            if (menuorder=='')
                menuorder = $(this).attr('data-menu-id');
            else
                menuorder += "," + $(this).attr('data-menu-id');
        });
        $.ajax({
            url  : 'proses.php?aksi=order',
            type : 'POST',
            data :{ "order": menuorder },
            dataType: "html",
            success : function(html) {
                alert('Sukses simpan !');window.location="";
            }
        });
    }
    console.log(menuorder);
</script>