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
                <a class="btn btn-primary" href="<?=site_url('user/tambah')?>"><span class="glyphicon glyphicon-plus"></span> Tambah</a>
            </div>
        </form>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered table-hover table-striped">
        <thead>
            <tr>
                <th>No</th>
<!--                 <th>Email</th> -->
                <th>User</th>
                <th>Nama Ibu</th>
                <th>Level</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <?php    
        $no=0;
        foreach($rows as $row):?>
        <tr>
            <td><?=++$no ?></td>
            <!-- <td><?=$row->email?></td> -->
            <td><?=$row->user?></td>
            <td><?=$row->nama_ibu?></td>
            <td><?=$row->level?></td>
            <td>
                <a class="btn btn-xs btn-warning" href="<?=site_url("user/ubah/$row->id_user")?>"><span class="glyphicon glyphicon-edit"></span></a>
                <a class="btn btn-xs btn-danger" href="<?=site_url("user/hapus/$row->id_user")?>" onclick="return confirm('Hapus data?')"><span class="glyphicon glyphicon-trash"></span></a>
            </td>
        </tr>
        <?php endforeach;?>
        </table>
    </div>
</div>