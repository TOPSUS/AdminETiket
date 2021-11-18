<?php

namespace App\Http\Controllers\Crud;

use App\Http\Controllers\Controller;
use App\JumlahRefund;
use App\Pembelian;
use App\Refund;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class refundController extends Controller
{
    public function index()
    {
        $dataRefund = Refund::with('pembelian', 'user', 'persentase')->get();
        $persenan = JumlahRefund::find(JumlahRefund::max('id'));
        return view('Page.refundPageList', compact('dataRefund', 'persenan'));
    }

    public function persentase(Request $request)
    {
        if ($request->ajax()){
            $data = JumlahRefund::create([
                'persenan_refund'=>$request->persentase
            ]);
            if ($data){
                return response()->json($data, 200);
            } else {
                return response()->json(['message'=>'Gagal mengupdate persentase refund'], 500);
            }
        }
        return response()->json(['message'=>'Unauthorized'], 401);
    }

    public function terima($id)
    {
        $data = Refund::find($id);
        $data->status = 'dikonfirmasi';
        $data->id_sup_admin = Auth::id();
        $data->save();
        return redirect()->back()->with('success','Refund diterima');
    }

    public function tolak($id)
    {
        $data = Refund::find($id);
        $data->status = 'ditolak';
        $data->id_sup_admin = Auth::id();
        $dataPembelian = Pembelian::where('id',$data->id_pembelian)->first();
        $dataPembelian->status = 'terkonfirmasi';
        $dataPembelian->isrefund = '1';
        $dataPembelian->save();
        $data->save();
        return redirect()->back()->with('info','Refund ditolak');
    }
}
