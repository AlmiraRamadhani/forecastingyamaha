<div class="panel panel-default">
    <div class="panel-heading">
        <form class="form-inline">
            <div class="form-group">
                <input class="form-control" type="text" placeholder="Pencarian. . ." name="search" value="<?= $this->input->get('search') ?>" />
            </div>
            <div class="form-group">
                <button class="btn btn-success"><span class="glyphicon glyphicon-refresh"></span> Refresh</a>
            </div>
            <div class="form-group">
                <a class="btn btn-primary" href="<?= site_url('atribut/tambah') ?>"><span class="glyphicon glyphicon-plus"></span> Tambah</a>
            </div>
        </form>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered table-hover table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Barang</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <?php foreach ($rows as $row) : ?>
                <tr>
                    <td><?= $row->id_atribut ?></td>
                    <td><?= $row->nama_atribut ?></td>
                    <td>
                        <a class="btn btn-xs btn-warning" href="<?= site_url("atribut/ubah/$row->id_atribut") ?>"><span class="glyphicon glyphicon-edit"></span></a>
                        <a class="btn btn-xs btn-danger" href="<?= site_url("atribut/hapus/$row->id_atribut") ?>" onclick="return confirm('Hapus data?')"><span class="glyphicon glyphicon-trash"></span></a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</div>