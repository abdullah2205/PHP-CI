<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_dokter extends CI_Model 
{
    //START ABSEN DOKTER --------------------------------------------------------------------------
    public function getAbsenDokter()
    {
        $this->db->select('*');
        $this->db->from('absen_dokter');
        $this->db->join('dokter','absen_dokter.id_dokter=dokter.id_dokter');
        $query = $this->db->get();
        return $query->result();
    }

    public function insertAbsenDokter($getabsendokter)
    {
        $this->db->insert('absen_dokter', $getabsendokter);
    }

    public function updateAbsenDokter($arrayabsendokter) //mengubah data
    {
        $id = $arrayabsendokter['id_ad'];
        $tgl = $arrayabsendokter['tgl'];
        $id_dokter = $arrayabsendokter['id_dokter'];

        $this->db->query("UPDATE absen_dokter SET id_ad = $id, tgl = '$tgl', id_dokter = '$id_dokter' WHERE id_ad = $id");
    }
    
    public function deleteAbsenDokter($id_ad)
    {
        return $this->db->delete('absen_dokter', array('id_ad' => $id_ad));
    }
    //END ABSEN DOKTER --------------------------------------------------------------------------

    //START ABSEN DOKTER --------------------------------------------------------------------------
    public function getPeriksa()
    {
        $this->db->select('*');
        $this->db->from('periksa');
        $this->db->join('dokter','periksa.id_dokter=dokter.id_dokter');
        $this->db->join('pasien','periksa.id_pasien=pasien.id_pasien');
        $query = $this->db->get();
        return $query->result();
    }

    public function insertPeriksa($getdataperiksa)
    {
        $this->db->insert('periksa', $getdataperiksa);
    }

    public function updatePeriksa($arraydataperiksa) //mengubah data
    {
        $id = $arraydataperiksa['id_periksa'];
        $id_dokter = $arraydataperiksa['id_dokter'];
        $id_pasien = $arraydataperiksa['id_pasien'];
        $kebutuhan = $arraydataperiksa['kebutuhan'];
        $solusi = $arraydataperiksa['solusi'];

        $this->db->query("UPDATE periksa SET id_periksa = $id, id_dokter = '$id_dokter', id_pasien = '$id_pasien', kebutuhan = '$kebutuhan', solusi = '$solusi' WHERE id_periksa = $id");
    }
    
    public function deleteDataPeriksa($id_periksa)
    {
        return $this->db->delete('periksa', array('id_periksa' => $id_periksa));
    }
    //END ABSEN DOKTER --------------------------------------------------------------------------

    public function getDokter() //menampilkan data dokter
    {
        return $this->db->get('dokter')->result();
    }

    public function getPasien() //menampilkan data pasien
    {
        return $this->db->get('pasien')->result();
    }
}
 