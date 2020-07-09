<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_super_admin extends CI_Model 
{
    //fungsi mendapatkan nilai login
	public function proseslogin($getuser, $getpass)
	{
		$this->db->where('username', $getuser);
		$this->db->where('password', $getpass);
		return $this->db->get('users')->row();
    }

    //START DOKTER --------------------------------------------------------------------------
    public function getDokter() //menampilkan data
    {
        return $this->db->get('dokter')->result();
    }

    public function insertDokter($getdokter) //menambah data
    {
        $this->db->insert('dokter', $getdokter);
        //return TRUE;
    }

    public function updateDokter($arraydokter) //mengubah data
    {
        $id = $arraydokter['id_dokter'];
        $nama = $arraydokter['nama_dokter'];
        $bidang = $arraydokter['bidang_dokter'];
        $foto = $arraydokter['foto_dokter'];

        $this->db->query("UPDATE dokter SET id_dokter = $id, nama_dokter = '$nama', bidang_dokter = '$bidang', foto_dokter = '$foto' WHERE id_dokter = $id");
    }

    public function deleteDokter($id_dokter) //menghapus data
    {
        return $this->db->delete('dokter', array('id_dokter' => $id_dokter));
    }
    //END DOKTER --------------------------------------------------------------------------
    
    //START PEGAWAI --------------------------------------------------------------------------
    public function getPegawai()
    {
        return $this->db->get('pegawai')->result();
    }

    public function insertPegawai($getpegawai)
    {
        $this->db->insert('pegawai', $getpegawai);
    }

    public function updatePegawai($arraypegawai) //mengubah data
    {
        $id = $arraypegawai['id_pegawai'];
        $nama = $arraypegawai['nama_pegawai'];
        $alamat = $arraypegawai['alamat_pegawai'];
        $foto = $arraypegawai['foto_pegawai'];

        $this->db->query("UPDATE pegawai SET id_pegawai = $id, nama_pegawai = '$nama', alamat_pegawai = '$alamat', foto_pegawai = '$foto' WHERE id_pegawai = $id");
    }
    
    public function deletePegawai($id_pegawai)
    {
        return $this->db->delete('pegawai', array('id_pegawai' => $id_pegawai));
    }
    //END PEGAWAI --------------------------------------------------------------------------

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


    //START POLI --------------------------------------------------------------------------
    public function getPoli()
    {
        $this->db->select('*');
        $this->db->from('poli');
        $this->db->join('dokter','poli.id_dokter=dokter.id_dokter');
        $query = $this->db->get();
        return $query->result();
    }

    public function insertPoli($getpoli)
    {
        $this->db->insert('poli', $getpoli);
    }

    public function updatePoli($arraypoli) //mengubah data
    {
        $id = $arraypoli['id_poli'];
        $nama = $arraypoli['nama_poli'];
        $alamat = $arraypoli['id_dokter'];

        $this->db->query("UPDATE poli SET id_poli = $id, nama_poli = '$nama', id_dokter = '$alamat' WHERE id_poli = $id");
    }
    
    public function deletePoli($id_poli)
    {
        return $this->db->delete('poli', array('id_poli' => $id_poli));
    }
    //END POLI --------------------------------------------------------------------------

    //START OBAT --------------------------------------------------------------------------
    public function getObat()
    {
        $this->db->select('*');
        $this->db->from('obat');
        $this->db->join('poli','obat.id_poli=poli.id_poli');
        $query = $this->db->get();
        return $query->result();
    }

    public function insertObat($getobat)
    {
        $this->db->insert('obat', $getobat);
    }

    public function updateObat($arrayobat) //mengubah data
    {
        $id = $arrayobat['id_obat'];
        $nama = $arrayobat['nama_obat'];
        $jenis = $arrayobat['jenis_obat'];
        $id_poli = $arrayobat['id_poli'];

        $this->db->query("UPDATE obat SET id_obat = $id, nama_obat = '$nama', jenis_obat = '$jenis', id_poli = '$id_poli' WHERE id_obat = $id");
    }
    
    public function deleteObat($id_obat)
    {
        return $this->db->delete('obat', array('id_obat' => $id_obat));
    }
    //END OBAT --------------------------------------------------------------------------


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
}
 