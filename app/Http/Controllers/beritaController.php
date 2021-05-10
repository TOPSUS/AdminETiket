<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use SoftDeletes;

class beritaController extends Controller
{
//View Berita Pelabuhan
    public function indexPelabuhan(){
        $dataBerita=\App\beritaPelabuhan::with('relasiPelabuhan')->get();
        $pelabuhan=\App\beritaPelabuhan::all();
        return view('Page.beritaPelabuhan',compact('dataBerita'));
    }

//Form Create Pelabuhan
    public function createBeritaPelabuhan(){
        $dataPelabuhan=\App\Pelabuhan::all();
        return view('Page.createBeritaPelabuhan', compact('dataPelabuhan'));
    }


//Create Berita Pelabuhan
    public function addBeritaPelabuhan(Request $request){
        $IdUser=Auth::user()->id;
        $dataBerita = new \App\beritaPelabuhan();


        $detail = $request->berita;
        libxml_use_internal_errors(true);
        $dom = new \domdocument();
        $dom->loadHtml($detail, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        $images = $dom->getElementsByTagName('img');

        foreach ($images as $count => $image) {
            $src = $image->getAttribute('src');
            if (preg_match('/data:image/', $src)) {
                preg_match('/data:image\/(?<mime>.*?)\;/', $src, $groups);
                $mimeType = $groups['mime'];
                $path = '/image/pages/'.$request->judul.'/content/'. uniqid('', true) . '.' . $mimeType;
                Storage::disk('public')->put($path, file_get_contents($src));
                $image->removeAttribute('src');
                $link = asset('storage'.$path);
                $image->setAttribute('src', $link);
                //array_push($arrImage, $path);
            }
        }

        $detail = $dom->savehtml();
        $dataBerita->berita = $detail;
        $dataBerita->judul = $request->judul;
        $dataBerita->tanggal = Carbon::now()->toDateTimeString();
        $dataBerita->id_user = $IdUser;
        $dataBerita->id_pelabuhan = $request->id_pelabuhan;
        $dataBerita->save();
        return redirect('/Dashboard/BeritaPelabuhan');
    }

    public function editFormBeritaPelabuhan($id){
        $berita = \App\beritaPelabuhan::find($id);
        return view('Page.editBeritaPelabuhan',compact('berita'));
    }

    //Update Berita
    public function updateBeritaPelabuhan(Request $request){
        $IdUser=Auth::user()->id;
        $dataBerita = \App\beritaPelabuhan::find($request->id_berita)->first();
        $detail = $request->berita;
        libxml_use_internal_errors(true);
        $dom = new \domdocument();
        $dom->loadHtml($detail, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        $images = $dom->getElementsByTagName('img');

        foreach ($images as $count => $image) {
            $src = $image->getAttribute('src');
            if (preg_match('/data:image/', $src)) {
                preg_match('/data:image\/(?<mime>.*?)\;/', $src, $groups);
                $mimeType = $groups['mime'];
                $path = '/image/pages/'.$request->judul.'/content/'. uniqid('', true) . '.' . $mimeType;
                Storage::disk('public')->put($path, file_get_contents($src));
                $image->removeAttribute('src');
                $link = asset('storage'.$path);
                $image->setAttribute('src', $link);
                //array_push($arrImage, $path);
            }
        }

        $detail = $dom->savehtml();
        $dataBerita->berita = $detail;
        $dataBerita->judul = $request->judul;
        $dataBerita->tanggal = Carbon::now()->toDateTimeString();
        $dataBerita->id_user = $IdUser;
        $dataBerita->save();
        return redirect('/Dashboard/BeritaPelabuhan');
    }

//DeleteBerita Pelabuhan
    public function deleteBeritaPelabuhan($id){
        $deleteItem = \App\beritaPelabuhan::find($id);
        $deleteItem->delete();
        return redirect('/Dashboard/BeritaPelabuhan')->with('success','Berita berhasil dihapus!');
    }
//------------------------------------------------------------

//View Berita Speedboat
    public function indexSpeedboat(){
        $dataBeritaSpeedboat=\App\beritaKapal::with('relasiSpeedboat')->get();
        $beritaSpeedboat=\App\beritaKapal::all();
        return view('Page.beritaSpeedboat',compact('dataBeritaSpeedboat'));
    }

//Form Create Speedboat
    public function createBeritaSpeedboat(){
        $dataSpeedboat=\App\Kapal::all();
        return view('Page.createBeritaSpeedboat', compact('dataSpeedboat'));
    }

//Create Berita Speedboat
    public function addBeritaSpeedboat(Request $request){
        $IdUser=Auth::user()->id;
        $dataBerita = new \App\beritaKapal();


        $detail = $request->berita;
        libxml_use_internal_errors(true);
        $dom = new \domdocument();
        $dom->loadHtml($detail, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        $images = $dom->getElementsByTagName('img');

        foreach ($images as $count => $image) {
            $src = $image->getAttribute('src');
            if (preg_match('/data:image/', $src)) {
                preg_match('/data:image\/(?<mime>.*?)\;/', $src, $groups);
                $mimeType = $groups['mime'];
                $path = '/image/pages/'.$request->judul.'/content/'. uniqid('', true) . '.' . $mimeType;
                Storage::disk('public')->put($path, file_get_contents($src));
                $image->removeAttribute('src');
                $link = asset('storage'.$path);
                $image->setAttribute('src', $link);
                //array_push($arrImage, $path);
            }
        }

        $detail = $dom->savehtml();
        $dataBerita->berita = $detail;
        $dataBerita->judul = $request->judul;
        $dataBerita->tanggal = Carbon::now()->toDateTimeString();
        $dataBerita->id_user = $IdUser;
        $dataBerita->id_kapal = $request->id_kapal;
        $dataBerita->save();
        return redirect('/Dashboard/BeritaSpeedboat');
    }

    public function editFormBeritaSpeedboat($id){
        $berita = \App\beritaKapal::find($id);
        return view('Page.editBeritaSpeedboat',compact('berita'));
    }

    //Update Berita
    public function updateBeritaSpeedboat(Request $request){
        $IdUser=Auth::user()->id;
        $dataBerita = \App\beritaKapal::find($request->id_berita)->first();
        $detail = $request->berita;
        libxml_use_internal_errors(true);
        $dom = new \domdocument();
        $dom->loadHtml($detail, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        $images = $dom->getElementsByTagName('img');

        foreach ($images as $count => $image) {
            $src = $image->getAttribute('src');
            if (preg_match('/data:image/', $src)) {
                preg_match('/data:image\/(?<mime>.*?)\;/', $src, $groups);
                $mimeType = $groups['mime'];
                $path = '/image/pages/'.$request->judul.'/content/'. uniqid('', true) . '.' . $mimeType;
                Storage::disk('public')->put($path, file_get_contents($src));
                $image->removeAttribute('src');
                $link = asset('storage'.$path);
                $image->setAttribute('src', $link);
                //array_push($arrImage, $path);
            }
        }

        $detail = $dom->savehtml();
        $dataBerita->berita = $detail;
        $dataBerita->judul = $request->judul;
        $dataBerita->tanggal = Carbon::now()->toDateTimeString();
        $dataBerita->id_user = $IdUser;
        $dataBerita->save();
        return redirect('/Dashboard/BeritaSpeedboat');
    }

//DeleteBerita Pelabuhan
    public function deleteBeritaSpeedboat($id){
        $deleteItem = \App\beritaKapal::find($id);
        $deleteItem->delete();
        return redirect('/Dashboard/BeritaSpeedboat')->with('success','Berita berhasil dihapus!');
    }
}

