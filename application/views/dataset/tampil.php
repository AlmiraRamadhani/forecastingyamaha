<div class="panel panel-default">
    <div class="panel-heading">
        <form class="form-inline">
            <div class="form-group hidden">
                <input class="form-control" type="text" placeholder="Pencarian. . ." name="search" value="<?= $this->input->get('search') ?>" />
            </div>
            <div class="form-group">
                <button class="btn btn-success"><span class="glyphicon glyphicon-refresh"></span> Refresh</a>
            </div>
            <div class="form-group">
                <a class="btn btn-primary" href="<?= site_url('dataset/tambah') ?>"><span class="glyphicon glyphicon-plus"></span> Tambah</a>
            </div>
            <!-- <div class="form-group">
                <a class="btn btn-info" href="<?= site_url('dataset/import') ?>"><span class="glyphicon glyphicon-import"></span> Import</a>
            </div> -->
        </form>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered table-hover table-striped datatable">
            <thead>
                <tr>
                    <th>Nomor</th>
                    <th>Periode</th>
                    <?php foreach ($ATRIBUT as $key => $val) : ?>
                        <th><?= $val->nama_atribut ?></th>
                    <?php endforeach ?>
                    <th>Aksi</th>
                </tr>
            </thead>
            <?php foreach ($dataset as $key => $val) : ?>
                <tr>
                    <td><?= $key ?></td>
                    <td><?= format_date($data[$key]['tanggal']) ?></td>
                    <?php foreach ($val as $k => $v) : ?>
                        <td><?= $v ?></td>
                    <?php endforeach ?>
                    <td class="nw">
                        <a class="btn btn-xs btn-warning" href="<?= site_url('dataset/ubah/' . $key) ?>"><span class="glyphicon glyphicon-edit"></span></a>
                        <a class="btn btn-xs btn-danger" href="<?= site_url('dataset/hapus/' . $key) ?>" onclick="return confirm('Hapus data?')"><span class="glyphicon glyphicon-trash"></span></a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</div>