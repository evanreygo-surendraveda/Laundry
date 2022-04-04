<?php

namespace App\Http\Controllers;

use App\Member;
use App\Paket;
use App\Transaksi;
use App\User;
use App\Role;
use App\DetailTransaksi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDF;
/**use Maatwebsite\Excel\Facades\Excel;*/

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transaksis = Transaksi::all();
        $members = Member::orderBy('nama')->get();
        $users = User::all();
        return view('transaksi.list', compact('transaksis', 'members', 'users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $members = Member::orderBy('nama')->get();
        return view('transaksi.create', compact('members'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $request->validate([
            'id_member' => 'required|exists:members,id',
            'tgl' => 'required|date',
            'lama_pengerjaan' => 'required',
            'status' => 'required',
            'status_bayar' => 'required',
        ]);


        $tgl_transaksi = Carbon::createFromFormat('Y-m-d', $request->tgl);
        $batas_waktu = $tgl_transaksi->addDays($request->lama_pengerjaan);

        $transaksi = new Transaksi();

        $transaksi->id_member = $request->id_member;
        $transaksi->lama_pengerjaan = $request->lama_pengerjaan;
        $transaksi->tgl = $request->tgl;
        $transaksi->batas_waktu = $batas_waktu->format('Y-m-d');
        $transaksi->tgl_bayar = $request->status_bayar == 'dibayar' ? now() : null;
        $transaksi->status = $request->status;
        $transaksi->status_bayar = $request->status_bayar;
        $transaksi->id_user = Auth::id();

        $transaksi->save();

        return redirect()->route('transaksi.index')->with('message', 'Transaksi berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaksi $transaksi)
    {
        return view('transaksi.edit', compact('transaksi'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $transaksi = Transaksi::findOrFail($id);
        $request->validate([
            'status_bayar' => 'required',
        ]);

        $transaksi->tgl_bayar = $request->status_bayar == 'dibayar' ? now() : null;
        $transaksi->status_bayar = $request->status_bayar;

        $transaksi->save();

        return redirect()->route('transaksi.index')->with('message', 'Transaksi berhasil diperbarui');
    }

    public function edit_proses($id)
    {
        $transaksi = Transaksi::findOrFail($id);
        return view('transaksi.edit_proses', compact('transaksi'));
    }

    public function update_proses(Request $request, $id)
    {
        $transaksi = Transaksi::findOrFail($id);
        $request->validate([
            'status' => 'required'
        ]);

        $transaksi->status = $request->status;

        $transaksi->save();

        return redirect()->route('transaksi.index')->with('message', 'Transaksi berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $transaksi = Transaksi::findOrFail($id);
        $transaksi->delete();

        return redirect()->route('transaksi.index',)->with('message', 'Transaksi berhasli dihapus');
    }

    public function index_detail($id_transaksi)
    {
        $details = DetailTransaksi::where('id_transaksi', $id_transaksi)->get();
        $transaksis = Transaksi::where('id', $id_transaksi)->get();
        $pakets = Paket::all();
        $members = Member::orderBy('nama')->get();
        $users = User::all();
        return view('transaksi.detail', compact('details', 'transaksis', 'pakets', 'members' ,'users'));
    }

    public function create_detail()
    {
        $transaksis = Transaksi::all();
        $pakets = Paket::orderBy('jenis')->get();
        return view('transaksi.createdetail', compact('transaksis', 'pakets'));
    }

    public function store_detail(Request $request)
    {
        $request->validate([
            'id_transaksi' => 'required|exists:transaksis,id',
            'id_paket' => 'required|exists:pakets,id',
            'qty' => 'required',

        ]);

        $detailtransaksi = new DetailTransaksi();

        $detailtransaksi->id_transaksi = $request->id_transaksi; 
        $detailtransaksi->id_paket = $request->id_paket;

        $paket = Paket::where('id', $detailtransaksi->id_paket)->first();
        $harga = $paket->harga;

        $detailtransaksi->qty = $request->qty;
        $detailtransaksi->total = $detailtransaksi->qty * $harga;   

        $detailtransaksi->save();

        return redirect()->route('transaksi.index_detail', $request->id_transaksi)->with('message', 'Detail berhasil ditambahkan');
    }

    public function edit_detail($id)
    {
        $detailtransaksi = DetailTransaksi::findOrFail($id);
        $paket = Paket::all();
        return view('transaksi.editdetail', compact('detailtransaksi', 'paket'));
    }

    public function update_detail(Request $request, $id)
    {
        $detailtransaksi = DetailTransaksi::findorFail($id);
        $request->validate([
            'id_paket' => 'required|exists:pakets,id',
            'qty' => 'required',

        ]);

        $detailtransaksi->id_paket = $request->id_paket;
        $detailtransaksi->qty = $request->qty;

        $detailtransaksi->save();

        return redirect()->back()->with('message', 'Detail berhasil diperbarui');
    }

    public function destroy_detail($id)
    {

        $detailtransaksi = DetailTransaksi::findorFail($id);
        $detailtransaksi->delete();

        return redirect()->back()->with('message', 'Detail berhasli dihapus');
    }

    public function index_owner()
    {
        $transaksis = Transaksi::all();
        $members = Member::orderBy('nama')->get();
        $users = User::all();
        return view('transaksi.owner', compact('transaksis', 'members', 'users'));
    }

    public function index_detailowner($id_transaksi)
    {
        $details = DetailTransaksi::where('id_transaksi', $id_transaksi)->get();
        $transaksis = Transaksi::where('id', $id_transaksi)->get();
        $pakets = Paket::all();
        $members = Member::orderBy('nama')->get();
        $users = User::all();
        return view('transaksi.detail_owner', compact('details', 'transaksis', 'pakets', 'members' ,'users'));
    }

    public function export()
    {
    	$transaksis = Transaksi::all();
        $details = DetailTransaksi::all();
        
    	$pdf = PDF::loadview('transaksi.transaksi_pdf',['transaksis'=>$transaksis, 'details'=>$details]);
    	return $pdf->download('laporan-transaksi.pdf');
    }

    public function print($id_transaksi)
    {
        $details = DetailTransaksi::where('id_transaksi', $id_transaksi)->get();

        $pdf = PDF::loadview('transaksi.print', compact('details'))->setPaper('letter', 'potrait');
        return $pdf->stream('struk');
    }
    
}