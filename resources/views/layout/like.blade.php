@extends('main')

@section('content')
    @if (session()->has('success'))
        <div class="alert alert-success mt-4 me-4 position-absolute end-0" role="alert">
            {{ session('success') }}
        </div>
    @elseif (session()->has('error'))
        <div class="alert alert-danger mt-4 me-4 position-absolute end-0" role="alert">
            {{ session('error') }}
        </div>
    @endif
    {{-- <div class="d-flex justify-content-center align-items-center mb-2 mt-4" style="margin-left: -70px;">
        <div class="col-md-6">
            <form action="/search">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Search..." name="search"
                        value="{{ request('search') }}">
                    <button class="btn btn-outline-primary" type="submit"><i
                            class="fa-solid fa-magnifying-glass text-black search"></i></button>
                </div>
            </form>
        </div>
    </div>

    <hr style="margin-left: -70px;"> --}}

    <div class="link-head mt-5">
        <a style="cursor: pointer;" onclick="showlikedpost()">Liked Post</a>
        <span></span>
        <a style="cursor: pointer;" onclick="showyourpost()">Your Posts</a>
        {{-- <span></span>
        <a style="cursor: pointer;" onclick="showsearchaccount()">Account</a> --}}
    </div>

    <div class="home-container" id="posts-view-liked" style="display: flex;">
        @if ($photoslike->isEmpty())
            <div id="postsContainer-search" class="">
                <div class="no-post-available-search">
                    <h1>~ No Post Available ~</h1>
                </div>
            </div>
        @else
            <div class="posts" data-masonry='{"percentPosition": true }'
                style="margin-left: -5px; width: 1300px; display: flex; justify-content: center;align-items: center;">
                @foreach ($photoslike as $post)
                    <div class="preview-posts">
                        {{-- <button class="show-popup"><img class="" src="{{ asset('storage/' . $post->lokasi_file) }}"
                            alt=""></button> --}}
                        {{-- <div class="popup-container bg-danger" style="display: none;">
                                <div class="popup-box">
                                    <h1>Hello World!</h1>
                                    <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Inventore eius itaque molestiae sit
                                        quidem
                                        ullam, quis ut molestias quas dolores cum ratione, sint quibusdam iusto.</p>
                                <button class="close-btn">OK</button>
                            </div>
                        </div> --}}
                        {{-- <i class="fa-regular fa-comment" style="font-size: 24px;"></i> --}}
                        <a type="button" data-bs-toggle="modal" data-bs-target="#previewPost{{ $post->id }}"
                            class="img-post">

                            <img class="" src="{{ asset('storage/' . $post->lokasi_file) }}" alt="">
                            <div class="view-count-like-comment">
                                @if ($post->jumlah_like == null)
                                    <i class="fa-regular fa-heart text-white" style="font-size: 30px; margin: 10px;"><span
                                            class="fs-4">{{ $post->jumlah_like }}</span></i>
                                @else
                                    <i class="fa-regular fa-heart text-white" style="font-size: 30px; margin: 10px;"><span
                                            class="ms-3 fs-4">{{ $post->jumlah_like }}</span></i>
                                @endif
                                @if ($post->jumlah_komentar == null)
                                    <i class="fa-regular fa-comment text-white" style="font-size: 30px; margin: 10px;"><span
                                            class="fs-4">{{ $post->jumlah_komentar }}</span></i>
                                @else
                                    <i class="fa-regular fa-comment text-white" style="font-size: 30px; margin: 10px;"><span
                                            class="ms-3 fs-4">{{ $post->jumlah_komentar }}</span></i>
                                @endif

                            </div>
                            </img>
                        </a>
                        {{-- <form action="/deleteposts" class="delete-button" method="POST" style="position: absolute; top: 10px;">
                            @method('delete')
                            @csrf
                            <input type="hidden" id="Modal2" name="id_image" value="">
                            <input type="hidden" id="" name="id_catalog" value="">
                            <button class="btn btn-danger btn-lg d-inline"
                                onclick="return confirm('Are you sure you want to delete image?')">
                                <i class="fa-solid fa-trash "></i>
                            </button>
                        </form> --}}
                    </div>
                @endforeach
            </div>

            @foreach ($photoslike as $photo)
                <div class="modal fade modal-xl overflow-hidden" id="previewPost{{ $photo->id }}" tabindex="-1"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="popup-container bg-white">
                                <div class="image-post d-flex bg-black">
                                    <div class="bg-secondary"
                                        style="min-height: 600px; display: flex; justify-content: center;
                                align-items: center;">
                                        <img src="{{ asset('storage/' . $photo->lokasi_file) }}" alt=""
                                            class="" style="width: 500px; height: auto;">
                                    </div>
                                    <div class="content-post"
                                        style="width: 700px; height: auto; display: flex;flex-direction: column">
                                        {{-- <div class="bg-success"
                                        style="height: auto; position: absolute; top: 0px; bottom: 200px; overflow: scroll;"> --}}
                                        <div class=""
                                            style=" width: 640px; height: 90px; border-bottom: 1px solid #ced4da;">
                                            <img class="rounded-circle" src="{{ asset('storage/' . $photo->foto_profil) }}"
                                                alt=""
                                                style="width: 50px; height: 50px; margin-left: 20px; margin-top: 20px; margin-bottom: 20px;">
                                            <span class="text-black ms-2 fw-bold"
                                                style="margin-top: 100px;font-size: 17px;">{{ $photo->username }}</span>
                                        </div>
                                        <div class="content-coment-post"
                                            style="width: 636px; height: auto; position: absolute; top: 90px; bottom: 150px; overflow: auto;">
                                            <div class="" style="display: flex;flex-direction: column;">
                                                <div class="" style="display: flex;flex-direction: column;">
                                                    <div class="" style="height: 70px;">
                                                        <img class="rounded-circle"
                                                            src="{{ asset('storage/' . $photo->foto_profil) }}"
                                                            alt=""
                                                            style="width: 50px; height: 50px; margin-left: 20px; margin-top: 20px;">
                                                        <span class="text-black ms-2 fw-bold"
                                                            style="position: absolute; margin-top: 30px; font-size: 17px;">{{ $photo->username }}</span>
                                                    </div>
                                                    <span class="text-black"
                                                        style="margin-left: 80px;  width:520px; ">{{ $photo->deskripsi_foto }}</span>
                                                </div>
                                            </div>
                                            <hr>
                                            @foreach ($photo->comments as $comment)
                                                @php
                                                    $userComment = DB::table('users')
                                                        ->select('*')
                                                        ->where('id', '=', $comment->user_id)
                                                        ->get();
                                                    // dd($photos);
                                                @endphp
                                                <div class=""
                                                    style="display: flex;flex-direction: column; margin-bottom: -10px;">
                                                    <div class="" style="display: flex;flex-direction: column;">
                                                        <div class="d-flex" style="height: auto;">
                                                            <img class="rounded-circle"
                                                                src="{{ asset('storage/' . $userComment[0]->foto_profil) }}"
                                                                alt=""
                                                                style="width: 50px; height: 50px; margin-left: 20px; margin-top: 20px;">
                                                            <div class="d-flex flex-column" style="margin-top: 30px">
                                                                {{-- <div class="d-flex ms-2 flex-column">

                                                    </div> --}}
                                                                <p class="text-black ms-2 text-break"><span
                                                                        class="text-black fw-bold"
                                                                        style="font-size: 17px;">{{ $userComment[0]->username }}</span>
                                                                    {{ $comment->isi_komentar }}
                                                                </p>
                                                                <span class="text-secondary ms-2"
                                                                    style="font-size: 10px;">{{ \Carbon\Carbon::parse($comment->tanggal_komentar)->diffForHumans() }}</span>
                                                                {{-- <span class="text-black ms-2 bg-danger"
                                                        style="font-size: 17px; width: 400px;">
                                                    </span> --}}
                                                    @if ($userComment[0]->id == auth()->user()->id)
                                                                <form action="/deletecomment" method="POST"
                                                                    class="">
                                                                    @method('delete')
                                                                    @csrf
                                                                    <input type="hidden" name="comment_id"
                                                                        value="{{ $comment->id }}">
                                                                        <input type="hidden" name="status"
                                                                                value="page_like">
                                                                    <button type="submit"
                                                                        style="background: transparent; border: none;">
                                                                        <i class="fa-solid fa-trash"
                                                                            style="font-size: 14px;"></i>
                                                                    </button>
                                                                </form>
                                                            @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                        {{-- </div> --}}
                                        <hr class="bg-danger" style="position: absolute; bottom:300px; height: 10px;">
                                        <div class="footer-content z-1"
                                            style="height: 150px; width: 640px; position:absolute; bottom: 0px; border-top: 1px solid #ced4da; display: flex;flex-direction: column">
                                            <div class="home-icons">
                                                <div class="popup-left-side"
                                                    style="margin-left: 10px; margin-top: 10px; display: flex;">
                                                    <!-- <i class="fa fa-heart-o" aria-hidden="true"></i> -->
                                                    @if ($photo->suka == 'BL')
                                                        <form action="/addlike" method="POST">
                                                            @csrf
                                                            <input type="hidden" name="foto_id"
                                                                value="{{ $photo->id }}">
                                                            <input type="hidden" name="status" value="page_like">
                                                            <input type="hidden" name="user_id"
                                                                value="{{ auth()->user()->id }}">
                                                            <button type="submit"
                                                                style="background: transparent; border: none;">
                                                                <i class="fa-regular fa-heart text-black"
                                                                    style="font-size: 24px; margin: 10px;"></i>
                                                            </button>
                                                        </form>
                                                    @else
                                                        <form action="/unlike" method="POST">
                                                            @csrf
                                                            <input type="hidden" name="foto_id"
                                                                value="{{ $photo->id }}">
                                                            <input type="hidden" name="status" value="page_like">
                                                            <input type="hidden" name="user_id"
                                                                value="{{ auth()->user()->id }}">
                                                            <button type="submit"
                                                                style="background: transparent; border: none;">
                                                                <i class="fa-solid fa-heart"
                                                                    style="font-size: 24px; margin: 10px; color: red;"></i>
                                                            </button>
                                                        </form>
                                                    @endif
                                                    {{-- <i class="fa-regular fa-heart" style="font-size: 24px; margin: 10px;"></i> --}}
                                                    <!-- <i class="fa fa-comment-o" aria-hidden="true"></i> -->
                                                    <a type="button" data-bs-toggle="modal"
                                                        data-bs-target="#previewPost{{ $photo->id }}"
                                                        class="img-post">
                                                        <i class="fa-regular fa-comment"
                                                            style="font-size: 24px; margin: 10px;"></i>
                                                    </a>

                                                    <!-- <i class="fa fa-paper-o" aria-hidden="true"></i> -->
                                                    <!-- <i class="fa-regular fa-paper-plane"></i> -->
                                                </div>
                                                <div class="popup-right-side">
                                                    {{-- <i class="fa fa-bookmark-o" aria-hidden="true"></i> --}}
                                                </div>
                                            </div>
                                            <div class="popup-likeCount"
                                                style="color: #010101; font-size: 14px; margin-left: 20px">
                                                @if ($photo->jumlah_like == null)
                                                    <p class="text-black">0 Likes</p>
                                                @else
                                                    <p class="text-black">{{ $photo->jumlah_like }} Likes</p>
                                                @endif
                                            </div>
                                            <div class="popup-comment-box"
                                                style="width: 625px; height: 60px; display: flex; justify-content: space-between; align-items: center; margin-left: 10px;">
                                                <form action="/addcomment" method="POST"
                                                    style="width: 100%; display: flex">
                                                    @csrf
                                                    <!-- <div class="popup-icon"></div> -->
                                                    <div class="popup-input-field">
                                                        <input type="text" placeholder="Add a Comments..."
                                                            name="isi_komentar" id=""
                                                            style=" width: 580px; padding: 10px; border: none !important; outline: none;">
                                                    </div>
                                                    <input type="hidden" name="foto_id" value="{{ $photo->id }}">
                                                    <input type="hidden" name="user_id"
                                                        value="{{ auth()->user()->id }}">
                                                    <div class="popup-btn">
                                                        <button
                                                            style="background: transparent; padding: 10px; outline: none; border: none; color: #207be2; font-weight: 600; cursor: pointer;">
                                                            <i class="fa-regular fa-paper-plane"
                                                                style="font-size: 18px;"></i>
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>

    <div class="home-container" id="posts-view-user" style="display: none;">
        <h1>~Most Likes~</h1>
        @if ($mostlikes->isEmpty())
            <div id="postsContainer-search" class="">
                <div class="no-post-available-search">
                    <h1>~ No Post Available ~</h1>
                </div>
            </div>
        @else
            <div class="posts"
                style="margin-left: -5px; width: 1300px; display: flex; justify-content: center;align-items: center;">
                @foreach ($mostlikes as $post)
                    <div class="preview-posts">
                        {{-- <button class="show-popup"><img class="" src="{{ asset('storage/' . $post->lokasi_file) }}"
                            alt=""></button> --}}
                        {{-- <div class="popup-container bg-danger" style="display: none;">
                                <div class="popup-box">
                                    <h1>Hello World!</h1>
                                    <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Inventore eius itaque molestiae sit
                                        quidem
                                        ullam, quis ut molestias quas dolores cum ratione, sint quibusdam iusto.</p>
                                <button class="close-btn">OK</button>
                            </div>
                        </div> --}}
                        {{-- <i class="fa-regular fa-comment" style="font-size: 24px;"></i> --}}
                        <a type="button" data-bs-toggle="modal"
                            data-bs-target="#previewPostmostlike{{ $post->id }}" class="img-post">

                            <img class="" src="{{ asset('storage/' . $post->lokasi_file) }}" alt="">
                            <div class="view-count-like-comment">
                                @if ($post->jumlah_like == null)
                                    <i class="fa-regular fa-heart text-white" style="font-size: 30px; margin: 10px;"><span
                                            class="fs-4">{{ $post->jumlah_like }}</span></i>
                                @else
                                    <i class="fa-regular fa-heart text-white" style="font-size: 30px; margin: 10px;"><span
                                            class="ms-3 fs-4">{{ $post->jumlah_like }}</span></i>
                                @endif
                                @if ($post->jumlah_komentar == null)
                                    <i class="fa-regular fa-comment text-white"
                                        style="font-size: 30px; margin: 10px;"><span
                                            class="fs-4">{{ $post->jumlah_komentar }}</span></i>
                                @else
                                    <i class="fa-regular fa-comment text-white"
                                        style="font-size: 30px; margin: 10px;"><span
                                            class="ms-3 fs-4">{{ $post->jumlah_komentar }}</span></i>
                                @endif

                            </div>
                            </img>
                        </a>
                        {{-- <form action="/deleteposts" class="delete-button" method="POST" style="position: absolute; top: 10px;">
                            @method('delete')
                            @csrf
                            <input type="hidden" id="Modal2" name="id_image" value="">
                            <input type="hidden" id="" name="id_catalog" value="">
                            <button class="btn btn-danger btn-lg d-inline"
                                onclick="return confirm('Are you sure you want to delete image?')">
                                <i class="fa-solid fa-trash "></i>
                            </button>
                        </form> --}}
                    </div>
                @endforeach
            </div>

            @foreach ($mostlikes as $photo)
                <div class="modal fade modal-xl overflow-hidden" id="previewPostmostlike{{ $photo->id }}"
                    tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="popup-container bg-white">
                                <div class="image-post d-flex bg-black">
                                    <div class="bg-secondary"
                                        style="min-height: 600px; display: flex; justify-content: center;
                                align-items: center;">
                                        <img src="{{ asset('storage/' . $photo->lokasi_file) }}" alt=""
                                            class="" style="width: 500px; height: auto;">
                                    </div>
                                    <div class="content-post"
                                        style="width: 700px; height: auto; display: flex;flex-direction: column">
                                        {{-- <div class="bg-success"
                                        style="height: auto; position: absolute; top: 0px; bottom: 200px; overflow: scroll;"> --}}
                                        <div class=""
                                            style=" width: 640px; height: 90px; border-bottom: 1px solid #ced4da;">
                                            <img class="rounded-circle"
                                                src="{{ asset('storage/' . $photo->foto_profil) }}" alt=""
                                                style="width: 50px; height: 50px; margin-left: 20px; margin-top: 20px; margin-bottom: 20px;">
                                            <span class="text-black ms-2 fw-bold"
                                                style="margin-top: 100px;font-size: 17px;">{{ $photo->username }}</span>
                                        </div>
                                        <div class="content-coment-post"
                                            style="width: 636px; height: auto; position: absolute; top: 90px; bottom: 150px; overflow: auto;">
                                            <div class="" style="display: flex;flex-direction: column;">
                                                <div class="" style="display: flex;flex-direction: column;">
                                                    <div class="" style="height: 70px;">
                                                        <img class="rounded-circle"
                                                            src="{{ asset('storage/' . $photo->foto_profil) }}"
                                                            alt=""
                                                            style="width: 50px; height: 50px; margin-left: 20px; margin-top: 20px;">
                                                        <span class="text-black ms-2 fw-bold"
                                                            style="position: absolute; margin-top: 30px; font-size: 17px;">{{ $photo->username }}</span>
                                                    </div>
                                                    <span class="text-black"
                                                        style="margin-left: 80px;  width:520px; ">{{ $photo->deskripsi_foto }}</span>
                                                </div>
                                            </div>
                                            <hr>
                                            @foreach ($photo->comments as $comment)
                                                @php
                                                    $userComment = DB::table('users')
                                                        ->select('*')
                                                        ->where('id', '=', $comment->user_id)
                                                        ->get();
                                                    // dd($photos);
                                                @endphp
                                                <div class=""
                                                    style="display: flex;flex-direction: column; margin-bottom: -10px;">
                                                    <div class="" style="display: flex;flex-direction: column;">
                                                        <div class="d-flex" style="height: auto;">
                                                            <img class="rounded-circle"
                                                                src="{{ asset('storage/' . $userComment[0]->foto_profil) }}"
                                                                alt=""
                                                                style="width: 50px; height: 50px; margin-left: 20px; margin-top: 20px;">
                                                            <div class="d-flex flex-column" style="margin-top: 30px">
                                                                {{-- <div class="d-flex ms-2 flex-column">

                                                    </div> --}}
                                                                <p class="text-black ms-2 text-break"><span
                                                                        class="text-black fw-bold"
                                                                        style="font-size: 17px;">{{ $userComment[0]->username }}</span>
                                                                    {{ $comment->isi_komentar }}
                                                                </p>
                                                                <span class="text-secondary ms-2"
                                                                    style="font-size: 10px;">{{ \Carbon\Carbon::parse($comment->tanggal_komentar)->diffForHumans() }}</span>
                                                                {{-- <span class="text-black ms-2 bg-danger"
                                                        style="font-size: 17px; width: 400px;">
                                                    </span> --}}
                                                    @if ($userComment[0]->id == auth()->user()->id)
                                                                <form action="/deletecomment" method="POST"
                                                                    class="">
                                                                    @method('delete')
                                                                    @csrf
                                                                    <input type="hidden" name="comment_id"
                                                                        value="{{ $comment->id }}">
                                                                        <input type="hidden" name="status"
                                                                                value="page_like">
                                                                    <button type="submit"
                                                                        style="background: transparent; border: none;">
                                                                        <i class="fa-solid fa-trash"
                                                                            style="font-size: 14px;"></i>
                                                                    </button>
                                                                </form>
                                                            @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                        {{-- </div> --}}
                                        <hr class="bg-danger" style="position: absolute; bottom:300px; height: 10px;">
                                        <div class="footer-content z-1"
                                            style="height: 150px; width: 640px; position:absolute; bottom: 0px; border-top: 1px solid #ced4da; display: flex;flex-direction: column">
                                            <div class="home-icons">
                                                <div class="popup-left-side"
                                                    style="margin-left: 10px; margin-top: 10px; display: flex;">
                                                    <!-- <i class="fa fa-heart-o" aria-hidden="true"></i> -->
                                                    @if ($photo->suka == 'BL')
                                                        <form action="/addlike" method="POST">
                                                            @csrf
                                                            <input type="hidden" name="foto_id"
                                                                value="{{ $photo->id }}">
                                                            <input type="hidden" name="status" value="page_like">
                                                            <input type="hidden" name="user_id"
                                                                value="{{ auth()->user()->id }}">
                                                            <button type="submit"
                                                                style="background: transparent; border: none;">
                                                                <i class="fa-regular fa-heart text-black"
                                                                    style="font-size: 24px; margin: 10px;"></i>
                                                            </button>
                                                        </form>
                                                    @else
                                                        <form action="/unlike" method="POST">
                                                            @csrf
                                                            <input type="hidden" name="foto_id"
                                                                value="{{ $photo->id }}">
                                                            <input type="hidden" name="status" value="page_like">
                                                            <input type="hidden" name="user_id"
                                                                value="{{ auth()->user()->id }}">
                                                            <button type="submit"
                                                                style="background: transparent; border: none;">
                                                                <i class="fa-solid fa-heart"
                                                                    style="font-size: 24px; margin: 10px; color: red;"></i>
                                                            </button>
                                                        </form>
                                                    @endif
                                                    {{-- <i class="fa-regular fa-heart" style="font-size: 24px; margin: 10px;"></i> --}}
                                                    <!-- <i class="fa fa-comment-o" aria-hidden="true"></i> -->
                                                    <a type="button" data-bs-toggle="modal"
                                                        data-bs-target="#previewPost{{ $photo->id }}"
                                                        class="img-post">
                                                        <i class="fa-regular fa-comment"
                                                            style="font-size: 24px; margin: 10px;"></i>
                                                    </a>

                                                    <!-- <i class="fa fa-paper-o" aria-hidden="true"></i> -->
                                                    <!-- <i class="fa-regular fa-paper-plane"></i> -->
                                                </div>
                                                <div class="popup-right-side">
                                                    {{-- <i class="fa fa-bookmark-o" aria-hidden="true"></i> --}}
                                                </div>
                                            </div>
                                            <div class="popup-likeCount"
                                                style="color: #010101; font-size: 14px; margin-left: 20px">
                                                @if ($photo->jumlah_like == null)
                                                    <p class="text-black">0 Likes</p>
                                                @else
                                                    <p class="text-black">{{ $photo->jumlah_like }} Likes</p>
                                                @endif
                                            </div>
                                            <div class="popup-comment-box"
                                                style="width: 625px; height: 60px; display: flex; justify-content: space-between; align-items: center; margin-left: 10px;">
                                                <form action="/addcomment" method="POST"
                                                    style="width: 100%; display: flex">
                                                    @csrf
                                                    <!-- <div class="popup-icon"></div> -->
                                                    <div class="popup-input-field">
                                                        <input type="text" placeholder="Add a Comments..."
                                                            name="isi_komentar" id=""
                                                            style=" width: 580px; padding: 10px; border: none !important; outline: none;">
                                                    </div>
                                                    <input type="hidden" name="foto_id" value="{{ $photo->id }}">
                                                    <input type="hidden" name="user_id"
                                                        value="{{ auth()->user()->id }}">
                                                    <div class="popup-btn">
                                                        <button
                                                            style="background: transparent; padding: 10px; outline: none; border: none; color: #207be2; font-weight: 600; cursor: pointer;">
                                                            <i class="fa-regular fa-paper-plane"
                                                                style="font-size: 18px;"></i>
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
        <hr>
        <h1>~Most Comments~</h1>
        @if ($mostcomment->isEmpty())
            <div id="postsContainer-search" class="">
                <div class="no-post-available-search">
                    <h1>~ No Post Available ~</h1>
                </div>
            </div>
        @else
            <div class="posts"
                style="margin-left: -5px; width: 1300px; display: flex; justify-content: center;align-items: center;">
                @foreach ($mostcomment as $post)
                    <div class="preview-posts">
                        {{-- <button class="show-popup"><img class="" src="{{ asset('storage/' . $post->lokasi_file) }}"
                            alt=""></button> --}}
                        {{-- <div class="popup-container bg-danger" style="display: none;">
                                <div class="popup-box">
                                    <h1>Hello World!</h1>
                                    <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Inventore eius itaque molestiae sit
                                        quidem
                                        ullam, quis ut molestias quas dolores cum ratione, sint quibusdam iusto.</p>
                                <button class="close-btn">OK</button>
                            </div>
                        </div> --}}
                        {{-- <i class="fa-regular fa-comment" style="font-size: 24px;"></i> --}}
                        <a type="button" data-bs-toggle="modal"
                            data-bs-target="#previewPostmostcomment{{ $post->id }}" class="img-post">

                            <img class="" src="{{ asset('storage/' . $post->lokasi_file) }}" alt="">
                            <div class="view-count-like-comment">
                                @if ($post->jumlah_like == null)
                                    <i class="fa-regular fa-heart text-white" style="font-size: 30px; margin: 10px;"><span
                                            class="fs-4">{{ $post->jumlah_like }}</span></i>
                                @else
                                    <i class="fa-regular fa-heart text-white" style="font-size: 30px; margin: 10px;"><span
                                            class="ms-3 fs-4">{{ $post->jumlah_like }}</span></i>
                                @endif
                                @if ($post->jumlah_komentar == null)
                                    <i class="fa-regular fa-comment text-white"
                                        style="font-size: 30px; margin: 10px;"><span
                                            class="fs-4">{{ $post->jumlah_komentar }}</span></i>
                                @else
                                    <i class="fa-regular fa-comment text-white"
                                        style="font-size: 30px; margin: 10px;"><span
                                            class="ms-3 fs-4">{{ $post->jumlah_komentar }}</span></i>
                                @endif

                            </div>
                            </img>
                        </a>
                        {{-- <form action="/deleteposts" class="delete-button" method="POST" style="position: absolute; top: 10px;">
                            @method('delete')
                            @csrf
                            <input type="hidden" id="Modal2" name="id_image" value="">
                            <input type="hidden" id="" name="id_catalog" value="">
                            <button class="btn btn-danger btn-lg d-inline"
                                onclick="return confirm('Are you sure you want to delete image?')">
                                <i class="fa-solid fa-trash "></i>
                            </button>
                        </form> --}}
                    </div>
                @endforeach
            </div>

            @foreach ($mostcomment as $photo)
                <div class="modal fade modal-xl overflow-hidden" id="previewPostmostcomment{{ $photo->id }}"
                    tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="popup-container bg-white">
                                <div class="image-post d-flex bg-black">
                                    <div class="bg-secondary"
                                        style="min-height: 600px; display: flex; justify-content: center;
                                align-items: center;">
                                        <img src="{{ asset('storage/' . $photo->lokasi_file) }}" alt=""
                                            class="" style="width: 500px; height: auto;">
                                    </div>
                                    <div class="content-post"
                                        style="width: 700px; height: auto; display: flex;flex-direction: column">
                                        {{-- <div class="bg-success"
                                        style="height: auto; position: absolute; top: 0px; bottom: 200px; overflow: scroll;"> --}}
                                        <div class=""
                                            style=" width: 640px; height: 90px; border-bottom: 1px solid #ced4da;">
                                            <img class="rounded-circle"
                                                src="{{ asset('storage/' . $photo->foto_profil) }}" alt=""
                                                style="width: 50px; height: 50px; margin-left: 20px; margin-top: 20px; margin-bottom: 20px;">
                                            <span class="text-black ms-2 fw-bold"
                                                style="margin-top: 100px;font-size: 17px;">{{ $photo->username }}</span>
                                        </div>
                                        <div class="content-coment-post"
                                            style="width: 636px; height: auto; position: absolute; top: 90px; bottom: 150px; overflow: auto;">
                                            <div class="" style="display: flex;flex-direction: column;">
                                                <div class="" style="display: flex;flex-direction: column;">
                                                    <div class="" style="height: 70px;">
                                                        <img class="rounded-circle"
                                                            src="{{ asset('storage/' . $photo->foto_profil) }}"
                                                            alt=""
                                                            style="width: 50px; height: 50px; margin-left: 20px; margin-top: 20px;">
                                                        <span class="text-black ms-2 fw-bold"
                                                            style="position: absolute; margin-top: 30px; font-size: 17px;">{{ $photo->username }}</span>
                                                    </div>
                                                    <span class="text-black"
                                                        style="margin-left: 80px;  width:520px; ">{{ $photo->deskripsi_foto }}</span>
                                                </div>
                                            </div>
                                            <hr>
                                            @foreach ($photo->comments as $comment)
                                                @php
                                                    $userComment = DB::table('users')
                                                        ->select('*')
                                                        ->where('id', '=', $comment->user_id)
                                                        ->get();
                                                    // dd($photos);
                                                @endphp
                                                <div class=""
                                                    style="display: flex;flex-direction: column; margin-bottom: -10px;">
                                                    <div class="" style="display: flex;flex-direction: column;">
                                                        <div class="d-flex" style="height: auto;">
                                                            <img class="rounded-circle"
                                                                src="{{ asset('storage/' . $userComment[0]->foto_profil) }}"
                                                                alt=""
                                                                style="width: 50px; height: 50px; margin-left: 20px; margin-top: 20px;">
                                                            <div class="d-flex flex-column" style="margin-top: 30px">
                                                                {{-- <div class="d-flex ms-2 flex-column">

                                                    </div> --}}
                                                                <p class="text-black ms-2 text-break"><span
                                                                        class="text-black fw-bold"
                                                                        style="font-size: 17px;">{{ $userComment[0]->username }}</span>
                                                                    {{ $comment->isi_komentar }}
                                                                </p>
                                                                <span class="text-secondary ms-2"
                                                                    style="font-size: 10px;">{{ \Carbon\Carbon::parse($comment->tanggal_komentar)->diffForHumans() }}</span>
                                                                {{-- <span class="text-black ms-2 bg-danger"
                                                        style="font-size: 17px; width: 400px;">
                                                    </span> --}}
                                                    @if ($userComment[0]->id == auth()->user()->id)
                                                                <form action="/deletecomment" method="POST"
                                                                    class="">
                                                                    @method('delete')
                                                                    @csrf
                                                                    <input type="hidden" name="comment_id"
                                                                        value="{{ $comment->id }}">
                                                                        <input type="hidden" name="status"
                                                                                value="page_like">
                                                                    <button type="submit"
                                                                        style="background: transparent; border: none;">
                                                                        <i class="fa-solid fa-trash"
                                                                            style="font-size: 14px;"></i>
                                                                    </button>
                                                                </form>
                                                            @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                        {{-- </div> --}}
                                        <hr class="bg-danger" style="position: absolute; bottom:300px; height: 10px;">
                                        <div class="footer-content z-1"
                                            style="height: 150px; width: 640px; position:absolute; bottom: 0px; border-top: 1px solid #ced4da; display: flex;flex-direction: column">
                                            <div class="home-icons">
                                                <div class="popup-left-side"
                                                    style="margin-left: 10px; margin-top: 10px; display: flex;">
                                                    <!-- <i class="fa fa-heart-o" aria-hidden="true"></i> -->
                                                    @if ($photo->suka == 'BL')
                                                        <form action="/addlike" method="POST">
                                                            @csrf
                                                            <input type="hidden" name="foto_id"
                                                                value="{{ $photo->id }}">
                                                            <input type="hidden" name="status" value="page_like">
                                                            <input type="hidden" name="user_id"
                                                                value="{{ auth()->user()->id }}">
                                                            <button type="submit"
                                                                style="background: transparent; border: none;">
                                                                <i class="fa-regular fa-heart text-black"
                                                                    style="font-size: 24px; margin: 10px;"></i>
                                                            </button>
                                                        </form>
                                                    @else
                                                        <form action="/unlike" method="POST">
                                                            @csrf
                                                            <input type="hidden" name="foto_id"
                                                                value="{{ $photo->id }}">
                                                            <input type="hidden" name="status" value="page_like">
                                                            <input type="hidden" name="user_id"
                                                                value="{{ auth()->user()->id }}">
                                                            <button type="submit"
                                                                style="background: transparent; border: none;">
                                                                <i class="fa-solid fa-heart"
                                                                    style="font-size: 24px; margin: 10px; color: red;"></i>
                                                            </button>
                                                        </form>
                                                    @endif
                                                    {{-- <i class="fa-regular fa-heart" style="font-size: 24px; margin: 10px;"></i> --}}
                                                    <!-- <i class="fa fa-comment-o" aria-hidden="true"></i> -->
                                                    <a type="button" data-bs-toggle="modal"
                                                        data-bs-target="#previewPost{{ $photo->id }}"
                                                        class="img-post">
                                                        <i class="fa-regular fa-comment"
                                                            style="font-size: 24px; margin: 10px;"></i>
                                                    </a>

                                                    <!-- <i class="fa fa-paper-o" aria-hidden="true"></i> -->
                                                    <!-- <i class="fa-regular fa-paper-plane"></i> -->
                                                </div>
                                                <div class="popup-right-side">
                                                    {{-- <i class="fa fa-bookmark-o" aria-hidden="true"></i> --}}
                                                </div>
                                            </div>
                                            <div class="popup-likeCount"
                                                style="color: #010101; font-size: 14px; margin-left: 20px">
                                                @if ($photo->jumlah_like == null)
                                                    <p class="text-black">0 Likes</p>
                                                @else
                                                    <p class="text-black">{{ $photo->jumlah_like }} Likes</p>
                                                @endif
                                            </div>
                                            <div class="popup-comment-box"
                                                style="width: 625px; height: 60px; display: flex; justify-content: space-between; align-items: center; margin-left: 10px;">
                                                <form action="/addcomment" method="POST"
                                                    style="width: 100%; display: flex">
                                                    @csrf
                                                    <!-- <div class="popup-icon"></div> -->
                                                    <div class="popup-input-field">
                                                        <input type="text" placeholder="Add a Comments..."
                                                            name="isi_komentar" id=""
                                                            style=" width: 580px; padding: 10px; border: none !important; outline: none;">
                                                    </div>
                                                    <input type="hidden" name="foto_id" value="{{ $photo->id }}">
                                                    <input type="hidden" name="status" value="page_like">
                                                    <input type="hidden" name="user_id"
                                                        value="{{ auth()->user()->id }}">
                                                    <div class="popup-btn">
                                                        <button
                                                            style="background: transparent; padding: 10px; outline: none; border: none; color: #207be2; font-weight: 600; cursor: pointer;">
                                                            <i class="fa-regular fa-paper-plane"
                                                                style="font-size: 18px;"></i>
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>




    <script>
        // document.addEventListener('DOMContentLoaded', function() {
        //     var addAlbumBtn = document.getElementById('addAlbumBtn');
        //     var newAlbumForm = document.getElementById('newAlbumForm');
        //     var newAlbumNameInput = document.getElementById('newAlbumName');

        //     addAlbumBtn.addEventListener('click', function() {
        //         newAlbumForm.style.display = 'flex'; // atau 'block', sesuai dengan gaya desain Anda
        //         newAlbumNameInput.focus();
        //     });

        //     document.addEventListener('click', function(event) {
        //         // Periksa apakah klik diluar formulir album baru
        //         if (!newAlbumForm.contains(event.target) && event.target !== addAlbumBtn) {
        //             // Periksa apakah input tidak kosong
        //             if (newAlbumNameInput.value.trim() !== '') {
        //                 // Lakukan permintaan AJAX untuk mengirim data formulir
        //                 // Anda perlu mengimplementasikan bagian ini berdasarkan logika backend Anda
        //                 // Contoh menggunakan jQuery:
        //                 // $.post('/submit-new-album', { albumName: newAlbumNameInput.value }, function(data) {
        //                 //     // Tangani respons dari server
        //                 // });

        //                 newAlbumForm.submit();
        //                 // console.log("hahaaa");
        //             }

        //             // Reset formulir dan sembunyikan
        //             newAlbumNameInput.value = '';
        //             newAlbumForm.style.display = 'none';
        //         }
        //     });
        // });

        // const showPopup = document.querySelector('.show-popup');
        // const popupContainer = document.querySelector('.popup-container');
        // const closeBtn = document.querySelector('.close-btn');
        // showPopup.onclick = () => {
        //     popupContainer.classList.add('active');
        //     popupContainer.style.display = 'block';
        // }
        // closeBtn.onclick = () => {
        //     popupContainer.classList.remove('active');
        //     popupContainer.style.display = 'none';
        // }

        function showlikedpost() {
            const liked = document.querySelector('#posts-view-liked');
            const postuser = document.querySelector('#posts-view-user');

            liked.style.display = 'flex';
            postuser.style.display = 'none';
        }

        function showyourpost() {
            const liked = document.querySelector('#posts-view-liked');
            const postuser = document.querySelector('#posts-view-user');

            liked.style.display = 'none';
            postuser.style.display = 'flex';
        }

        // document.addEventListener('DOMContentLoaded', function() {
        //     var addAlbumBtn = document.getElementById('addAlbumBtn');
        //     var newAlbumForm = document.getElementById('newAlbumForm');
        //     var newAlbumNameInput = document.getElementById('newAlbumName');
        //     var slugInput = document.getElementById('slug');

        //     addAlbumBtn.addEventListener('click', function() {
        //         newAlbumForm.style.display = 'flex';
        //         newAlbumNameInput.focus();
        //     });

        //     newAlbumForm.addEventListener('submit', function(event) {
        //         event.preventDefault(); // Menghentikan pengiriman formulir otomatis

        //         fetch('/createslug?title=' + newAlbumNameInput.value)
        //             .then(response => response.json())
        //             .then(data => {
        //                 slugInput.value = data.slug;
        //                 newAlbumForm
        //                     .submit(); // Melanjutkan dengan pengiriman formulir setelah membuat slug
        //             });
        //     });

        //     document.addEventListener('click', function(event) {
        //         if (!newAlbumForm.contains(event.target) && event.target !== addAlbumBtn) {
        //             if (newAlbumNameInput.value.trim() !== '') {
        //                 // Lakukan permintaan AJAX untuk mengirim data formulir
        //                 // Anda perlu mengimplementasikan bagian ini berdasarkan logika backend Anda
        //                 // Contoh menggunakan jQuery:
        //                 // $.post('/submit-new-album', { albumName: newAlbumNameInput.value }, function(data) {
        //                 //     // Tangani respons dari server
        //                 // });

        //             }

        //             newAlbumNameInput.value = '';
        //             slugInput.value = '';
        //             newAlbumForm.style.display = 'none';
        //         }
        //     });
        // });


        // const title = document.querySelector('#newAlbumName');
        // const slug = document.querySelector('#slug');

        // title.addEventListener('change', function() {
        //     console.log("jaja");
        //     fetch('/createslug?title=' + title.value)
        //         .then(response => response.json())
        //         .then(data => slug.value = data.slug);
        // });
        // function handleNameAlbumChange() {
        //     var form = document.getElementById('newAlbumForm');

        // }

        // new Glider(document.querySelector('.glider'), {
        //     slidesToShow: 5,
        //     dots: '#dots',
        //     arrows: {
        //         prev: '.glider-prev',
        //         next: '.glider-next'
        //     }
        // });
    </script>
@endsection
