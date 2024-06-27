<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Models\album;
use App\Models\draft;
use App\Models\foto;
use App\Models\User;
use App\Models\komentarfoto;
use App\Models\likefoto;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use \Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function createAlbum(Request $request)
    {


        $validatedData = $request->validate([
            'nama_album' => 'required|string|max:255',
            // 'slug' => 'required|string|max:255|unique:albums',
        ]);

        $slug = SlugService::createSlug(album::class, 'slug', $request->nama_album);



        $validatedData['slug'] = $slug;
        $validatedData['deskripsi'] = null;
        $validatedData['tanggal_dibuat'] = now()->format('Y-m-d');
        $validatedData['user_id'] = $request->input('user_id');


        album::create($validatedData);

        $request->session()->flash('success', 'Album added successfully!');
        return redirect('/profile');
    }

    public function addDraft(Request $request)
    {
        $slug = $request->slug;
        // $validatedData = $request->validate([
        //     'file_location.*' => 'image|file', // Menggunakan * untuk menunjukkan multiple files
        //     'user_id' => 'required'
        // ]);
        // $validator = Validator::make($request->all(), [
        //     'file_location' => 'image|file|required',
        //     'user_id' => 'required'
        // ]);

        // dd($request->file('photo_draft'));
        // Menggunakan loop foreach untuk memproses setiap file yang diunggah
        // foreach ($request->file('file_location') as $file) {
        //     // Memvalidasi dan menyimpan setiap file
        //     $validatedData['file_location'] = $file->store('photodraft');
        //     $validatedData['user_id'] = $request->user_id;

        //     // Membuat instance Draft dan menyimpannya ke dalam database
        //     draft::create($validatedData);
        // }


        // foreach ($request->file_location as $key => $file_location) {
        //     $title = $request->title[$key];
        //     $caption = $request->caption[$key];
        //     draft::create([
        //         'file_location' => $file_location,
        //         'user_id' => auth()->user()->id
        //     ]);
        // }

        // $validatedData = $request->validate([
        //     'file_location.*' => 'image|file',
        //     'album_id' => 'required'
        // ]);

        foreach ($request->file('file_location') as $file) {
            $fileLocation = $file->store('postfoto');

            draft::create([
                'file_location' => $fileLocation,
                'album_id' => $request->album_id
            ]);
        }

        $request->session()->flash('success', 'Draft(s) added successfully!');
        return redirect('/editalbum/' . $slug);
        // dd($validatedData['file_location'] = $request->file('photo_draft')->store('photodraft'));
        // $validatedData = $request->validate([
        //     'file_location' => 'image|file',
        //     'user_id' => 'required'
        // ]);
        // $validatedData['file_location'] = $request->file('photo_draft')->store('photodraft');

        // draft::create($validatedData);

        // $request->session()->flash('success', 'Draft added successfully!');
        // return redirect('/profile');

        // foreach ($request->file_location as $key => $foto) {
        //     $title = $request->title[$key];
        //     $caption = $request->caption[$key];

        //     foto::create([
        //         'judul' => $title,
        //         'deskripsi' => $caption,
        //         'tanggalfoto' => now(),
        //         'lokasifile' => $foto,
        //         'albumId' => $idalbum,
        //         'userId' => Auth::user()->id
        //     ]);
        // }

        // $ker = keranjang::select('*')
        //     ->where('userId', Auth::user()->id);

        // $ker->delete();

        // return redirect('/home')->with('notifupdate', 'Berhasil Menambahkan');
    }

    public function deleteDraft(Request $request)
    {
        $slug = $request->slug;

        Storage::delete($request->file_location);

        DB::table('drafts')->where('id', $request->input('draft_id'))->delete();

        $request->session()->flash('success', 'Draft has been deleted!');
        return redirect('/editalbum/' . $slug);
        // dd($validatedData['file_location'] = $request->file('photo_draft')->store('photodraft'));
        // $validatedData = $request->validate([
        //     'file_location' => 'image|file',
        //     'user_id' => 'required'
        // ]);
        // $validatedData['file_location'] = $request->file('photo_draft')->store('photodraft');

        // draft::create($validatedData);

        // $request->session()->flash('success', 'Draft added successfully!');
        // return redirect('/profile');

        // foreach ($request->file_location as $key => $foto) {
        //     $title = $request->title[$key];
        //     $caption = $request->caption[$key];

        //     foto::create([
        //         'judul' => $title,
        //         'deskripsi' => $caption,
        //         'tanggalfoto' => now(),
        //         'lokasifile' => $foto,
        //         'albumId' => $idalbum,
        //         'userId' => Auth::user()->id
        //     ]);
        // }

        // $ker = keranjang::select('*')
        //     ->where('userId', Auth::user()->id);

        // $ker->delete();

        // return redirect('/home')->with('notifupdate', 'Berhasil Menambahkan');
    }

    // public function uploadPost(Request $request)
    // {

    //     // dd($request->input('user_id'));

    //     $slug = $request->slug;

    //     $validatedData = $request->validate([
    //         'judul_foto' => 'string|max:255|required',
    //         'deskripsi_foto' => 'string|max:255|required',
    //         'lokasi_file' => 'image|file',
    //         'album_id' => 'required',
    //         'user_id' => 'required'
    //     ]);

    //     $validatedData['tanggal_unggah'] = now()->format('Y-m-d');
    //     $validatedData['lokasi_file'] = $request->file('lokasi_file')->store('postfoto');

    //     foto::create($validatedData);

    //     $request->session()->flash('success', 'Post added successfully!');
    //     return redirect('/createpost');
    // }

    public function uploadPost(Request $request)
    {
        $slug = $request->slug;

        // $validatedData = $request->validate([
        //     'deskripsi_foto.*' => 'string|max:255|required',
        //     'lokasi_file.*' => 'image|file',
        //     'album_id' => 'required',
        //     'user_id.*' => 'required'
        // ]);

        // dd($request->input('judul_foto'));
        // Loop melalui setiap draft yang diunggah
        foreach ($request->draft_id as $key => $draftId) {
            $nama_album = draft::select('albums.nama_album')
                ->join('albums', 'drafts.album_id', '=', 'albums.id')
                ->where('drafts.id', '=', $request->draft_id)
                ->get();
            // dd($nama_album[0]->nama_album);
            if ($request->input('judul_foto')[$key] == null) {
                // $judul_foto = SlugService::createSlug(foto::class, 'judul_foto', $nama_album[0]->nama_album);
                // $judul_tanpa_strip = str_replace('-', ' ', $judul_foto);
                $postData = [
                    'judul_foto' => $nama_album[0]->nama_album,
                    'deskripsi_foto' => $request->deskripsi_foto[$key],
                    'lokasi_file' => $request->lokasi_file[$key],
                    'album_id' => $request->album_id,
                    'user_id' => $request->user_id[$key],
                    'tanggal_unggah' => now()->format('Y-m-d')
                ];
            } else {
                $postData = [
                    'judul_foto' => $request->judul_foto[$key],
                    'deskripsi_foto' => $request->deskripsi_foto[$key],
                    'lokasi_file' => $request->lokasi_file[$key],
                    'album_id' => $request->album_id,
                    'user_id' => $request->user_id[$key],
                    'tanggal_unggah' => now()->format('Y-m-d')
                ];
            }
            // dd($nama_album[0]->nama_album);



            // ddd($postData);

            // Simpan postingan ke dalam database
            foto::create($postData);
        }

        DB::table('drafts')->where('album_id', $request->input('album_id'))->delete();
        // $dr = draft::select('*')
        //     ->where('album_id', $request->album_id);

        // $dr->delete();
        // DB::table('drafts')->where('album_id', $request->album_id)->delete();

        $request->session()->flash('success', 'Posts uploaded successfully!');
        return redirect('/editalbum/' . $slug);
    }

    public function editPost(Request $request, foto $foto)
    {
        $slug = $request->slug;
        // dd($request);
        if ($request->file('lokasi_file')) {
            if ($request->oldImage) {
                Storage::delete($request->oldImage);
            }
            $lokasi_foto = $request->file('lokasi_file')->store('postfoto');
        } else {
            $lokasi_foto = $request->oldImage;
        }
        DB::table('fotos')
            ->where('id', $request->input('foto_id'))
            ->update([
                'judul_foto' => $request->input('judul_foto'),
                'deskripsi_foto' => $request->input('deskripsi_foto'),
                'lokasi_file' => $lokasi_foto
            ]);
        $request->session()->flash('success', 'Post has been editted!');
        return redirect('/editalbum/' . $slug);
    }

    public function deletepost(Request $request, foto $foto)
    {
        // dd($request->input('post_id'));
        $slug = $request->slug;
        $image = DB::table('fotos')
            ->select('lokasi_file')
            ->where('id', '=', $request->input('post_id'))
            ->get();

        $mainImage = $image[0]->lokasi_file;


        if ($mainImage) {
            Storage::delete($mainImage);
        }

        DB::table('fotos')->where('id', $request->input('post_id'))->delete();

        $request->session()->flash('error', 'Post has been deleted!');
        return redirect('/editalbum/' . $slug);
    }

    public function updateAlbum(Request $request, album $album)
    {

        $album = DB::table('albums')
            ->select('*')
            ->where('id', '=', $request->album_id)
            ->get();

        $fotos = DB::table('fotos')
            ->select('*')
            ->where('judul_foto', '=', $album[0]->nama_album)
            ->get();

        // dd($fotos);

        foreach ($fotos as $fotoId) {
            // $judul_foto = SlugService::createSlug(foto::class, 'judul_foto', $request->nama_album);
            // dd($fotoId);

            DB::table('fotos')
                ->where('id', $fotoId->id)
                ->update([
                    'judul_foto' => $request->input('nama_album')
                ]);
        }

        $slug = SlugService::createSlug(album::class, 'slug', $request->nama_album);

        DB::table('albums')
            ->where('id', $request->input('album_id'))
            ->update([
                'nama_album' => $request->input('nama_album'),
                'deskripsi' => $request->input('deskripsi'),
                'slug' => $slug
            ]);

        $request->session()->flash('success', 'Album has been editted!');
        return redirect('/editalbum/' . $slug);
    }

    public function deletealbum(Request $request, album $album)
    {
        // dd($request->input('album_id'));

        $fotos = DB::table('fotos')
            ->select('*')
            ->where('album_id', '=', $request->album_id)
            ->get();

        foreach ($fotos as $foto) {
            $mainImage = $foto->lokasi_file;
            Storage::delete($mainImage);
        }
        DB::table('fotos')->where('album_id', $request->input('album_id'))->delete();

        $drafts = DB::table('drafts')
            ->select('*')
            ->where('album_id', '=', $request->album_id)
            ->get();

        foreach ($drafts as $draft) {
            $mainImagedraft = $draft->file_location;
            Storage::delete($mainImagedraft);
        }
        DB::table('drafts')->where('album_id', $request->input('album_id'))->delete();

        DB::table('albums')->where('id', $request->input('album_id'))->delete();

        $request->session()->flash('error', 'Album has been deleted!');
        return redirect('/profile');
    }

    public function updateProfile(Request $request, User $user)
    {
        if ($request->file('lokasi_file')) {
            if ($request->oldImage) {
                if ($request->oldImage !== "photoprofile/default_profile.jpg") {
                    Storage::delete($request->oldImage);
                }
            }
            $lokasi_foto = $request->file('lokasi_file')->store('photoprofile');
        } else {
            $lokasi_foto = $request->oldImage;
        }
        DB::table('users')
            ->where('id', $request->input('user_id'))
            ->update([
                'username' => $request->input('username'),
                'email' => $request->input('email'),
                'nama_lengkap' => $request->input('nama_lengkap'),
                'alamat' => $request->input('alamat'),
                'foto_profil' => $lokasi_foto,
                'bio' => $request->input('bio')
            ]);
        $request->session()->flash('success', 'User has been editted!');
        return redirect('/profile');
    }

    public function addComment(Request $request)
    {

        $validatedData = $request->validate([
            'isi_komentar' => 'required|string',
        ]);

        $validatedData['foto_id'] = $request->input('foto_id');
        $validatedData['user_id'] = $request->input('user_id');
        $validatedData['tanggal_komentar'] = now()->format('Y-m-d');


        komentarfoto::create($validatedData);

        if ($request->input('status') == "page_like") {
            return redirect('/like');
        } elseif ($request->input('status') == "page_search") {
            $keyword = $request->input('request_search');
            return redirect('/search?search=' . $keyword);
        } elseif ($request->input('status') == "page_search_album") {
            $slug = $request->input('slug');
            return redirect('/view-album-search/' . $slug);
        } elseif ($request->input('status') == "page_user_view") {
            $slug = $request->input('slug');
            return redirect('/view-user/' . $slug);
        } else {
            return redirect('/home');
        }

        // $request->session()->flash('success', 'Comment added successfully!');
        // return redirect('/home');
    }

    public function addCommentuser(Request $request)
    {

        $validatedData = $request->validate([
            'isi_komentar' => 'required|string',
        ]);

        $validatedData['foto_id'] = $request->input('foto_id');
        $validatedData['user_id'] = $request->input('user_id');
        $validatedData['tanggal_komentar'] = now()->format('Y-m-d');


        komentarfoto::create($validatedData);

        // $request->session()->flash('success', 'Comment added successfully!');
        return redirect('/profile');
    }

    public function addLike(Request $request)
    {

        // $validatedData = $request->validate([
        //     'isi_komentar' => 'required|string',
        // ]);

        $validatedData['foto_id'] = $request->input('foto_id');
        $validatedData['user_id'] = $request->input('user_id');
        $validatedData['tanggal_like'] = now()->format('Y-m-d');


        likefoto::create($validatedData);

        // $request->session()->flash('success', 'Like added successfully!');
        if ($request->input('status') == "page_like") {
            return redirect('/like');
        } elseif ($request->input('status') == "page_search") {
            $keyword = $request->input('request_search');
            return redirect('/search?search=' . $keyword);
        } elseif ($request->input('status') == "page_search_album") {
            $slug = $request->input('slug');
            return redirect('/view-album-search/' . $slug);
        } elseif ($request->input('status') == "page_user_view") {
            $slug = $request->input('slug');
            return redirect('/view-user/' . $slug);
        } else {
            return redirect('/home');
        }

    }

    public function addLikeuser(Request $request)
    {

        // $validatedData = $request->validate([
        //     'isi_komentar' => 'required|string',
        // ]);

        $validatedData['foto_id'] = $request->input('foto_id');
        $validatedData['user_id'] = $request->input('user_id');
        $validatedData['tanggal_like'] = now()->format('Y-m-d');


        likefoto::create($validatedData);

        // $request->session()->flash('success', 'Like added successfully!');
        return redirect('/profile');
    }

    public function unLike(Request $request)
    {

        DB::table('likefotos')
            ->where('user_id', $request->input('user_id'))
            ->where('foto_id', $request->input('foto_id'))
            ->delete();

        // $request->session()->flash('success', 'Like added successfully!');
        if ($request->input('status') == "page_like") {
            return redirect('/like');
        } elseif ($request->input('status') == "page_search") {
            $keyword = $request->input('request_search');
            return redirect('/search?search=' . $keyword);
        } elseif ($request->input('status') == "page_search_album") {
            $slug = $request->input('slug');
            return redirect('/view-album-search/' . $slug);
        } elseif ($request->input('status') == "page_user_view") {
            $slug = $request->input('slug');
            return redirect('/view-user/' . $slug);
        } else {
            return redirect('/home');
        }
    }

    public function unLikeuser(Request $request)
    {

        DB::table('likefotos')
            ->where('user_id', $request->input('user_id'))
            ->where('foto_id', $request->input('foto_id'))
            ->delete();

        // $request->session()->flash('success', 'Like added successfully!');
        return redirect('/profile');
    }

    public function createSlug(Request $request)
    {
        $slug = SlugService::createSlug(album::class, 'slug', $request->title);
        return response()->json(['slug' => $slug]);
    }

    public function updatePassword(Request $request)
    {
        $validatedData = $request->validate([
            'oldpassword' => 'required',
            'newpassword' => 'required',
            'confirmnewpassword' => 'required'
        ]);

        $datauser = User::find($request->user_id);

        if (Hash::check($request->oldpassword, $datauser->password)) {

            if ($request->newpassword == $request->confirmnewpassword) {

                // hashing password
                $password = Hash::make($request['newpassword']);

                $datauser->update([
                    'password' => $password
                ]);
            } else {
                $request->session()->flash('error', 'The confirmation password is incorrect!');
                return redirect('/edit-profile');
            }
        } else {
            $request->session()->flash('error', 'The current password is incorrect!');
            return redirect('/edit-profile');
        }
        $request->session()->flash('success', 'The password has been changed!');
        return redirect('/edit-profile');
    }

    public function deleteCommentuser(Request $request)
    {
        DB::table('komentarfotos')
            ->where('id', $request->input('comment_id'))
            ->delete();

        $request->session()->flash('error', 'Comment has been deleted!');
        return redirect('/profile');
    }

    public function deleteComment(Request $request)
    {
        DB::table('komentarfotos')
            ->where('id', $request->input('comment_id'))
            ->delete();

        $request->session()->flash('error', 'Comment has been deleted!');
        // return redirect('/home');
        if ($request->input('status') == "page_like") {
            return redirect('/like');
        } elseif ($request->input('status') == "page_search") {
            $keyword = $request->input('request_search');
            return redirect('/search?search=' . $keyword);
        } elseif ($request->input('status') == "page_search_album") {
            $slug = $request->input('slug');
            return redirect('/view-album-search/' . $slug);
        } elseif ($request->input('status') == "page_user_view") {
            $slug = $request->input('slug');
            return redirect('/view-user/' . $slug);
        } else {
            return redirect('/home');
        }
    }

    public function deleteCommentuserview(Request $request)
    {
        DB::table('komentarfotos')
            ->where('id', $request->input('comment_id'))
            ->delete();
        $username = $request->input('username');

        $request->session()->flash('error', 'Comment has been deleted!');
        return redirect('/view-user/' . $username);
    }
}