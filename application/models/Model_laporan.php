<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_laporan extends CI_Model {
  function laporan($tglMulai,$tglSelesai){
    return $this->db->select('installasi.id as id, installasi.tgl_installasi as tgl_installasi, permintaan_installasi.nama as nama, 
                              permintaan_installasi.instansi as instansi, permintaan_installasi.alamat as alamat,permintaan_installasi.no_telp as no_telp,
                              user.fullname as teknisi, installasi.status as status')
                    ->from('installasi')
                    ->join('survei','survei.id = installasi.id_survei')
                    ->join('permintaan_installasi','permintaan_installasi.id = survei.id_permintaan')
                    ->join('user','user.id = installasi.id_user')
                    ->where('installasi.tgl_installasi >=', $tglMulai)
                    ->where('installasi.tgl_installasi <=', $tglSelesai)
                    ->get()->result_array();
  }
}