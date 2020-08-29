<?php
ini_set('max_execution_time', 60 * 3);
ini_set('memory_limit', '128M');

function load_view($view, $data = array())
{
    $CI = &get_instance();
    $CI->load->view('header', $data);
    $CI->load->view($view, $data);
    $CI->load->view('footer', $data);
}

function load_view_cetak($view, $data = array())
{
    $CI = &get_instance();
    $CI->load->view('header_cetak', $data);
    $CI->load->view($view, $data);
    $CI->load->view('footer_cetak', $data);
}

function load_message($message = '', $type = 'danger')
{
    if ($type == 'danger') {
        $data['title'] = 'Error';
    } else {
        $data['title'] = 'Success';
    }

    $data['class'] = $type;
    $data['message'] = $message;

    load_view('message', $data);
}

function format_date($datetime, $format = 'd M Y')
{
    $date = date_create($datetime);
    return date_format($date, $format);
}

function get_level_option($selected = 0)
{
    $arr = array(
        'gudang' => 'Gudang',
        'pimpinan' => 'Pimpinan',
        'super' => 'Super',
    );
    $a = '';
    foreach ($arr as $key => $val) {
        if ($key == $selected)
            $a .= "<option value='$key' selected>$val</option>";
        else
            $a .= "<option value='$key'>$val</option>";
    }
    return $a;
}
function get_atribut_option($selected = '')
{
    $CI = &get_instance();
    $rows = $CI->atribut_model->tampil();

    $a = '';
    foreach ($rows as $row) {
        if ($selected == $row->id_atribut)
            $a .= "<option value='$row->id_atribut' selected>$row->nama_atribut</option>";
        else
            $a .= "<option value='$row->id_atribut'>$row->nama_atribut</option>";
    }
    return $a;
}

function get_results($sql)
{
    $CI = &get_instance();
    return $CI->db->query($sql)->result();
}

function get_row($sql)
{
    $CI = &get_instance();
    return $CI->db->query($sql)->row();
}

function get_var($sql)
{
    $CI = &get_instance();
    $row = $CI->db->query($sql)->row_array();
    if ($row)
        return current($row);
}

function if_null($value, $default)
{
    if (isset($value) && $value)
        return $value;
    return $default;
}

function get_data($search)
{
    $CI = &get_instance();
    $rows = $CI->dataset_model->tampil($search);
    $dataset = array();
    foreach ($rows as $row) {
        $dataset[$row->nomor]['tanggal'] = $row->tanggal;
        $dataset[$row->nomor]['item'][$row->id_atribut] = $row->nilai;
    }
    return $dataset;
}
function get_data_testing($NILAI, $search)
{
    $CI = &get_instance();
    $rows = $CI->testing_model->tampil($search);
    $testing = array();
    foreach ($rows as $row) {
        $testing[$row->nomor]['nama'] = $row->nama;
        $testing[$row->nomor]['item'][$row->id_atribut] = isset($NILAI[$row->id_nilai]) ? $NILAI[$row->id_nilai]->nama_nilai : '';
    }
    return $testing;
}
function get_atribut()
{
    $CI = &get_instance();
    $rows = $CI->atribut_model->tampil();
    $arr = array();
    foreach ($rows as $row) {
        $arr[$row->id_atribut] = $row;
    }
    return $arr;
}
function get_dataset($awal = '', $akhir = '')
{
    $CI = &get_instance();
    $rows = $CI->dataset_model->tampil($awal, $akhir);
    $dataset = array();
    foreach ($rows as $row) {
        $dataset[$row->nomor][$row->id_atribut] = $row->nilai;
    }
    return $dataset;
}
function get_dataset_testing($NILAI, $search)
{
    $CI = &get_instance();
    $rows = $CI->testing_model->tampil($search);
    $dataset = array();
    foreach ($rows as $row) {
        $dataset[$row->nomor][$row->id_atribut] = isset($NILAI[$row->id_nilai]) ? $NILAI[$row->id_nilai]->nama_nilai : '';
    }
    return $dataset;
}
function get_testing_nilai($NILAI, $search)
{
    $CI = &get_instance();
    $rows = $CI->testing_model->tampil($search);
    $dataset = array();
    foreach ($rows as $row) {
        $dataset[$row->nomor][$row->id_atribut] = isset($NILAI[$row->id_nilai]) ? $NILAI[$row->id_nilai]->bobot_nilai : '';
    }
    return $dataset;
}

function print_error()
{
    return validation_errors('<div class="alert alert-danger" alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>', '</div>');
}

function print_msg($msg = '', $type = 'danger')
{
    echo '<div class="alert alert-' . $type . '" alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $msg . '</div>';
}

function kode_oto($field, $table, $prefix, $length)
{
    $CI = &get_instance();
    $query = $CI->db->query("SELECT $field AS kode FROM $table WHERE $field REGEXP '{$prefix}[0-9]{{$length}}' ORDER BY $field DESC");
    $row = $query->row_object();

    if ($row) {
        return $prefix . substr(str_repeat('0', $length) . (substr($row->kode, -$length) + 1), -$length);
    } else {
        return $prefix . str_repeat('0', $length - 1) . 1;
    }
}
