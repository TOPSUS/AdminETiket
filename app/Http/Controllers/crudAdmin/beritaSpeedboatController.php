<?php

namespace App\Http\Controllers\crudAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use SoftDeletes;

class beritaSpeedboatController extends Controller
{
    //View Berita
    public function index(){
        $IdAdmin=Auth::user()->id;
        $dataAdmin=\App\User::find($IdAdmin);
        $berita=\App\beritaSpeedboat::get();
        //where('id_user', $dataAdmin->id)->get();

        return view('pageAdminSpeedboat.beritaSpeedboatAdmin', compact('berita'));

    }

    //Form Berita
    public function create(){
        return view('CrudAdmin.createBeritaSpeedboat');
    }

    //Create Berita
    public function addBerita(Request $request){
        $IdUser=Auth::user()->id;
        $IdSpeedboat=\App\User::find(Auth::user()->id);
        $beritaspeedboat = new \App\beritaSpeedboat();


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
        $beritaspeedboat->berita = $detail;
        $beritaspeedboat->judul = $request->judul;
        $beritaspeedboat->tanggal = Carbon::now()->toDateTimeString();
        $beritaspeedboat->id_user = $IdUser;
        $beritaspeedboat->id_speedboat = $IdSpeedboat->id_speedboat;
        $beritaspeedboat->save();
        return redirect('/BeritaSpeedboat');
    }
    
    //edit Berita
    public function editBerita($id){
    	$Beritaa = \App\beritaSpeedboat::find($id);
    	return view('CrudAdmin\editBeritaSpeedboat',compact('Beritaa'));
    }

    //Update Berita
    public function updateBerita($id, Request $request){
        $IdUser=Auth::user()->id;
        $IdSpeedboat=\App\User::find(Auth::user()->id);
        $beritaspeedboat = \App\beritaSpeedboat::find($id);


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
        $beritaspeedboat->berita = $detail;
        $beritaspeedboat->judul = $request->judul;
        $beritaspeedboat->tanggal = Carbon::now()->toDateTimeString();
        $beritaspeedboat->id_user = $IdUser;
        $beritaspeedboat->id_speedboat = $IdSpeedboat->id_speedboat;    
        $beritaspeedboat->update();
        return redirect('/BeritaSpeedboat');
    }
  
    public function deleteBerita($id){
        $deleteItem = \App\beritaSpeedboat::find($id);
        $deleteItem->delete();
        return redirect('/BeritaSpeedboat')->with('success','Berita berhasil dihapus!');
    }
}