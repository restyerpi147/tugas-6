<?php 


namespace App\Http\Controllers;
use App\Models\Makanan;

/**
 * 
 */
class MakananController extends Controller
{
	
	function index()
	{
		$data['list_makanan'] = Makanan::all();
		return view('admin/makanan/index', $data);
	}
	
	function create()
	{
		return view('admin/makanan/create');
	}
	
	function store()
	{
		$makanan = new Makanan;
		$makanan->nama = request('nama');
		$makanan->harga = request('harga');
		$makanan->kategori = request('kategori');
		$makanan->deskripsi = request('deskripsi');
		$makanan->save();

		return redirect('admin/makanan')->with('success', 'Data Berhasil di Tambahkan');
	}
	
	function show(Makanan $makanan)
	{
		$data['makanan'] = $makanan;
		return view('admin/makanan/show', $data);
	}
	
	function edit(Makanan $makanan)
	{
		$data['makanan'] = $makanan;
		return view('admin/makanan/edit', $data);
		
	}
	
	function update(Makanan $makanan)
	{
		$makanan->nama = request('nama');
		$makanan->harga = request('harga');
		$makanan->kategori = request('kategori');
		$makanan->deskripsi = request('deskripsi');
		$makanan->save();

		return redirect('admin/makanan')->with('success', 'Data Berhasil di Update');
	}
	
	function destroy(Makanan $makanan)
	{
		$makanan->delete();

		return redirect('admin/makanan')->with('danger', 'Data Berhasil di Hapus');
	}
	function filter(){
		$nama = request('nama');
		$kategori = explode(",", request('kategori'));
		$data['harga_min'] = $harga_min = request('harga_min');
		$data['harga_max'] = $harga_max = request('harga_max');
		//$data['list_makanan'] = Makanan::where('nama_makanan', 'like' "%$nama_makanan%") -> get();
		//$data['list_makanan'] = Makanan::whereIn('kategori_makanan', $kategori_makanan)->get();
		//$data['list_makanan'] = Makanan::whereBetween('harga', [$harga_min, $harga_max])->get();
		//$data['list_makanan'] = Makanan::where('kategori_makanan', '<>', $kategori_makanan) -> get();
		//$data['list_makanan'] = Makanan::whereNotIn('kategori_makanan', $kategori_makanan)->get();
		

		$data['list_makanan'] = Makanan::where('nama','like', "%$nama%")->whereIn('kategori', $kategori)->whereYear('created_at', '2020')->whereBetween('harga', [$harga_min, $harga_max])->get();
		$data['nama'] = $nama;
		$data['kategori'] =  request('kategori');

		return view('admin/makanan/index', $data);
	}
}