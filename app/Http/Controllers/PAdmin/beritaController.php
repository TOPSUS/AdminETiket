<?php

namespace App\Http\Controllers\PAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class beritaController extends Controller
{
//View Berita Pelabuhan
    public function indexPelabuhan(){
        $dataBerita=\App\beritaPelabuhan::with('relasiPelabuhan')->get();
        $pelabuhan=\App\beritaPelabuhan::all();
        return view('PAdmin.beritaPelabuhan',compact('dataBerita'));
    }

//Form Create Pelabuhan
    public function createBeritaPelabuhan(){
        $dataPelabuhan=\App\Pelabuhan::all();
        return view('PAdmin.createBeritaPelabuhan', compact('dataPelabuhan'));
    }


//Create Berita Pelabuhan
    public function addBeritaPelabuhan(Request $request){

        $validator = Validator::make($request->all(), [
            'judul' => 'required',
            'berita' => 'required',
            'id_pelabuhan'=>'required|not_in:0',
            'file'=> 'required|file|image',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        if ($request->hasfile('file')) {
            $file = $request->file('file');
            $file_name = time() . "_" . $file->getClientOriginalName();
            $stored = Storage::disk('admin')->putFile('/image_berita_pelabuhan', $file);
        }

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
                $path = '/image/pages/pelabuhan/'.$request->judul.'/content/'. uniqid('', true) . '.' . $mimeType;
                Storage::disk('admin')->put($path, file_get_contents($src));
                $image->removeAttribute('src');
                $link = asset('storage'.$path);
                $image->setAttribute('src', $link);
                $image->removeAttribute('style');
                $image->setAttribute('class','img-fluid');
                //array_push($arrImage, $path);
            }
        }

        $detail = $dom->savehtml();
        $dataBerita->berita = $detail;
        $dataBerita->judul = $request->judul;
        $dataBerita->tanggal = Carbon::now()->toDateTimeString();
        if($stored){
            $dataBerita->foto = basename($stored);
        }
        $dataBerita->id_user = $IdUser;
        $dataBerita->id_pelabuhan = $request->id_pelabuhan;
        $dataBerita->save();
        return redirect('/AdminPelabuhan/BeritaPelabuhan');
    }

    public function editFormBeritaPelabuhan($id){
        $berita = \App\beritaPelabuhan::find($id);
        return view('Page.editBeritaPelabuhan',compact('berita'));
    }

    //Update Berita
    public function updateBeritaPelabuhan(Request $request){

        $validator = Validator::make($request->all(), [
            'judul' => 'required',
            'berita' => 'required',
            'file'=> 'required|file|image',
        ]);

        if ($validator->fails()) {
            return redirect('/AdminPelabuhan/BeritaPelabuhan/Create')
                ->withErrors($validator)
                ->withInput();
        }

        if ($request->hasfile('file')) {
            $file = $request->file('file');
            $file_name = time() . "_" . $file->getClientOriginalName();
            $stored = Storage::disk('admin')->putFile('/image_berita_pelabuhan', $file);
        }

        $IdUser=Auth::user()->id;
        $dataBerita = \App\beritaPelabuhan::find($request->id_berita);
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
                $path = '/image/pages/pelabuhan/'.$request->judul.'/content/'. uniqid('', true) . '.' . $mimeType;
                Storage::disk('admin')->put($path, file_get_contents($src));
                $image->removeAttribute('src');
                $link = asset('storage'.$path);
                $image->setAttribute('src', $link);
                $image->removeAttribute('style');
                $image->setAttribute('class','img-fluid');
                //array_push($arrImage, $path);
            }
        }

        $detail = $dom->savehtml();
        $dataBerita->berita = $detail;
        $dataBerita->judul = $request->judul;
        $dataBerita->tanggal = Carbon::now()->toDateTimeString();
        if($stored){
            $dataBerita->foto = basename($stored);
        }
        $dataBerita->id_user = $IdUser;
        $dataBerita->save();
        return redirect('/AdminPelabuhan/BeritaPelabuhan');
    }

//DeleteBerita Pelabuhan
    public function deleteBeritaPelabuhan($id){
        $deleteItem = \App\beritaPelabuhan::find($id);
        $deleteItem->delete();
        return redirect('/AdminPelabuhan/BeritaPelabuhan')->with('success','Berita berhasil dihapus!');
    }
//------------------------------------------------------------

}

