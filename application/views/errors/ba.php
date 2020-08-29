<div class="panel panel-default">
    <div class="panel-heading">        
        <form class="form-inline">
            <div class="form-group">
                <input class="form-control" type="text" placeholder="Pencarian. . ." name="search" value="<?=$this->input->get('search')?>" />
            </div>
            <div class="form-group">
                <button class="btn btn-success"><span class="glyphicon glyphicon-refresh"></span> Refresh</a>
            </div>
            <div class="form-group">
                <a class="btn btn-primary" href="<?=site_url('ba/tambah')?>"><span class="glyphicon glyphicon-plus"></span> Tambah</a>
            </div>
            <div class="form-group">
                <a class="btn btn-default" target="_blank" href="<?=site_url('ba/cetak?search=' . $this->input->get('search'))?>"><span class="glyphicon glyphicon-print"></span> Cetak</a>
            </div>
        </form>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered table-hover table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Toko</th>
                <th>Telpon</th>
                <th>Alamat</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <?php    
        $no = 1;
        foreach($rows as $row):?>
        <tr>
            <td><?=$no++?></td>
            <td><?=$row->nama_ba?></td>
            <td><?=$row->toko?></td>
            <td><?=$row->telpon?></td>
            <td><?=$row->alamat?></td>
            <td>
                <a class="btn btn-xs btn-warning" href="<?=site_url("ba/ubah/$row->id_ba")?>"><span class="glyphicon glyphicon-edit"></span></a>
                <a class="btn btn-xs btn-danger" href="<?=site_url("ba/hapus/$row->id_ba")?>" onclick="return confirm('Hapus data?')"><span class="glyphicon glyphicon-trash"></span></a>
            </td>
        </tr>
        <?php endforeach;?>
        </table>
    </div>
</div>