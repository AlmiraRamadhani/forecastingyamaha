<div class="row">
    <div class="col-sm-6">
        <?= print_error() ?>
        <script type="text/javascript">
	$(function(){
	  $("#datepicker").datepicker({
		 changeMonth : true,
                 changeYear : true
	  });
	});
</script>
        <form method="post">
            <div class="form-group">
                <label>Nomor <span class="text-danger">*</span></label>
                <input class="form-control" type="text" name="nomor" value="<?= set_value('nomor', $nomor) ?>" />
            </div>
            <div class="form-group">
                <div class="ui-widget">
                <label>Tanggal <span class="text-danger">*</span></label>
                <input class="form-control" type="date" name="tanggal" value="<?= set_value('tanggal', date('Y-m-d')) ?>" />
                </div>
            </div>
            <?php foreach ($atribut as $key => $val) : ?>
                <div class="form-group">
                    <label><?= $val->nama_atribut ?> <span class="text-danger">*</span></label>
                    <input class="form-control" type="number" min="1" name="nilai[<?= $key ?>]" value="<?= set_value("nilai[$key]") ?>" />
                </div>
            <?php endforeach ?>
            <div class="form-group">
                <button class="btn btn-primary"><span class="glyphicon glyphicon-save"></span> Simpan</button>
                <a class="btn btn-danger" href="<?= site_url('dataset') ?>"><span class="glyphicon glyphicon-arrow-left"></span> Kembali</a>
            </div>
        </form>
    </div>
</div>