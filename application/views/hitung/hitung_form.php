<div class="row">
    <div class="col-sm-6">
        <?= print_error() ?>
        <form method="post">
            <div class="form-group">
                <label>Awal <span class="text-danger">*</span></label>
                <input class="form-control" type="date" name="awal" value="<?= set_value("awal", $awal) ?>" />
            </div>
            <div class="form-group">
                <label>Akhir <span class="text-danger">*</span></label>
                <input class="form-control" type="date" name="akhir" value="<?= set_value("akhir", $akhir) ?>" />
            </div>
            <div class="form-group">
                <label>Periode Peramalan<span class="text-danger">*</span></label>
                <input class="form-control" type="number" min="1" max="12" name="periode" value="<?= set_value("periode", 3) ?>" />
            </div>
            <div class="form-group">
                <button class="btn btn-primary"><span class="glyphicon glyphicon-signal"></span> Hitung</button>
            </div>
        </form>
    </div>
</div>