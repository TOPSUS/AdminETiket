<?php

namespace App\Http\Controllers;

use App\Golongan;
use App\Http\Controllers\Controller;
use App\Jadwal;
use App\Pembelian;
use Barryvdh\DomPDF\PDF;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class pembelianController extends Controller
{
    //
    public function index()
    {
        $dataPembelian = \App\Pembelian::with('user', 'jadwal')->get();
        return view('Page.approvePembelianView', compact('dataPembelian'));
    }

    //View Detail
    public function detail($id)
    {
        $dataPembelian = \App\Pembelian::with('user', 'jadwal', 'detailPembelian')->where('id', $id)->first();
        $detailPembelian = \App\detailPembelian::where('id_pembelian', $dataPembelian->id)->get();
        $jumlah = 0;
        foreach ($detailPembelian as $dp) {
            $jumlah = $jumlah + $dp->harga;
        }
        return view('Page.detailPembelian', compact('dataPembelian', 'jumlah'));

    }

//Update Status
    //approve
    public function approve($id)
    {
        $pembelian = \App\Pembelian::where('id', $id)->first();
        if ($pembelian) {
            $pembelian->status = 'Terkonfirmasi';
            $pembelian->save();
            $data = \App\Pembelian::where('id', $id)->with('golongans', 'detailPembelian', 'jadwal', 'user')->where('status', 'terkonfirmasi')->first();
            //return view('pdf.myPDF',compact('data'));
            if ($data) {
                $pdf = \PDF::loadView('pdf.myPDF', compact('data'));
                $output = $pdf->output();
                $filename = Str::random($data->id);
                file_put_contents($filename . '.pdf', $output);
                /*$fileName =  $data->tanggal. '.' . 'pdf' ;
                $pdf->save($path . '/' . $fileName);*/

                return redirect()->back();
            }
        }


        return redirect('Dashboard/CRUD/Pembelian');
    }

    //reject
    public function reject($id)
    {
        $pembelian = \App\Pembelian::where('id', $id)->first();
        $pembelian->status = 'Dibatalkan';
        $pembelian->save();

        return redirect('Dashboard/Pembelian');
    }

    //pembelian
    public function create()
    {
        $IdAdmin = Auth::user()->id;
        $dataAdmin = \App\User::find($IdAdmin);
        $hakAkses = \App\hakAksesKapal::where('id_user', $IdAdmin)->pluck('id_kapal');
        $jadwal = \App\Jadwal::whereIn('id_kapal', $hakAkses)->with('asal', 'tujuan', 'kapal')->get();
        $pelabuhan = \App\Pelabuhan::all();

        $pelabuhanasal = \App\Pelabuhan::with('asal')->get();
        $pelabuhantujuan = \App\Pelabuhan::with('tujuan')->get();

        return view('CrudAdmin.createPembelian', compact('jadwal'));
    }

    public function beli(Request $request)
    {
        $penumpang = count($request->input('name'));
        $hargaGolongan = 0;
        if ($request->golongan != 0) {
            $penumpang = $penumpang - 1;
            $golongan = Golongan::where('id', $request->golongan)->first();
            $hargaGolongan = $golongan->harga;
        }

        if ($request->jadwal) {
            $hargaTiket = Jadwal::where('id', $request->jadwal)->first();
            $total = $penumpang * $hargaTiket->harga + $hargaGolongan;
        }

        if ($request->golongan != 0) {
            $pembelian = \App\Pembelian::create([
                'id_user' => Auth::user()->id,
                'id_jadwal'=>$request->jadwal,
                'id_metode_pembayaran' => null,
                'id_golongan' => $request->golongan,
                'nomor_polisi' => $request->nomor_polisi,
                'tanggal' => Carbon::now(),
                'total_harga' => $total,
                'file_tiket' => null,
                'status' => 'terkonfirmasi',
            ]);
        } else {
            $pembelian = \App\Pembelian::create([
                'id_user' => Auth::user()->id,
                'id_jadwal'=>$request->jadwal,
                'id_metode_pembayaran' => null,
                'id_golongan' => null,
                'nomor_polisi' => null,
                'tanggal' => Carbon::now(),
                'total_harga' => $total,
                'file_tiket' => null,
                'status' => 'terkonfirmasi',
            ]);
        }

        $ticketname[] = $request->input('name');
        $card[] = $request->input('card_id');
        $cardnumber[] = $request->input('card');
        foreach ($ticketname as $key => $name) {
            //dikarenakan value card di blade itu diencode yang menyebabkan <space> menjadi +, maka dirubah tanda + menjadi space untuk keperluan pencarian id card
            $cardName = str_replace('+', ' ', $card[$key]);
            $cardid = \App\Card::where('card', $cardName)->first();
            //mengambil kode tiket terakhir
            $lastPembelian = \App\detailPembelian::all()->last();
            //merubah kode tiket menjadi int
            $intKodeTiket = (int)$lastPembelian->kode_tiket;
            //menambah 1 pada kode tiket int
            $addOnce = $intKodeTiket + 1;
            //merubah kode tiket menjadi string
            $kodeTiket = (string)$addOnce;

            //kalau request->golongan==0 maka harga golongan = 0, jika seseorang memesan tiket dengan kendaraan, maka harga kendaraan yang paling dahulu dicatat, penumpang selanjutnya harga tiket
            if ($hargaGolongan != 0) {
                $detailPembelian = \App\detailPembelian::create([
                    'id_pembelian' => $pembelian->id,
                    'id_card' => $cardid->id,
                    'kode_tiket' => $kodeTiket,
                    'nama_pemegang_tiket' => implode("",$name),
                    'no_id_card' => implode("",$cardnumber[$key]),
                    'harga' => $hargaGolongan,
                    'status' => "Not Used",
                ]);
                $hargaGolongan = 0;
            } else {
                $detailPembelian = \App\detailPembelian::create([
                    'id_pembelian' => $pembelian->id,
                    'id_card' => $cardid->id,
                    'kode_tiket' => $kodeTiket,
                    'nama_pemegang_tiket' => implode("",$name),
                    'no_id_card' => implode("",$cardnumber[$key]),
                    'harga' => $hargaTiket->harga,
                    'status' => "Not Used",
                ]);
            }
        }
        return redirect('/Transaksi');
    }

    public function idCard()
    {
        $card = \App\Card::pluck('card');
        foreach ($card as $cd) {
            $encoded[] = urlencode($cd);
        }
        return response()->json($encoded);
    }

    public function getGolongan($id)
    {
        $pelabuhan = \App\Jadwal::where('id', $id)->first();
        $kapal = \App\Kapal::where('id',$pelabuhan->id_kapal)->first();
        if($kapal->tipe_kapal = 'feri'){
            $golongan = \App\Golongan::where('id_pelabuhan', $pelabuhan->id_asal_pelabuhan)->get();
            return response()->json($golongan);
        } else {
            return response()->json(['error'=>'Tidak terdapat golongan'],404);
        }
    }

    public function eTicketGenerate($id_pembelian)
    {

        $data = \App\Pembelian::where('id', $id_pembelian)->with('golongans', 'detailPembelian', 'jadwal', 'user')->where('status', 'terkonfirmasi')->first();
        //return view('pdf.myPDF',compact('data'));
        if ($data) {
            $pdf = \PDF::loadView('pdf.myPDF', compact('data'));
            $output = $pdf->output();
            $filename = Str::random($data->id);
            file_put_contents($filename . '.pdf', $output);
            $data->file_tiket = $filename.'.pdf';
            $data->save();
            /*$fileName =  $data->tanggal. '.' . 'pdf' ;
            $pdf->save($path . '/' . $fileName);*/
            return redirect()->back();
        }

        /*$data = tb_detail_pembelian::where('id_detail_pembelian',1)->first();
        $pdf = \PDF::loadView('pdf.myPDF',$data);

        return $pdf->save('mypdf.pdf')->download('laporan-pdf.pdf');*/
    }

    public function etickets($id_pembelian)
    {

        $data = \App\Pembelian::where('id', $id_pembelian)->first();
        //return view('pdf.myPDF',compact('data'));
        if ($data) {
            if ($data->file_tiket) {
                return response()->file($data->file_tiket);
            }
        }

        /*$data = tb_detail_pembelian::where('id_detail_pembelian',1)->first();
        $pdf = \PDF::loadView('pdf.myPDF',$data);

        return $pdf->save('mypdf.pdf')->download('laporan-pdf.pdf');*/
    }
}
