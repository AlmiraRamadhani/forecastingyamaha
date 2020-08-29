<div class="row">
    <div class="col-md-6">
        <form method="post" enctype="multipart/form-data">
            <?php
            if ($_POST) {
                $file = $_FILES['dataset'];
                if (pathinfo($file['name'], PATHINFO_EXTENSION) != 'csv') {
                    print_msg('File harus bertipe comma seperated value (*.csv)');
                } else {
                    $row = 0;
                    move_uploaded_file($file['tmp_name'], 'assets/upload/' . $file['name']) or die('Upload gagal');

                    $arr = array();

                    if (($handle = fopen('assets/upload/' . $file['name'], "r")) !== FALSE) {
                        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                            $num = count($data);

                            if ($row > 0) {
                                for ($c = 1; $c < $num; $c++) {
                                    $arr[$row][$c - 1] = $data[$c];
                                }
                            }
                            $row++;
                        }
                        fclose($handle);
                    }

                    function isi_key($dataset, $ATRIBUT)
                    {
                        get_atribut();
                        $keys = array_keys($ATRIBUT);
                        $arr = array();
                        foreach ($dataset as $key => $val) {
                            for ($a = 0; $a < count($val); $a++) {
                                $arr[$key][$keys[$a]] = strtolower($val[$a]);
                            }
                        }
                        //echo '<pre>'.print_r($arr, 1).'</pre>'; 
                        return $arr;
                    }

                    function convert_dataset($dataset, $atribut)
                    {
                        $arr = array();
                        $keys = array_keys($atribut);
                        foreach ($dataset as $key => $val) {
                            $date = date_create($val[0], timezone_open("Europe/Oslo"));
                            $arr[$key]['tanggal'] = date_format($date, "Y-m-d");
                            for ($a = 1; $a < count($val); $a++) {
                                $id_atribut = $keys[$a - 1];
                                $arr[$key]['data'][$id_atribut] = $val[$a];
                            }
                        }
                        //echo '<pre>'.print_r($arr, 1).'</pre>';   
                        return $arr;
                    }

                    $dataset = convert_dataset($arr, $atribut);

                    $this->db->query("TRUNCATE tb_dataset");
                    foreach ($dataset as $key => $val) {
                        foreach ($val['data'] as $k => $v) {
                            $this->db->query("INSERT INTO tb_dataset (nomor, tanggal, id_atribut, nilai)
                            VALUES ('$key', '$val[tanggal]', '$k', '$v')");
                        }
                    }
                    print_msg('Transaksi berhasil diimport!', 'success');
                }
            }
            ?>
            <div class="form-group">
                <label>Pilih file</label>
                <input class="form-control" type="file" name="dataset" />
            </div>
            <div class="form-group">
                <button class="btn btn-primary" name="import"><span class="glyphicon glyphicon-import"></span> Import</button>
                <a class="btn btn-danger" href="<?= site_url('dataset') ?>"><span class="glyphicon glyphicon-arrow-left"></span> Kembali</a>
            </div>
        </form>
    </div>
</div>