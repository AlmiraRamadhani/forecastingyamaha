<div class="row">
    <div class="col-sm-6">
        <?=print_error()?>
        <form method="post">
<!--             <div class="form-group">
                <label>Email <span class="text-danger">*</span></label>
                <input class="form-control" type="email" name="email" value="<?=set_value('email')?>"/>
            </div> -->
            <div class="form-group">
                <label>Username <span class="text-danger">*</span></label>
                <input class="form-control" type="text" name="user" value="<?=set_value('user')?>"/>
            </div>
            <div class="form-group">
                <label>Password <span class="text-danger">*</span></label>
                <input class="form-control" type="password" name="pass" value="<?=set_value('pass')?>"/>
            </div>
            <div class="form-group">
                <label>Nama Ibu <span class="text-danger">*</span></label>
                <input class="form-control" type="text" name="nama_ibu" value="<?=set_value('nama_ibu')?>"/>
            </div>
            <div class="form-group">
                <label>Level <span class="text-danger">*</span></label>
                <select class="form-control" name="level">
                    <?=get_level_option(set_value('level'))?>
                </select>
            </div>
            <div class="form-group">
                <button class="btn btn-primary"><span class="glyphicon glyphicon-save"></span> Simpan</button>
                <a class="btn btn-danger" href="<?=site_url('user')?>"><span class="glyphicon glyphicon-arrow-left"></span> Kembali</a>
            </div>            
        </form>
    </div>
</div>