<?php

namespace App\Http\Controllers\crudAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use SoftDeletes;

class beritaPelabuhanController extends Controller
{
    //View Berita
    public function index(){
        $berita=\App\beritaPelabuhan::with('relasiPelabuhan')->orderBy('created_at','desc')->get();
        $pelabuhan=\App\beritaPelabuhan::all();
        return view('pageAdminSpeedboat.beritaPelabuhanAdmin', compact('berita'));
    }

    //Form Berita
    public function create(){
        $pelabuhans=\App\Pelabuhan::all();
        return view('CrudAdmin.createBeritaPelabuhan', compact('pelabuhans'));
    }

    //Create Berita
    public function addBerita(Request $request){

        $validator = Validator::make($request->all(), [
            'judul' => 'required',
            'berita' => 'required',
            'id_pelabuhan'=>'required|not_in:0',
            'file'=>'required|file|image',
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
        $beritas->berita = $detail;
        $beritas->judul = $request->judul;
        $beritas->tanggal = Carbon::now()->toDateTimeString();
        if($request->hasFile()){
            if($stored){
                $beritas->foto = basename($stored);
            }
        }
        $beritas->id_user = $IdUser;
        $beritas->id_pelabuhan = $request->id_pelabuhan;
        $beritas->save();
        return redirect('/BeritaPelabuhan')->with('success','Berita berhasil ditambahkan!');
    }

    //edit Berita
    public function editBerita($id){
    	$Beritaa = \App\beritaPelabuhan::find($id);
        $pelabuhans=\App\Pelabuhan::all();
    	return view('CrudAdmin.editBeritaPelabuhan',compact('Beritaa','pelabuhans'));
    }

    //Update Berita
    public function updateBerita($id, Request $request){

        $validator = Validator::make($request->all(), [
            'judul' => 'required',
            'berita' => 'required',
            'id_pelabuhan'=>'required|not_in:0',
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
        $beritaPelabuhan->berita = $detail;
        $beritaPelabuhan->judul = $request->judul;
        $beritaPelabuhan->tanggal = Carbon::now()->toDateTimeString();
        if($request->hasFile()){
            if($stored){
                $beritaPelabuhan->foto = basename($stored);
            }
        }
        $beritaPelabuhan->id_user = $IdUser;
        $beritaPelabuhan->id_pelabuhan = $request->id_pelabuhan;
        $beritaPelabuhan->update();
        return redirect('/BeritaPelabuhan')->with('success','Berita berhasil update!');
    }

    public function deleteBerita($id){
        $deleteItem = \App\beritaPelabuhan::find($id);
        $deleteItem->delete();
        return redirect('/BeritaPelabuhan')->with('info','Berita berhasil dihapus!');
    }
}
