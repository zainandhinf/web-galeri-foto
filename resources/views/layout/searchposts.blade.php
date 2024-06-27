{{-- @extends('main')

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

    <div class="row justify-content-center mb-2 mt-4" style="margin-left: -70px;">
        <div class="col-md-6">
            <form action="/catalogs">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Search..." name="search"
                        value="{{ request('search') }}">
                    <button class="btn btn-outline-secondary" type="submit"><i
                            class="fa-solid fa-magnifying-glass text-black search"></i></button>
                </div>
            </form>
        </div>
    </div>

    <hr style="margin-left: -70px;">

    <div class="link-head">
        <a href="#">Posts</a>
        <span></span>
        <a href="/deals">Albums</a>
        <span></span>
        <a href="/deals">Account</a>
    </div>

    <div class="home-container">
        @foreach ($photos as $photo)
            <div class="home-container-post bg-white shadow">
                <div class="home-top-bar">
                    <a href="/view-user/{{ $photo->username }}" class="text-decoration-none fw-bold">
                        <div class="home-profile-img">
                            <img src="{{ asset('storage/' . $photo->foto_profil) }}" alt="">
                            <span class="ms-2 text-black">{{ $photo->username }}</span>
                        </div>
                    </a>
                    <!-- <i class="fa fa-ellipsis-h"></i> -->
                </div>
                <div class="home-main-img">
                    <img src="{{ asset('storage/' . $photo->lokasi_file) }}" alt="">
                </div>
                <div class="home-footer">
                    <div class="home-icons">
                        <div class="home-left-side d-flex">
                            <!-- <i class="fa fa-heart-o" aria-hidden="true"></i> -->
                            @php
                                $likestatus = DB::table('likefotos')
                                    ->select('*')
                                    ->where('user_id', '=', auth()->user()->id)
                                    ->where('foto_id', '=', $photo->id)
                                    ->get();
                                // dd($likestatus);
                            @endphp
                            @if ($photo->suka == 'BL')
                                <form action="/addlike" method="POST">
                                    @csrf
                                    <input type="hidden" name="foto_id" value="{{ $photo->id }}">
                                    <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                                    <button type="submit" style="background: transparent; border: none;"
                                        onclick="this.disabled=true;this.form.submit();">
                                        <i class="fa-regular fa-heart text-danger"></i>
                                    </button>
                                </form>
                            @else
                                <form action="/unlike" method="POST">
                                    @csrf
                                    <input type="hidden" name="foto_id" value="{{ $photo->id }}">
                                    <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                                    <button type="submit" style="background: transparent; border: none;"
                                        onclick="this.disabled=true;this.form.submit();">
                                        <i class="fa-solid fa-heart" style="color: red"></i>
                                    </button>
                                </form>
                            @endif
                            <!-- <i class="fa fa-comment-o" aria-hidden="true"></i> -->
                            <a type="button" data-bs-toggle="modal" data-bs-target="#previewPost{{ $photo->id }}"
                                class="img-post">
                                <i class="fa-regular fa-comment"></i>
                            </a>

                            <!-- <i class="fa fa-paper-o" aria-hidden="true"></i> -->
                            <!-- <i class="fa-regular fa-paper-plane"></i> -->
                        </div>
                        <div class="home-right-side">
                            {{-- <i class="fa fa-bookmark-o" aria-hidden="true"></i> --}}
</div>
</div>
<div class="home-likeCount">
    @if ($photo->jumlah_like == null)
        <p class="text-black">0 Likes</p>
    @else
        <p class="text-black">{{ $photo->jumlah_like }} Likes</p>
    @endif
</div>
<div class="home-content">
    <p>{{ $photo->deskripsi_foto }}</p>
</div>
<div class="home-comment">
    @if ($photo->jumlah_komentar == null)
        <p class="text-black">0 Comments</p>
    @else
        <a type="button" data-bs-toggle="modal" data-bs-target="#previewPost{{ $photo->id }}"
            class="img-post text-decoration-none">
            <p class="text-black">View All {{ $photo->jumlah_komentar }} Comments</p>
        </a>
    @endif
</div>
<div class="home-comment-box" style="border-top: 1px solid #ced4da">
    <!-- <div class="home-icon"></div> -->
    <div class="home-input-field">
        <input type="text" placeholder="Add a Comments..." id="">
    </div>
    <div class="home-btn"><button><i class="fa-regular fa-paper-plane"></i></button></div>
</div>
</div>
</div>
@endforeach
@foreach ($photos as $photo)
    <div class="modal fade modal-xl" id="previewPost{{ $photo->id }}" tabindex="-1"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="popup-container bg-white">
                    <div class="image-post d-flex bg-black">
                        <div class="bg-secondary"
                            style="min-height: 600px; display: flex; justify-content: center;
                                align-items: center;">
                            <img src="{{ asset('storage/' . $photo->lokasi_file) }}" alt="" class=""
                                style="width: 500px; height: auto;">
                        </div>
                        <div class="content-post"
                            style="width: 700px; height: auto; display: flex;flex-direction: column">
                            {{-- <div class="bg-success"
                                        style="height: auto; position: absolute; top: 0px; bottom: 200px; overflow: scroll;"> --}}
                            <div class="" style=" width: 640px; height: 90px; border-bottom: 1px solid #ced4da;">
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
                                                src="{{ asset('storage/' . $photo->foto_profil) }}" alt=""
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
                                                <input type="hidden" name="foto_id" value="{{ $photo->id }}">
                                                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                                                <button type="submit" style="background: transparent; border: none;">
                                                    <i class="fa-regular fa-heart text-black"
                                                        style="font-size: 24px; margin: 10px;"></i>
                                                </button>
                                            </form>
                                        @else
                                            <form action="/unlike" method="POST">
                                                @csrf
                                                <input type="hidden" name="foto_id" value="{{ $photo->id }}">
                                                <input type="hidden" name="user_id"
                                                    value="{{ auth()->user()->id }}">
                                                <button type="submit" style="background: transparent; border: none;">
                                                    <i class="fa-solid fa-heart"
                                                        style="font-size: 24px; margin: 10px; color: red;"></i>
                                                </button>
                                            </form>
                                        @endif
                                        {{-- <i class="fa-regular fa-heart" style="font-size: 24px; margin: 10px;"></i> --}}
                                        <!-- <i class="fa fa-comment-o" aria-hidden="true"></i> -->
                                        <a type="button" data-bs-toggle="modal"
                                            data-bs-target="#previewPost{{ $photo->id }}" class="img-post">
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
                                    <form action="/addcomment" method="POST" style="width: 100%; display: flex">
                                        @csrf
                                        <!-- <div class="popup-icon"></div> -->
                                        <div class="popup-input-field">
                                            <input type="text" placeholder="Add a Comments..." name="isi_komentar"
                                                id=""
                                                style=" width: 580px; padding: 10px; border: none !important; outline: none;">
                                        </div>
                                        <input type="hidden" name="foto_id" value="{{ $photo->id }}">
                                        <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                                        <div class="popup-btn">
                                            <button
                                                style="background: transparent; padding: 10px; outline: none; border: none; color: #207be2; font-weight: 600; cursor: pointer;">
                                                <i class="fa-regular fa-paper-plane" style="font-size: 18px;"></i>
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
</div>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        var addAlbumBtn = document.getElementById('addAlbumBtn');
        var newAlbumForm = document.getElementById('newAlbumForm');
        var newAlbumNameInput = document.getElementById('newAlbumName');

        addAlbumBtn.addEventListener('click', function() {
            newAlbumForm.style.display = 'flex'; // atau 'block', sesuai dengan gaya desain Anda
            newAlbumNameInput.focus();
        });

        document.addEventListener('click', function(event) {
            // Periksa apakah klik diluar formulir album baru
            if (!newAlbumForm.contains(event.target) && event.target !== addAlbumBtn) {
                // Periksa apakah input tidak kosong
                if (newAlbumNameInput.value.trim() !== '') {
                    // Lakukan permintaan AJAX untuk mengirim data formulir
                    // Anda perlu mengimplementasikan bagian ini berdasarkan logika backend Anda
                    // Contoh menggunakan jQuery:
                    // $.post('/submit-new-album', { albumName: newAlbumNameInput.value }, function(data) {
                    //     // Tangani respons dari server
                    // });

                    newAlbumForm.submit();
                    // console.log("hahaaa");
                }

                // Reset formulir dan sembunyikan
                newAlbumNameInput.value = '';
                newAlbumForm.style.display = 'none';
            }
        });
    });

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
@endsection --}}
