<?php

namespace App\Http\Controllers\crudAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use SoftDeletes;

class beritaSpeedboatController extends Controller
{
    //View Berita
    public function index(){
        $IdAdmin=Auth::user()->id;
        $dataAdmin=\App\User::find($IdAdmin);
        $hakAkses=\App\hakAksesKapal::where('id_user', $IdAdmin)->pluck('id_kapal');

        $berita=\App\beritaKapal::orderBy('created_at','desc')->whereIn('id_kapal', $hakAkses)->get();

        return view('pageAdminSpeedboat.beritaSpeedboatAdmin', compact('berita'));

    }

    //Form Berita
    public function create(){
        $akses = \App\hakAksesKapal::where('id_user',Auth::user()->id)->pluck('id_kapal');
        $kapal = \App\Kapal::whereIn('id',$akses)->get();
        return view('CrudAdmin.createBeritaSpeedboat',compact('kapal'));
    }

    //Create Berita
    public function addBerita(Request $request){

        $validator = Validator::make($request->all(), [
            'judul' => 'required',
            'berita' => 'required',
            'id_kapal'=>'required|not_in:0',
            'file'=> 'required|file|image',
        ]);

        if ($validator->fails()){
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        if ($request->hasfile('file')) {
            $file = $request->file('file');
            $file_name = time() . "_" . $file->getClientOriginalName();
            $stored = Storage::disk('admin')->putFile('/image_berita_espeed', $file);
        }

        $IdUser=Auth::user()->id;
        $IdSpeedboat=\App\User::find(Auth::user()->id);
        $beritaspeedboat = new \App\beritaKapal();


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
                $path = '/image/pages/kapal/'.$request->judul.'/content/'. uniqid('', true) . '.' . $mimeType;
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
        $beritaspeedboat->berita = $detail;
        $beritaspeedboat->judul = $request->judul;
        $beritaspeedboat->tanggal = Carbon::now()->toDateTimeString();
        if($stored){
            $beritaspeedboat->foto = basename($stored);
        }
        $beritaspeedboat->id_user = $IdUser;
        $beritaspeedboat->id_kapal =$request->id_kapal;
        $beritaspeedboat->save();
        return redirect('/BeritaSpeedboat')->with('success','Berita berhasil Ditambahkan!');
    }

    //edit Berita
    public function editBerita($id){
    	$Beritaas = \App\beritaKapal::find($id);
    	return view('CrudAdmin.editBeritaSpeedboat',compact('Beritaas'));
    }

    //Update Berita
    public function updateBeritas($id, Request $request){

        $validator = Validator::make($request->all(), [
            'judul' => 'required',
            'berita' => 'required',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }


        if ($request->hasfile('file')) {
            $file = $request->file('file');
            $file_name = time() . "_" . $file->getClientOriginalName();
            $stored = Storage::disk('admin')->putFile('/image_berita_espeed', $file);
        }

        $IdUser=Auth::user()->id;
        $IdSpeedboat=\App\User::find(Auth::user()->id);
        $beritaspeedboat = \App\beritaKapal::find($id);


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
                $path = '/image/pages/kapal/'.$request->judul.'/content/'. uniqid('', true) . '.' . $mimeType;
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
        $beritaspeedboat->berita = $detail;
        $beritaspeedboat->judul = $request->judul;
        $beritaspeedboat->tanggal = Carbon::now()->toDateTimeString();
        if ($request->hasfile('file')) {
            if ($stored) {
                $beritaspeedboat->foto = basename($stored);
            }
        }
        $beritaspeedboat->id_user = $IdUser;
        $beritaspeedboat->update();
        return redirect('/BeritaSpeedboat')->with('info','Berita berhasil diupdate!');
    }

    public function deleteBeritas($id){
        $deleteItem = \App\beritaKapal::find($id);
        $deleteItem->delete();
        return redirect('/BeritaSpeedboat')->with('success','Berita berhasil dihapus!');
    }
}
