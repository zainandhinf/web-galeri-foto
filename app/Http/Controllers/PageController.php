<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Foto;
use App\Models\LikeFoto;
use App\Models\KomentarFoto;

class PageController extends Controller
{
    public function login()
    {
        return view(
            'login',
            [
                "title" => "Log in"

            ]
        );
    }
    public function signup()
    {
        return view(
            'signup',
            [
                "title" => "Sign up"

            ]
        );
    }

    public function home()
    {
        // $photos = DB::table('users')
        //     ->select('fotos.user_id', 'users.nama_lengkap as NLuser', 'users.foto_profil as foto', 'users.nama_lengkap as NamaLengkap', 'fotos.id', 'fotos.lokasi_file', 'fotos.judul_foto', 'fotos.deskripsi_foto', DB::raw("DATE_FORMAT(fotos.tanggal_unggah, '%d %M %Y','id_ID') as TanggalUnggah"), DB::raw("IFNULL(likefotos.user_id, 'BL') as suka"), DB::raw("(SELECT COUNT(*) FROM likefotos WHERE likefotos.foto_id = fotos.id) as totallike"), DB::raw("(SELECT COUNT(*) FROM komentarfotos WHERE komentarfotos.foto_id = fotos.id) as totalkomentar"))
        //     ->leftJoin('fotos', 'users.id', '=', 'fotos.user_id')
        //     ->leftJoin('likefotos', function ($join) {
        //         $join->on('likefotos.user_id', '=', 'users.id')
        //             ->on('likefotos.foto_id', '=', 'fotos.id');
        //     })
        //     ->leftJoin(DB::raw('(SELECT user_id, isi_komentar, foto_id FROM komentarfotos GROUP BY user_id) b'), function ($join) {
        //         $join->on('b.user_id', '=', 'users.id')
        //             ->on('b.foto_id', '=', 'fotos.id');
        //     })
        //     ->where('users.id', '=', auth()->user()->id)
        //     ->inRandomOrder()
        //     ->limit(50)
        //     ->get();

        // $results = User::select(
        //     'fotos.user_id',
        //     DB::raw('users.username as NLuser'),
        //     DB::raw('(select users.foto_profil FROM users WHERE users.id = fotos.user_id) as foto'),
        //     DB::raw('(SELECT users.nama_lengkap from users WHERE users.id = fotos.user_id) as NamaLengkap'),
        //     'fotos.id',
        //     'fotos.lokasi_file',
        //     'fotos.judul_foto',
        //     'fotos.deskripsi_foto',
        //     DB::raw("DATE_FORMAT(fotos.tanggal_unggah, '%d %M %Y') as TanggalUnggah"),
        //     DB::raw("IF(likefotos.user_id  IS null,'BL','SL') as suka"),
        //     DB::raw("(select Count(*)  FROM likefotos WHERE likefotos.foto_id= fotos.id) as totallike"),
        //     DB::raw("(select Count(*) FROM komentarfotos WHERE komentarfotos.foto_id = fotos.id) as totalkomentar")
        // )
        //     ->leftJoin('fotos', 'fotos.user_id', '=', 'users.id')
        //     ->leftJoin('likefotos', function ($join) {
        //         $join->on('likefotos.user_id', '=', 'users.id')
        //             ->on('likefotos.foto_id', '=', 'fotos.id');
        //     })
        //     ->leftJoin(DB::raw('(SELECT user_id,isi_komentar, foto_id from komentarfotos) as b'), function ($join) {
        //         $join->on('b.user_id', '=', 'users.id')
        //             ->on('b.foto_id', '=', 'fotos.id');
        //     })
        //     ->where('users.id', '2')
        //     ->inRandomOrder()
        //     ->limit(50)
        //     ->get();

        // $results = DB::table('users')
        //     ->select(
        //         'fotos.user_id',
        //         'users.nama_lengkap as NLuser',
        //         DB::raw('(select users.foto_profil FROM users WHERE users.id = fotos.user_id) as foto'),
        //         DB::raw('(SELECT users.nama_lengkap from users WHERE users.id = fotos.user_id) as NamaLengkap'),
        //         'fotos.id',
        //         'fotos.lokasi_file',
        //         'fotos.judul_foto',
        //         'fotos.deskripsi_foto',
        //         DB::raw("DATE_FORMAT(fotos.tanggal_unggah, '%d %M %Y','id_ID') as TanggalUnggah"),
        //         DB::raw("IF(likefotos.user_id  IS null,'BL','SL') as suka"),
        //         DB::raw("(select Count(*)  FROM likefotos WHERE likefotos.foto_id= fotos.id) as totallike"),
        //         DB::raw("(select Count(*) FROM komentarfotos WHERE komentarfotos.foto_id = fotos.id) as totalkomentar")
        //     )
        //     ->leftJoin('fotos', 'fotos.user_id', '=', 'users.id')
        //     ->leftJoin('likefotos', function ($join) {
        //         $join->on('likefotos.user_id', '=', 'users.id')
        //             ->on('likefotos.foto_id', '=', 'fotos.id');
        //     })
        //     ->leftJoin(DB::raw('(SELECT user_id,isi_komentar, foto_id from komentarfotos) b'), function ($join) {
        //         $join->on('b.user_id', '=', 'users.id')
        //             ->on('b.foto_id', '=', 'fotos.id');
        //     })
        //     ->where('users.id', '2')
        //     ->inRandomOrder()
        //     ->limit(50)
        //     ->get();
//         $query = "SELECT fotos.user_id, users.nama_lengkap as NLuser, (select users.foto_profil FROM users WHERE users.id = fotos.user_id) as foto, (SELECT users.nama_lengkap from users WHERE users.id = fotos.user_id)as NamaLengkap, fotos.id, fotos.lokasi_file,  fotos.judul_foto, fotos.deskripsi_foto, DATE_FORMAT(fotos.tanggal_unggah, '%d %M %Y','id_ID') as TanggalUnggah, IF(likefotos.user_id  IS null,'BL','SL') as suka, (select Count(*)  FROM likefotos WHERE likefotos.foto_id= fotos.id) as totallike, (select Count(*) FROM komentarfotos WHERE komentarfotos.foto_id = fotos.id) as totalkomentar FROM users
// LEFT JOIN fotos on fotos.id
// LEFT JOIN likefotos on (likefotos.user_id = users.id AND likefotos.foto_id = fotos.id)
// LEFT JOIN (SELECT user_id,isi_komentar, foto_id from komentarfotos GROUP by user_id) b on b.user_id = users.id and b.foto_id = fotos.id
// where users.id = idlogin ORDER BY rand() limit 50";
//         $results = DB::table('users')
//             ->leftJoin('fotos', function ($join) {
//                 $join->on('fotos.user_id', '=', 'users.id');
//             })
//             ->leftJoin('likefotos', function ($join) {
//                 $join->on('likefotos.user_id', '=', 'users.id')
//                     ->on('likefotos.foto_id', '=', 'fotos.id');
//             })
//             ->leftJoin(DB::raw('(SELECT user_id, COUNT(*) as total_like FROM likefotos GROUP BY user_id) as like_count'), function ($join) {
//                 $join->on('like_count.user_id', '=', 'users.id');
//             })
//             ->leftJoin(DB::raw('(SELECT user_id, COUNT(*) as total_comment FROM komentarfotos GROUP BY user_id) as comment_count'), function ($join) {
//                 $join->on('comment_count.user_id', '=', 'users.id');
//             })
//             ->where('users.id', '=', 2)
//             ->select([
//                 'users.id',
//                 'users.nama_lengkap as NLuser',
//                 DB::raw('(SELECT users.foto_profil FROM users WHERE users.id = fotos.user_id) as foto'),
//                 DB::raw('(SELECT users.nama_lengkap FROM users WHERE users.id = fotos.user_id) as NamaLengkap'),
//                 'fotos.id',
//                 'fotos.lokasi_file',
//                 'fotos.judul_foto',
//                 'fotos.deskripsi_foto',
//                 DB::raw('DATE_FORMAT(fotos.tanggal_unggah, "%d %M %Y", "id_ID") as TanggalUnggah'),
//                 DB::raw('IF(likefotos.user_id IS NULL, "BL", "SL") as suka'),
//                 'like_count.total_like',
//                 'comment_count.total_comment',
//             ])
//             ->orderByRaw('rand()')
//             ->limit(50)
//             ->get();

        // $randomPhotos = DB::table('fotos')
        //     ->select('fotos.*', 'komentar_counts.jumlah_komentar', 'like_counts.jumlah_like')
        //     ->leftJoin(DB::raw('(SELECT foto_id, COUNT(id) as jumlah_komentar FROM komentarfotos GROUP BY foto_id) as komentar_counts'), 'fotos.id', '=', 'komentar_counts.foto_id')
        //     ->leftJoin(DB::raw('(SELECT foto_id, COUNT(id) as jumlah_like FROM likefotos GROUP BY foto_id) as like_counts'), 'fotos.id', '=', 'like_counts.foto_id')
        //     ->inRandomOrder()
        //     ->take(10)
        //     ->get();

        // foreach ($randomPhotos as $photo) {
        //     $comments = DB::table('komentarfotos')
        //         ->where('foto_id', $photo->id)
        //         ->get();

        //     $photo->comments = $comments;
        // }

        // $randomPhotos = DB::table('fotos')
        //     ->select('fotos.*', 'users.username', 'users.foto_profil', 'komentar_counts.jumlah_komentar', 'like_counts.jumlah_like')
        //     ->leftJoin(DB::raw('(SELECT foto_id, COUNT(id) as jumlah_komentar FROM komentarfotos GROUP BY foto_id) as komentar_counts'), 'fotos.id', '=', 'komentar_counts.foto_id')
        //     ->leftJoin(DB::raw('(SELECT foto_id, COUNT(id) as jumlah_like FROM likefotos GROUP BY foto_id) as like_counts'), 'fotos.id', '=', 'like_counts.foto_id')
        //     ->leftJoin('users', 'fotos.user_id', '=', 'users.id')
        //     ->inRandomOrder()
        //     ->take(10)
        //     ->get();

        // foreach ($randomPhotos as $photo) {
        //     $comments = DB::table('komentarfotos')
        //         ->where('foto_id', $photo->id)
        //         ->get();

        //     $photo->comments = $comments;
        // }

        // $randomPhotos = DB::table('fotos')
        //     ->select(
        //         'fotos.*',
        //         'users.username',
        //         'users.foto_profil',
        //         DB::raw('IF(likefotos.user_id IS NULL, "BL", "SL") as suka'),
        //         DB::raw('COUNT(komentarfotos.id) as jumlah_komentar'),
        //         DB::raw('COUNT(likefotos.id) as jumlah_like')
        //     )
        //     ->leftJoin(DB::raw('(SELECT foto_id, COUNT(id) as jumlah_komentar FROM komentarfotos GROUP BY foto_id) as komentar_counts'), 'fotos.id', '=', 'komentar_counts.foto_id')
        //     ->leftJoin(DB::raw('(SELECT foto_id, COUNT(id) as jumlah_like FROM likefotos GROUP BY foto_id) as like_counts'), 'fotos.id', '=', 'like_counts.foto_id')
        //     ->leftJoin('users', 'fotos.user_id', '=', 'users.id')
        //     ->inRandomOrder()
        //     ->take(50)
        //     ->get();

        // $randomPhotos = DB::table('fotos')
        //     ->select('fotos.*', 'users.username', 'users.foto_profil', 'komentar_counts.jumlah_komentar', 'like_counts.jumlah_like', DB::raw('IFNULL(likefotos.user_id, "BL") as suka'))
        //     ->leftJoin(DB::raw('(SELECT foto_id, COUNT(id) as jumlah_komentar FROM komentarfotos GROUP BY foto_id) as komentar_counts'), 'fotos.id', '=', 'komentar_counts.foto_id')
        //     ->leftJoin(DB::raw('(SELECT foto_id, COUNT(id) as jumlah_like FROM likefotos GROUP BY foto_id) as like_counts'), 'fotos.id', '=', 'like_counts.foto_id')
        //     ->leftJoin('users', 'fotos.user_id', '=', 'users.id')
        //     ->leftJoin('likefotos', function ($join) {
        //         $join->on('fotos.id', '=', 'likefotos.foto_id')
        //             ->where('likefotos.user_id', '=', 'the_user_id');
        //     })
        //     ->inRandomOrder()
        //     ->take(10)
        //     ->get();

        // foreach ($randomPhotos as $photo) {
        //     $comments = DB::table('komentarfotos')
        //         ->where('foto_id', $photo->id)
        //         ->get();

        //     $photo->comments = $comments;
        // }


        // foreach ($randomPhotos as $photo) {
        //     $comments = DB::table('komentarfotos')
        //         ->where('foto_id', $photo->id)
        //         ->get();

        //     $photo->comments = $comments;
        // }

        $randomPhotos = DB::table('fotos')
            ->select('fotos.*', 'users.username', 'users.foto_profil', 'komentar_counts.jumlah_komentar', 'like_counts.jumlah_like', DB::raw("IF(likes.user_id IS NULL, 'BL', 'SL') AS suka"))
            ->leftJoin(DB::raw('(SELECT foto_id, COUNT(id) as jumlah_komentar FROM komentarfotos GROUP BY foto_id) as komentar_counts'), 'fotos.id', '=', 'komentar_counts.foto_id')
            ->leftJoin(DB::raw('(SELECT foto_id, COUNT(id) as jumlah_like FROM likefotos GROUP BY foto_id) as like_counts'), 'fotos.id', '=', 'like_counts.foto_id')
            ->leftJoin('users', 'fotos.user_id', '=', 'users.id')
            ->leftJoin('likefotos as likes', function ($join) {
                $join->on('fotos.id', '=', 'likes.foto_id')
                    ->where('likes.user_id', '=', auth()->user()->id); // Assuming you're using Laravel's built-in authentication
            })
            ->inRandomOrder()
            ->take(30)
            ->get();

        foreach ($randomPhotos as $photo) {
            $comments = DB::table('komentarfotos')
                ->where('foto_id', $photo->id)
                ->get();

            $photo->comments = $comments;
        }


        // return view('home', ['randomPhotos' => $randomPhotos]);

        // dd($randomPhotos);
        return view(
            'layout.home',
            [
                "title" => "Home",
                "photos" => $randomPhotos

            ]
        );
    }

    public function profile()
    {
        $randomPhotos = DB::table('fotos')
            ->select('fotos.*', 'users.username', 'users.foto_profil', 'komentar_counts.jumlah_komentar', 'like_counts.jumlah_like', DB::raw("IF(likes.user_id IS NULL, 'BL', 'SL') AS suka"))
            ->leftJoin(DB::raw('(SELECT foto_id, COUNT(id) as jumlah_komentar FROM komentarfotos GROUP BY foto_id) as komentar_counts'), 'fotos.id', '=', 'komentar_counts.foto_id')
            ->leftJoin(DB::raw('(SELECT foto_id, COUNT(id) as jumlah_like FROM likefotos GROUP BY foto_id) as like_counts'), 'fotos.id', '=', 'like_counts.foto_id')
            ->leftJoin('users', 'fotos.user_id', '=', 'users.id')
            ->leftJoin('likefotos as likes', function ($join) {
                $join->on('fotos.id', '=', 'likes.foto_id')
                    ->where('likes.user_id', '=', auth()->user()->id);
            })
            ->where('fotos.user_id', '=', auth()->user()->id)
            ->orderBy('id', 'desc')
            ->inRandomOrder()
            ->get();

        foreach ($randomPhotos as $photo) {
            $comments = DB::table('komentarfotos')
                ->where('foto_id', $photo->id)
                ->get();

            $photo->comments = $comments;
        }

        // dd($randomPhotos);

        return view(
            'layout.profile',
            [
                "title" => "Profile",
                "photo_posts" => $randomPhotos,
            ]
        );
    }

    public function profileUser($username)
    {
        $user = DB::table('users')
            ->select('id')
            ->where('username', '=', $username)
            ->get();
        $user_id = $user[0]->id;
        // dd($user_id);
        $randomPhotos = DB::table('fotos')
            ->select('fotos.*', 'users.username', 'users.foto_profil', 'komentar_counts.jumlah_komentar', 'like_counts.jumlah_like', DB::raw("IF(likes.user_id IS NULL, 'BL', 'SL') AS suka"))
            ->leftJoin(DB::raw('(SELECT foto_id, COUNT(id) as jumlah_komentar FROM komentarfotos GROUP BY foto_id) as komentar_counts'), 'fotos.id', '=', 'komentar_counts.foto_id')
            ->leftJoin(DB::raw('(SELECT foto_id, COUNT(id) as jumlah_like FROM likefotos GROUP BY foto_id) as like_counts'), 'fotos.id', '=', 'like_counts.foto_id')
            ->leftJoin('users', 'fotos.user_id', '=', 'users.id')
            ->leftJoin('likefotos as likes', function ($join) use ($user_id) {
                $join->on('fotos.id', '=', 'likes.foto_id')
                    ->where('likes.user_id', '=', $user_id);
            })
            ->where('fotos.user_id', '=', $user_id)
            ->orderBy('id', 'desc')
            // ->inRandomOrder()
            // ->take(10)
            ->get();

        foreach ($randomPhotos as $photo) {
            $comments = DB::table('komentarfotos')
                ->where('foto_id', $photo->id)
                ->get();

            $photo->comments = $comments;
        }

        // dd($randomPhotos);

        return view(
            'layout.profileuser',
            [
                "title" => "Profile",
                "photo_posts" => $randomPhotos,
                "user_id" => $user_id,
                "album2" => null
            ]
        );
    }

    public function editprofile()
    {
        return view(
            'layout.editprofile',
            [
                "title" => "Edit Profile"

            ]
        );
    }

    public function createpost()
    {
        return view(
            'layout.createpost',
            [
                "title" => "Create Post"
            ]
        );
    }

    public function editalbum($album_slug)
    {
        $album = DB::table('albums')
            ->select('*')
            ->where('slug', '=', $album_slug)
            ->get();
        return view(
            'layout.editalbum',
            [
                "title" => "Edit Album",
                "album" => $album
            ]
        );
    }

    public function viewpostalbum($album_slug)
    {
        $album = DB::table('albums')
            ->select('*')
            ->where('slug', '=', $album_slug)
            ->get();
        $randomPhotos = DB::table('fotos')
            ->select('fotos.*', 'users.username', 'users.foto_profil', 'komentar_counts.jumlah_komentar', 'like_counts.jumlah_like', DB::raw("IF(likes.user_id IS NULL, 'BL', 'SL') AS suka"))
            ->leftJoin(DB::raw('(SELECT foto_id, COUNT(id) as jumlah_komentar FROM komentarfotos GROUP BY foto_id) as komentar_counts'), 'fotos.id', '=', 'komentar_counts.foto_id')
            ->leftJoin(DB::raw('(SELECT foto_id, COUNT(id) as jumlah_like FROM likefotos GROUP BY foto_id) as like_counts'), 'fotos.id', '=', 'like_counts.foto_id')
            ->leftJoin('users', 'fotos.user_id', '=', 'users.id')
            ->leftJoin('likefotos as likes', function ($join) {
                $join->on('fotos.id', '=', 'likes.foto_id')
                    ->where('likes.user_id', '=', auth()->user()->id);
            })
            ->join('albums', 'fotos.album_id', '=', 'albums.id')
            ->where('albums.slug', '=', $album_slug)
            ->orderBy('id', 'desc')
            // ->inRandomOrder()
            // ->take(10)
            ->get();

        foreach ($randomPhotos as $photo) {
            $comments = DB::table('komentarfotos')
                ->where('foto_id', $photo->id)
                ->get();

            $photo->comments = $comments;
        }

        // dd($album);
        return view(
            'layout.previewalbumpost',
            [
                "title" => "Profile",
                "album" => $album,
                "photo_posts" => $randomPhotos
            ]
        );
    }

    public function search()
    {

        if (request('search')) {
            // $posts = DB::table('foto')
            //     ->select('*')
            //     ->where('title', 'like', '%' . request('search') . '%')
            //     // ->orWhere('title', 'like', '%' . request('search') . '%')
            //     ->get();

            $randomPhotos = DB::table('fotos')
                ->select('fotos.*', 'users.username', 'users.foto_profil', 'komentar_counts.jumlah_komentar', 'like_counts.jumlah_like', DB::raw("IF(likes.user_id IS NULL, 'BL', 'SL') AS suka"))
                ->leftJoin(DB::raw('(SELECT foto_id, COUNT(id) as jumlah_komentar FROM komentarfotos GROUP BY foto_id) as komentar_counts'), 'fotos.id', '=', 'komentar_counts.foto_id')
                ->leftJoin(DB::raw('(SELECT foto_id, COUNT(id) as jumlah_like FROM likefotos GROUP BY foto_id) as like_counts'), 'fotos.id', '=', 'like_counts.foto_id')
                ->leftJoin('users', 'fotos.user_id', '=', 'users.id')
                ->leftJoin('likefotos as likes', function ($join) {
                    $join->on('fotos.id', '=', 'likes.foto_id')
                        ->where('likes.user_id', '=', auth()->user()->id);
                })
                ->join('albums', 'fotos.album_id', '=', 'albums.id')
                ->where('fotos.judul_foto', 'like', '%' . request('search') . '%')
                ->orWhere('fotos.deskripsi_foto', 'like', '%' . request('search') . '%')
                // ->orderBy('id', 'desc')
                // ->inRandomOrder()
                // ->take(10)
                ->get();
            foreach ($randomPhotos as $photo) {
                $comments = DB::table('komentarfotos')
                    ->where('foto_id', $photo->id)
                    ->get();

                $photo->comments = $comments;
            }
            $albums = DB::table('albums')
                ->select('*')
                ->where('nama_album', 'like', '%' . request('search') . '%')
                // ->orWhere('title', 'like', '%' . request('search') . '%')
                ->get();
            $users = DB::table('users')
                ->select('*')
                ->where('nama_lengkap', 'like', '%' . request('search') . '%')
                ->orWhere('username', 'like', '%' . request('search') . '%')
                ->get();
            // dd($users);
            return view(
                'layout.search',
                [
                    "title" => "Search",
                    "photos" => $randomPhotos,
                    "albums" => $albums,
                    "users" => $users
                ]
            );
        }
        // dd("jaaja");
        return view(
            'layout.search',
            [
                "title" => "Search"
            ]
        );
    }

    public function viewpostalbumuser($username, $album_slug)
    {
        // dd($username);
        $album = DB::table('albums')
            ->select('*')
            ->where('slug', '=', $album_slug)
            ->get();
        $user = DB::table('users')
            ->select('*')
            ->where('username', '=', $username)
            ->get();
        $randomPhotos = DB::table('fotos')
            ->select('fotos.*', 'users.username', 'users.foto_profil', 'komentar_counts.jumlah_komentar', 'like_counts.jumlah_like', DB::raw("IF(likes.user_id IS NULL, 'BL', 'SL') AS suka"))
            ->leftJoin(DB::raw('(SELECT foto_id, COUNT(id) as jumlah_komentar FROM komentarfotos GROUP BY foto_id) as komentar_counts'), 'fotos.id', '=', 'komentar_counts.foto_id')
            ->leftJoin(DB::raw('(SELECT foto_id, COUNT(id) as jumlah_like FROM likefotos GROUP BY foto_id) as like_counts'), 'fotos.id', '=', 'like_counts.foto_id')
            ->leftJoin('users', 'fotos.user_id', '=', 'users.id')
            ->leftJoin('likefotos as likes', function ($join) {
                $join->on('fotos.id', '=', 'likes.foto_id')
                    ->where('likes.user_id', '=', auth()->user()->id);
            })
            ->join('albums', 'fotos.album_id', '=', 'albums.id')
            ->where('albums.slug', '=', $album_slug)
            ->orderBy('id', 'desc')
            // ->inRandomOrder()
            // ->take(10)
            ->get();

        foreach ($randomPhotos as $photo) {
            $comments = DB::table('komentarfotos')
                ->where('foto_id', $photo->id)
                ->get();

            $photo->comments = $comments;
        }

        // dd($album);
        return view(
            'layout.profileuser',
            [
                "title" => "Profile",
                "album2" => $album,
                "photo_posts" => $randomPhotos,
                "user_id" => $user[0]->id
            ]
        );
    }

    public function viewpostalbumsearch($album_slug)
    {
        $album = DB::table('albums')
            ->select('*')
            ->where('slug', '=', $album_slug)
            ->get();
        $randomPhotos = DB::table('fotos')
            ->select('fotos.*', 'users.username', 'users.foto_profil', 'komentar_counts.jumlah_komentar', 'like_counts.jumlah_like', DB::raw("IF(likes.user_id IS NULL, 'BL', 'SL') AS suka"))
            ->leftJoin(DB::raw('(SELECT foto_id, COUNT(id) as jumlah_komentar FROM komentarfotos GROUP BY foto_id) as komentar_counts'), 'fotos.id', '=', 'komentar_counts.foto_id')
            ->leftJoin(DB::raw('(SELECT foto_id, COUNT(id) as jumlah_like FROM likefotos GROUP BY foto_id) as like_counts'), 'fotos.id', '=', 'like_counts.foto_id')
            ->leftJoin('users', 'fotos.user_id', '=', 'users.id')
            ->leftJoin('likefotos as likes', function ($join) {
                $join->on('fotos.id', '=', 'likes.foto_id')
                    ->where('likes.user_id', '=', auth()->user()->id);
            })
            ->join('albums', 'fotos.album_id', '=', 'albums.id')
            ->where('albums.slug', '=', $album_slug)
            ->orderBy('id', 'desc')
            // ->inRandomOrder()
            // ->take(10)
            ->get();

        foreach ($randomPhotos as $photo) {
            $comments = DB::table('komentarfotos')
                ->where('foto_id', $photo->id)
                ->get();

            $photo->comments = $comments;
        }

        // dd($album);
        return view(
            'layout.previewalbumsearch',
            [
                "title" => "Album",
                "album" => $album,
                "photo_posts" => $randomPhotos
            ]
        );
    }

    public function like()
    {

        // $posts = DB::table('foto')
        //     ->select('*')
        //     ->where('title', 'like', '%' . request('search') . '%')
        //     // ->orWhere('title', 'like', '%' . request('search') . '%')
        //     ->get();

        $idFotos = DB::table('likefotos')
            ->select('*')
            ->where('user_id', '=', auth()->user()->id)
            ->get();

        $postsIds = $idFotos->pluck('foto_id')->toArray();

        $photoslike = DB::table('fotos')
            ->select('fotos.*', 'users.username', 'users.foto_profil', 'komentar_counts.jumlah_komentar', 'like_counts.jumlah_like', DB::raw("IF(likes.user_id IS NULL, 'BL', 'SL') AS suka"))
            ->leftJoin(DB::raw('(SELECT foto_id, COUNT(id) as jumlah_komentar FROM komentarfotos GROUP BY foto_id) as komentar_counts'), 'fotos.id', '=', 'komentar_counts.foto_id')
            ->leftJoin(DB::raw('(SELECT foto_id, COUNT(id) as jumlah_like FROM likefotos GROUP BY foto_id) as like_counts'), 'fotos.id', '=', 'like_counts.foto_id')
            ->leftJoin('users', 'fotos.user_id', '=', 'users.id')
            ->leftJoin('likefotos as likes', function ($join) {
                $join->on('fotos.id', '=', 'likes.foto_id')
                    ->where('likes.user_id', '=', auth()->user()->id);
            })
            ->join('albums', 'fotos.album_id', '=', 'albums.id')
            ->whereIn('fotos.id', $postsIds)
            // ->where('fotos.judul_foto', 'like', '%' . request('search') . '%')
            // ->orderBy('id', 'desc')
            // ->inRandomOrder()
            // ->take(10)
            ->get();
        foreach ($photoslike as $photo) {
            $comments = DB::table('komentarfotos')
                ->where('foto_id', $photo->id)
                ->get();

            $photo->comments = $comments;
        }
        // dd($photoslike);

        $mostlikes = DB::table('fotos')
            ->select('fotos.*', 'users.username', 'users.foto_profil', 'komentar_counts.jumlah_komentar', 'like_counts.jumlah_like', DB::raw("IF(likes.user_id IS NULL, 'BL', 'SL') AS suka"))
            ->leftJoin(DB::raw('(SELECT foto_id, COUNT(id) as jumlah_komentar FROM komentarfotos GROUP BY foto_id) as komentar_counts'), 'fotos.id', '=', 'komentar_counts.foto_id')
            ->leftJoin(DB::raw('(SELECT foto_id, COUNT(id) as jumlah_like FROM likefotos GROUP BY foto_id) as like_counts'), 'fotos.id', '=', 'like_counts.foto_id')
            ->leftJoin('users', 'fotos.user_id', '=', 'users.id')
            ->leftJoin('likefotos as likes', function ($join) {
                $join->on('fotos.id', '=', 'likes.foto_id')
                    ->where('likes.user_id', '=', auth()->user()->id);
            })
            ->where('fotos.user_id', '=', auth()->user()->id)
            ->orderBy('jumlah_like', 'desc')
            // ->inRandomOrder()
            ->take(3)
            ->get();

        foreach ($mostlikes as $photo) {
            $comments = DB::table('komentarfotos')
                ->where('foto_id', $photo->id)
                ->get();

            $photo->comments = $comments;
        }



        $mostcomment = DB::table('fotos')
            ->select('fotos.*', 'users.username', 'users.foto_profil', 'komentar_counts.jumlah_komentar', 'like_counts.jumlah_like', DB::raw("IF(likes.user_id IS NULL, 'BL', 'SL') AS suka"))
            ->leftJoin(DB::raw('(SELECT foto_id, COUNT(id) as jumlah_komentar FROM komentarfotos GROUP BY foto_id) as komentar_counts'), 'fotos.id', '=', 'komentar_counts.foto_id')
            ->leftJoin(DB::raw('(SELECT foto_id, COUNT(id) as jumlah_like FROM likefotos GROUP BY foto_id) as like_counts'), 'fotos.id', '=', 'like_counts.foto_id')
            ->leftJoin('users', 'fotos.user_id', '=', 'users.id')
            ->leftJoin('likefotos as likes', function ($join) {
                $join->on('fotos.id', '=', 'likes.foto_id')
                    ->where('likes.user_id', '=', auth()->user()->id);
            })
            ->where('fotos.user_id', '=', auth()->user()->id)
            ->orderBy('jumlah_komentar', 'desc')
            // ->inRandomOrder()
            ->take(3)
            ->get();

        foreach ($mostcomment as $photo) {
            $comments = DB::table('komentarfotos')
                ->where('foto_id', $photo->id)
                ->get();

            $photo->comments = $comments;
        }

        return view(
            'layout.like',
            [
                "title" => "Search",
                "photoslike" => $photoslike,
                "mostlikes" => $mostlikes,
                "mostcomment" => $mostcomment
            ]
        );
    }
}