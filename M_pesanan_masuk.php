<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_pesanan_masuk extends CI_Model
{
	public function pesanan()
	{
		// $this->db->select('*');
		// $this->db->from('tbl_transaksi');
		// $this->db->where('status_order=0');

		// $this->db->order_by('id_transaksi', 'asc');
		// return $this->db->get()->result();

		$this->db->select('*, tbl_makanan.nama_makanan as nama_menu');
		$this->db->from('tbl_transaksi');
		$this->db->join('tbl_makanan', 'tbl_makanan.id_makanan = tbl_transaksi.id_makanan', 'left');
		$this->db->join('tbl_detail_transaksi', 'tbl_detail_transaksi.id_detail_transaksi = tbl_transaksi.id_detail_transaksi', 'left');
		$this->db->where('status_order=0');
		$this->db->order_by('id_transaksi', 'asc');
		return $this->db->get()->result();
	}

	public function update_pesanan($data)
	{
		$this->db->where('id_transaksi', $data['id_transaksi']);
		$this->db->update('tbl_transaksi', $data);
	}

	public function pesanan_diproses()
	{
		$this->db->select('*');
		$this->db->from('tbl_transaksi');
		$this->db->where('status_order=1');
		$this->db->order_by('id_transaksi', 'asc');
		return $this->db->get()->result();
	}

	public function pesanan_dikirim()
	{
		$this->db->select('*');
		$this->db->from('tbl_transaksi');
		$this->db->where('status_order=2');
		$this->db->order_by('id_transaksi', 'asc');
		return $this->db->get()->result();
	}

	public function pesanan_selesai()
	{
		$this->db->select('*');
		$this->db->from('tbl_transaksi');
		$this->db->where('status_order=3');
		$this->db->order_by('id_transaksi', 'asc');
		return $this->db->get()->result();
	}
}
