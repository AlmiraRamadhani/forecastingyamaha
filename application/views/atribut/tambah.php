<div class="row">
    <div class="col-sm-6">
        <?= print_error() ?>
        <form method="post">
            <div class="form-group">
                <label>ID barang <span class="text-danger">*</span></label>
                <input class="form-control" type="text" name="id_atribut" value="<?= set_value('id_atribut', kode_oto('id_atribut', 'tb_atribut', 'A', 2)) ?>" />
            </div>
            <div class="form-group">
                <label>Nama Barang <span class="text-danger">*</span></label>
                <input class="form-control" type="text" name="nama_atribut" value="<?= set_value('nama_atribut') ?>" />
            </div>
            <div class="form-group">
                <button class="btn btn-primary"><span class="glyphicon glyphicon-save"></span> Simpan</button>
                <a class="btn btn-danger" href="<?= site_url('atribut') ?>"><span class="glyphicon glyphicon-arrow-left"></span> Kembali</a>
            </div>
        </form>
    </div>
</div>