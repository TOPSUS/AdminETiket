<?php

namespace App\Http\Controllers;

use App\detailJadwal;
use App\Golongan;
use App\Http\Controllers\Controller;
use App\Jadwal;
use App\Pembelian;
use Barryvdh\DomPDF\PDF;
use Carbon\Carbon;
use Faker\Provider\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
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
            $pembelian->status = 'terkonfirmasi';
            $pembelian->save();
            $data = \App\Pembelian::where('id', $id)->with('golongans', 'detailPembelian', 'jadwal', 'user')->where('status', 'terkonfirmasi')->first();
            //return view('pdf.myPDF',compact('data'));
            if ($data) {
                $pdf = \PDF::loadView('pdf.myPDF', compact('data'));
                $output = $pdf->output();
                $filename = time() . Str::random(5) . '.pdf';
                Storage::disk('admin')->put('/test_pdf/' . $filename, $output);
                $data->file_tiket = $filename;
                $data->save();

                $user = \App\User::find($data->id_user);
                if ($user->fcm_token != null) {
                    $notif = \App\UserNotification::create([
                        'user_id' => $user->id,
                        'title' => 'Pembayaran telah dikonfirmasi',
                        'body' => 'Pembayaran anda telah dikonfirmasi, silahkan melakukan pengecekan pada e-ticket.',
                        'notification_by' => 0,
                        'status' => 0,
                        'type' => 1,
                        'created_at' => date('Y-m-d H:i:s')
                    ]);
                    if ($notif) {
                        $ch = curl_init("https://fcm.googleapis.com/fcm/send");
                        $header = array("Content-Type:application/json", "Authorization: key=AAAAe4OwHhY:APA91bFoIIsUBcJ_OK26_PGnG6HK9JMEZ5D3BbxbR1BfNqOlbTdiAlawdHjlO8caYMl6QS5ok-1P4uV20MPHDZIBUl_JQ0umbjmyi7v5OHXihlA8OHsEjisA2mtlwtq7DRHUZr4C-VVK");
                        $data = json_encode(array("to" => $user->fcm_token, "priority" => 10, "data" => array("title" => "Pembayaran dikonfirmasi", "body" => "Pembayaran anda telah dikonfirmasi, silahkan melakukan pengecekan pada e-ticket.", "id" => $notif->id, "status" => $notif->status, "type" => $notif->type, "created_at" => date('Y-m-d H:i:s'), "notification_by" => $notif->notification_by)));
                        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
                        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                        curl_setopt($ch, CURLOPT_POST, 1);
                        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
                        curl_exec($ch);
                    }
                }

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
        $dataPelabuhan = \App\hakAksesPelabuhan::where('id_user', Auth::user()->id)->pluck('id_pelabuhan');
        $datajadwal = \App\Jadwal::whereIn('id_asal_pelabuhan', $dataPelabuhan)->pluck('id');
        $jadwal = \App\detailJadwal::whereIn('id_jadwal', $datajadwal)->with('relasiJadwal')->get();
        $pelabuhan = \App\Pelabuhan::all();

        $pelabuhanasal = \App\Pelabuhan::with('asal')->get();
        $pelabuhantujuan = \App\Pelabuhan::with('tujuan')->get();

        return view('PAdmin.createPembelian', compact('jadwal'));
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
            $detailJadwal = detailJadwal::where('id', $request->jadwal)->first();
            $hargaTiket = Jadwal::where('id',$detailJadwal->id_jadwal)->first();
            $total = $penumpang * $hargaTiket->harga + $hargaGolongan;
        }

        if ($request->golongan != 0) {
            $pembelian = \App\Pembelian::create([
                'id_user' => Auth::user()->id,
                'id_jadwal' => $request->jadwal,
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
                'id_jadwal' => $request->jadwal,
                'id_metode_pembayaran' => null,
                'id_golongan' => null,
                'nomor_polisi' => null,
                'tanggal' => Carbon::now(),
                'total_harga' => $total,
                'file_tiket' => null,
                'status' => 'terkonfirmasi',
            ]);
        }

        $ticketname = $request->input('name');
        $card = $request->input('card_id');
        $cardnumber = $request->input('card');
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
                    'nama_pemegang_tiket' => $name,
                    'no_id_card' => $cardnumber[$key],
                    'harga' => $hargaGolongan,
                    'status' => "Not Used",
                ]);
                $hargaGolongan = 0;
            } else {
                $detailPembelian = \App\detailPembelian::create([
                    'id_pembelian' => $pembelian->id,
                    'id_card' => $cardid->id,
                    'kode_tiket' => $kodeTiket,
                    'nama_pemegang_tiket' => $name,
                    'no_id_card' => $cardnumber[$key],
                    'harga' => $hargaTiket->harga,
                    'status' => "Not Used",
                ]);
            }
        }

        $data = \App\Pembelian::where('id', $pembelian->id)->with('golongans', 'detailPembelian', 'jadwal', 'user')->where('status', 'terkonfirmasi')->first();
        //return view('pdf.myPDF',compact('data'));
        if ($data) {
            $pdf = \PDF::loadView('pdf.myPDF', compact('data'));
            $output = $pdf->output();
            $filename = time() . Str::random(5) . '.pdf';
            Storage::disk('admin')->put('/test_pdf/' . $filename, $output);
            $data->file_tiket = $filename;
            $data->save();
            /*$fileName =  $data->tanggal. '.' . 'pdf' ;
            $pdf->save($path . '/' . $fileName);*/

            return redirect('/Transaksi')->with('success', 'Transaksi Berhasil');
        }
        return redirect('/Transaksi')->with('info', 'Terjadi kesalahan dalam pembuatan tiket');
    }

    public function kaka(){
        $card = \App\Card::pluck('card');
        foreach ($card as $cd) {
            $encoded[] = urlencode($cd);
        }
        return response()->json($encoded);
    }

    //AJAX GOLONGAN di Pembelian
    public function getGolongans($id)
    {
        $detailJadwal = \App\detailJadwal::where('id', $id)->first();
        $jadwal = \App\Jadwal::where('id', $detailJadwal->id_jadwal)->first();
        $kapal = \App\Kapal::where('id', $jadwal->id_kapal)->first();
        if ($kapal->tipe_kapal == 'feri') {
            $golongan = \App\Golongan::where('id_pelabuhan', $jadwal->id_asal_pelabuhan)->get();
            return response()->json($golongan);
        } else {
            return response()->json(['error' => 'Tidak terdapat golongan'], 404);
        }
    }

    public function eTicketGenerate($id_pembelian)
    {

        $data = \App\Pembelian::where('id', $id_pembelian)->with('golongans', 'detailPembelian', 'jadwal', 'user')->where('status', 'terkonfirmasi')->first();
        //return view('pdf.myPDF',compact('data'));
        if ($data) {
            $pdf = \PDF::loadView('pdf.myPDF', compact('data'));
            $output = $pdf->output();
            $filename = time() . Str::random(5) . '.pdf';
            Storage::disk('admin')->put('/test_pdf/' . $filename, $output);
            $data->file_tiket = $filename;
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
                if (Storage::disk('admin')->exists('/test_pdf/' . $data->file_tiket)) {
                    $file = response()->file(Storage::disk('admin')->path('/test_pdf/' . $data->file_tiket));
                    return $file;
                }
            }
            return back()->with('errors', 'File tiket tidak ada');
        }
        return back()->with('errors', 'Data tidak ditemukan');
    }
}
