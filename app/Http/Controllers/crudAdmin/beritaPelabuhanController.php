<?php

namespace App\Http\Controllers\crudAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use SoftDeletes;

class beritaPelabuhanController extends Controller
{
    //View Berita
    public function index(){
        $berita=\App\beritaPelabuhan::all();
        return view('pageAdminSpeedboat.beritaPelabuhanAdmin', compact('berita'));
    }

    //Form Berita
    public function create(){
        $pelabuhans=\App\Pelabuhan::all();
        return view('CrudAdmin.createBeritaPelabuhan', compact('pelabuhans'));
    }

    //Create Berita
    public function addBerita(Request $request){
        $IdUser=Auth::user()->id;
        $beritas = new \App\beritaPelabuhan();


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
        $beritas->berita = $detail;
        $beritas->judul = $request->judul;
        $beritas->tanggal = Carbon::now()->toDateTimeString();
        $beritas->id_user = $IdUser;
        $beritas->id_pelabuhan = $request->id_pelabuhan;
        $beritas->save();
        return redirect('/BeritaPelabuhan');
    }
    
    //edit Berita
    public function editBerita($id){
    	$Beritaa = \App\beritaPelabuhan::find($id);
        $pelabuhans=\App\Pelabuhan::all();
    	return view('CrudAdmin\editBeritaPelabuhan',compact('Beritaa','pelabuhans'));
    }

    //Update Berita
    public function updateBerita($id, Request $request){
        $IdUser=Auth::user()->id;
        $beritaPelabuhan = \App\beritaPelabuhan::find($id);


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
        $beritaPelabuhan->berita = $detail;
        $beritaPelabuhan->judul = $request->judul;
        $beritaPelabuhan->tanggal = Carbon::now()->toDateTimeString();
        $beritaPelabuhan->id_user = $IdUser;
        $beritaPelabuhan->id_pelabuhan = $request->id_pelabuhan;    
        $beritaPelabuhan->update();
        return redirect('/BeritaPelabuhan');
    }
  
    public function deleteBerita($id){
        $deleteItem = \App\beritaPelabuhan::find($id);
        $deleteItem->delete();
        return redirect('/BeritaPelabuhan')->with('success','Berita berhasil dihapus!');
    }
}
