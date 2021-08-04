<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Belanja extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_transaksi');
	}

	public function index()
	{
		if (empty($this->cart->contents())) {
			redirect('home');
		}
		$data = array(
			'title' => 'Keranjang Belanja',
			'isi' => 'v_belanja'
		);
		$this->load->view('layouts/v_wrapper_FE', $data, FALSE);
	}

	public function add()
	{
		$redirect_page = $this->input->post('redirect_page');
		$data = array(
			'id'      => $this->input->post('id'),
			'qty'     => $this->input->post('qty'),
			'price'   => $this->input->post('price'),
			'name'    => $this->input->post('name')
		);
		$this->cart->insert($data);
		redirect($redirect_page, 'refresh');
	}

	public function delete($rowid)
	{
		$this->cart->remove($rowid);
		redirect('belanja');
	}

	public function update()
	{
		$i = 1;
		foreach ($this->cart->contents() as $items) {
			$data = array(
				'rowid' => $items['rowid'],
				'qty'   => $this->input->post($i . '[qty]')
			);
			$this->cart->update($data);
			$i++;
		}
		$this->session->set_flashdata('pesan', 'Keranjang Berhasil Diperbarui');
		redirect('belanja');
	}

	public function clear()
	{
		$this->cart->destroy();
		redirect('belanja');
	}

	public function checkout()
	{
		// proteksi halaman
		$this->pelanggan_login->proteksi_halaman();
		$this->form_validation->set_rules('nama_penerima', 'Nama Penerima', 'required', array(
			'required' => '%s Harus Diisi!'
		));
		$this->form_validation->set_rules('no_hp', 'No Handphone', 'required', array(
			'required' => '%s Harus Diisi!'
		));
		$this->form_validation->set_rules('alamat', 'Alamat', 'required', array(
			'required' => '%s Harus Diisi!'
		));


		if ($this->form_validation->run() == FALSE) {
			$data = array(
				'title' => 'Checkout Belanja',
				'isi' => 'v_checkout'
			);
			$this->load->view('layouts/v_wrapper_FE', $data, FALSE);
		} else {
			// simpan ke tabel transaksi pada database
			$data = array(
				'id_pelanggan' => $this->session->userdata('id_pelanggan'),
				'no_transaksi' => $this->input->post('no_transaksi'),
				'tgl_transaksi' => date('Y-m-d'),
				'nama_penerima' => $this->input->post('nama_penerima'),
				'no_hp' => $this->input->post('no_hp'),
				'alamat' => $this->input->post('alamat'),
				// 'id_detail_transaksi' => $this->input->post('id_detail_transaksi'),
				'id_makanan' => $this->input->post('id_makanan'),
				'grand_total' => $this->input->post('grand_total'),
				'total_bayar' => $this->input->post('total_bayar'),
				'status_bayar' => '0',
				'status_order' => '0',
			);
			$this->m_transaksi->simpan_transaksi($data);
			// simpan ke tabel detail_transaksi pada database
			$i = 1;
			foreach ($this->cart->contents() as $items) {
				$data_rinci = array(
					'no_transaksi' => $this->input->post('no_transaksi'),
					'id_makanan' => $items['id'],
					'qty' => $this->input->post('qty' . $i++),
				);
				$this->m_transaksi->simpan_detail_transaksi($data_rinci);
			}
			// =====================================================//
			$this->session->set_flashdata('pesan', 'Pesanan Berhasil');
			$this->cart->destroy();
			redirect('pesanan_saya');
		}
	}
}
