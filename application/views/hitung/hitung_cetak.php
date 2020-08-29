<script src="<?= base_url('assets/js/highcharts.js') ?>"></script>
<script src="<?= base_url('assets/js/modules/exporting.js') ?>"></script>
<script src="<?= base_url('assets/js/modules/export-data.js ') ?>"></script>
<script src="<?= base_url('assets/js/modules/accessibility.js') ?>"></script>
<?php
function get_analisa($data)
{
    $arr = array();
    foreach ($data as $key => $val) {
        foreach ($val as $k => $v) {
            $arr[$k][$key] = $v;
        }
    }
    return $arr;
}
$dataset = array_values($dataset);
$analisa = get_analisa($dataset);
//echo '<pre>' . print_r($analisa, 1) . '</pre>';

foreach ($analisa as $id_atribut => $val_jenis) :
    $ftm = new FTM($val_jenis, $periode);
    //echo '<pre>' . print_r($ftm, 1) . '</pre>';
    $categories = array();
    $series = array();
?>
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title"><?= $atribut[$id_atribut]->nama_atribut ?></h3>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered table-hover table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Periode (t)</th>
                        <th>Yt</th>
                        <th>X</th>
                        <th>X*Y</th>
                        <th>X^2</th>
                        <th>Ft</th>
                        <th>Rata</th>
                        <th>Indeks Musim</th>
                        <th>Y*</th>
                        <th>e = F<sub>t</sub>-Y<sub>t</sub></th>
                        <th>|e|</th>
                        <th>e<sup>2</sup></th>
                        <th>e/Y<sub>t</sub></th>
                    </tr>
                </thead>
                <?php foreach ($val_jenis as $key => $val) :
                    $categories[$key] = $key;
                    $series['aktual']['data'][$key] = $val * 1;
                    $series['prediksi']['data'][$key] = round($ftm->fx[$key], 2);
                    $arr_series['aktual'][$id_atribut][$key] = round($ftm->y[$key], 2);
                    $arr_series['prediksi'][$id_atribut][$key] = round($ftm->fx[$key], 2); ?>
                    <tr>
                        <td><?= $key + 1 ?> <code><?= $names[$key] ?></code></td>
                        <td><?= number_format($val) ?></td>
                        <td><?= $ftm->x[$key] ?></td>
                        <td><?= number_format($ftm->xy[$key]) ?></td>
                        <td><?= number_format($ftm->x_kuadrat[$key]) ?></td>
                        <td><?= number_format($ftm->fx[$key], 2) ?></td>
                        <td><?= number_format($ftm->rata[$key % 12], 2) ?></td>
                        <td><?= number_format($ftm->indeks_musim[$key], 2) ?></td>
                        <td><?= number_format($ftm->y_star[$key], 2) ?></td>
                        <td><?= number_format($ftm->err[$key], 2) ?></td>
                        <td><?= number_format($ftm->err_abs[$key], 2) ?></td>
                        <td><?= number_format($ftm->err_square[$key], 2) ?></td>
                        <td><?= number_format($ftm->err_yt[$key], 2) ?></td>
                    </tr>
                <?php endforeach ?>
                <tfoot>
                    <tr>
                        <td>Total</td>
                        <td><?= number_format($ftm->z1) ?></td>
                        <td><?= $ftm->a2 ?></td>
                        <td><?= number_format($ftm->z2) ?></td>
                        <td><?= number_format($ftm->b2) ?></td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                </tfoot>
            </table>
        </div>
        <div class="panel-body">
            Formula = <?= number_format($ftm->a, 2) ?><?= $ftm->b < 0 ? ' - ' : ' + ' ?><?= number_format(abs($ftm->b), 2) ?>x <br />
            MSE = <?= number_format($ftm->errs['MSE'], 2) ?><br />
            RMSE = <?= number_format($ftm->errs['RMSE'], 2) ?><br />
            MAD = <?= number_format($ftm->errs['MAD'], 2) ?><br />
            MAPE = <?= round($ftm->errs['MAPE'] * 100, 2) ?>%<br />
        </div>
        <div class="table-responsive">
            <table class="table table-bordered table-hover table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Periode (t)</th>
                        <th>X</th>
                        <th>Fx</th>
                    </tr>
                </thead>
                <?php foreach ($ftm->next_fx as $key => $val) :
                    $series['aktual']['data'][$key] = null;
                    $series['prediksi']['data'][$key] = round($val, 2);
                    $arr_series['prediksi'][$id_atribut][$key] = round($val, 2);
                ?>
                    <tr>
                        <td><?= $key + 1 ?> <code><?= $names[$key] ?></code></td>
                        <td><?= $ftm->next_x[$key] ?></td>
                        <td><?= number_format($val, 2) ?></td>
                    </tr>
                <?php endforeach ?>
            </table>
        </div>
        <?php if ($chart) : ?>
            <div class="panel-body">
                <div id="container_<?= $id_atribut ?>"></div>
                <script>
                    <?php
                    $series['aktual']['name'] = 'Aktual';
                    $series['prediksi']['name'] = 'Prediksi';
                    $series['aktual']['data'] = array_values($series['aktual']['data']);
                    $series['prediksi']['data'] = array_values($series['prediksi']['data']);
                    $series = array_values($series);
                    ?>
                    Highcharts.chart('container_<?= $id_atribut ?>', {
                        chart: {
                            type: 'line'
                        },
                        title: {
                            text: 'Grafik Data dan Hasil Prediksi ' + '<?= $atribut[$id_atribut]->nama_atribut ?>'
                        },
                        // subtitle: {
                        //     text: 'Source: WorldClimate.com'
                        // },
                        xAxis: {
                            categories: <?= json_encode($names) ?>
                        },
                        yAxis: {
                            title: {
                                text: 'Total'
                            }
                        },
                        plotOptions: {
                            line: {
                                dataLabels: {
                                    enabled: true
                                },
                                enableMouseTracking: false
                            }
                        },
                        series: <?= json_encode($series) ?>
                    });
                </script>
            </div>
        <?php endif ?>
    </div>
<?php endforeach ?>
<?php if ($chart) : ?>
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">Grafik</h3>
        </div>
        <div class="panel-body">
            <?php
            $series = array();
            foreach ($arr_series['aktual'] as $key => $val) {
                $series[$key]['name'] = $atribut[$key]->nama_atribut;
                foreach ($val as $k => $v) {
                    $series[$key]['data'][] = $v;
                }
            }
            $categories = array_values($categories);
            $series = array_values($series);
            //echo '<pre>' . print_r($arr_series, 1) . '</pre>';
            ?>
            <div id="rekap_aktual"></div>
            <script>
                Highcharts.chart('rekap_aktual', {
                    chart: {
                        type: 'line'
                    },
                    title: {
                        text: 'Grafik Rekap Data Aktual'
                    },
                    // subtitle: {
                    //     text: 'Source: WorldClimate.com'
                    // },
                    xAxis: {
                        categories: <?= json_encode($categories) ?>
                    },
                    yAxis: {
                        title: {
                            text: 'Total'
                        }
                    },
                    plotOptions: {
                        line: {
                            dataLabels: {
                                enabled: true
                            },
                            enableMouseTracking: false
                        }
                    },
                    series: <?= json_encode($series) ?>
                });
            </script>
            <?php
            $series = array();
            foreach ($arr_series['prediksi'] as $key => $val) {
                $series[$key]['name'] = $atribut[$key]->nama_atribut;
                foreach ($val as $k => $v) {
                    $series[$key]['data'][] = $v;
                }
            }
            $categories = array_values($categories);
            $series = array_values($series);
            //echo '<pre>' . print_r($arr_series, 1) . '</pre>';
            ?>
            <div id="rekap_prediksi"></div>
            <script>
                Highcharts.chart('rekap_prediksi', {
                    chart: {
                        type: 'line'
                    },
                    title: {
                        text: 'Grafik Rekap Data Prediksi'
                    },
                    // subtitle: {
                    //     text: 'Source: WorldClimate.com'
                    // },
                    xAxis: {
                        categories: <?= json_encode($categories) ?>
                    },
                    yAxis: {
                        title: {
                            text: 'Total'
                        }
                    },
                    plotOptions: {
                        line: {
                            dataLabels: {
                                enabled: true
                            },
                            enableMouseTracking: false
                        }
                    },
                    series: <?= json_encode($series) ?>
                });
            </script>
        </div>
    </div>
<?php endif ?>