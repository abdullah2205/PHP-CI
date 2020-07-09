<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_admin extends CI_Model 
{
    //START ABSEN PEGAWAI --------------------------------------------------------------------------
    public function getAbsenPegawai()
    {
        $this->db->select('*');
        $this->db->from('absen_pegawai');
        $this->db->join('pegawai','absen_pegawai.id_pegawai=pegawai.id_pegawai');
        $query = $this->db->get();
        return $query->result();
    }

    public function insertAbsenPegawai($getabsenpegawai)
    {
        $this->db->insert('absen_pegawai', $getabsenpegawai);
    }

    public function updateAbsenPegawai($arrayabsenpegawai) //mengubah data
    {
        $id = $arrayabsenpegawai['id_ap'];
        $tgl = $arrayabsenpegawai['tgl'];
        $id_pegawai = $arrayabsenpegawai['id_pegawai'];

        $this->db->query("UPDATE absen_pegawai SET id_ap = $id, tgl = '$tgl', id_pegawai = '$id_pegawai' WHERE id_ap = $id");
    }
    
    public function deleteAbsenPegawai($id_ap)
    {
        return $this->db->delete('absen_pegawai', array('id_ap' => $id_ap));
    }
    //END ABSEN PEGAWAI --------------------------------------------------------------------------


    //START PASIEN --------------------------------------------------------------------------
    public function getPasien()
    {
        $this->db->select('*');
        $this->db->from('pasien');
        $query = $this->db->get();
        return $query->result();
    }

    public function insertPasien($getpasien)
    {
        $this->db->insert('pasien', $getpasien);
    }

    public function updatePasien($arraypasien) //mengubah data
    {
        $id = $arraypasien['id_pasien'];
        $nama = $arraypasien['nama_pasien'];
        $alamat = $arraypasien['alamat_pasien'];
        $foto = $arraypasien['foto_pasien'];

        $this->db->query("UPDATE pasien SET id_pasien = $id, nama_pasien = '$nama', alamat_pasien = '$alamat', foto_pasien = '$foto' WHERE id_pasien = $id");
    }
    
    public function deletePasien($id_pasien)
    {
        return $this->db->delete('pasien', array('id_pasien' => $id_pasien));
    }
    //END PASIEN --------------------------------------------------------------------------

    //START DAFTAR POLI --------------------------------------------------------------------------
    public function getDaftarPoli()
    {
        $this->db->select('*');
        $this->db->from('daftar_poli');
        $this->db->join('pasien','daftar_poli.id_pasien=pasien.id_pasien');
        $this->db->join('poli','daftar_poli.id_poli=poli.id_poli');
        $query = $this->db->get();
        return $query->result();
    }

    public function insertDaftarPoli($getdaftarpoli)
    {
        $this->db->insert('daftar_poli', $getdaftarpoli);
    }

    public function updateDaftarPoli($arraydaftarpoli) //mengubah data
    {
        $id = $arraydaftarpoli['id_daftar'];
        $tgl = $arraydaftarpoli['tgl'];
        $id_pasien = $arraydaftarpoli['id_pasien'];
        $id_poli = $arraydaftarpoli['id_poli'];

        $this->db->query("UPDATE daftar_poli SET id_daftar = $id, tgl = '$tgl', id_pasien = '$id_pasien', id_poli = '$id_poli' WHERE id_daftar = $id");
    }
    
    public function deleteDaftarPoli($id_daftar)
    {
        return $this->db->delete('daftar_poli', array('id_daftar' => $id_daftar));
    }
    //END DAFTAR POLI --------------------------------------------------------------------------

    //START PASIEN DATANG --------------------------------------------------------------------------
    public function getPasienDatang()
    {
        $this->db->select('*');
        $this->db->from('pasien_datang');
        $this->db->join('pasien','pasien_datang.id_pasien=pasien.id_pasien');
        $query = $this->db->get();
        return $query->result();
    }

    public function insertPasienDatang($getpasiendatang)
    {
        $this->db->insert('pasien_datang', $getpasiendatang);
    }

    public function updatePasienDatang($arraypasiendatang) //mengubah data
    {
        $id = $arraypasiendatang['id_pd'];
        $tgl = $arraypasiendatang['tgl'];
        $id_pasien = $arraypasiendatang['id_pasien'];

        $this->db->query("UPDATE pasien_datang SET id_pd = $id, tgl = '$tgl', id_pasien = '$id_pasien' WHERE id_pd = $id");
    }
    
    public function deletePasienDatang($id_pd)
    {
        return $this->db->delete('pasien_datang', array('id_pd' => $id_pd));
    }
    //END PASIEN DATANG --------------------------------------------------------------------------

    public function getPoli()
    {
        return $this->db->get('poli')->result();
    }

    public function getPegawai()
    {
        return $this->db->get('pegawai')->result();
    }
}
 