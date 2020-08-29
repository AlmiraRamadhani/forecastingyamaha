<div class="row">
    <div class="col-sm-6">
        <?= print_error() ?>
        <form method="post">
            <div class="form-group">
                <label>Nomor <span class="text-danger">*</span></label>
                <input class="form-control" type="text" name="nomor" value="<?= $rows[0]->nomor ?>" readonly="" />
            </div>
            <div class="form-group">
                <label>Tanggal <span class="text-danger">*</span></label>
                <input class="form-control" type="date" name="tanggal" value="<?= set_value('tanggal', $rows[0]->tanggal) ?>" />
            </div>
            <?php foreach ($rows as $row) : ?>
                <div class="form-group">
                    <label><?= $atribut[$row->id_atribut]->nama_atribut ?> <span class="text-danger">*</span></label>
                    <input class="form-control" type="text" name="nilai[<?= $row->id_dataset ?>]" value="<?= set_value("nilai[$row->id_dataset]", $row->nilai) ?>" />
                </div>
            <?php endforeach ?>
            <div class="form-group">
                <button class="btn btn-primary"><span class="glyphicon glyphicon-save"></span> Simpan</button>
                <a class="btn btn-danger" href="<?= site_url('dataset') ?>"><span class="glyphicon glyphicon-arrow-left"></span> Kembali</a>
            </div>
        </form>
    </div>
</div>