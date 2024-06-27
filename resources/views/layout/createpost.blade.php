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
    <div class="d-flex">
        <div class="post-form">
            <span class="title">NEW POST</span>
            <div id="postsContainer">
                <div class="card">
                    <form action="/uploadpost" method="POST" enctype="multipart/form-data">
                        <div class="card-body d-flex">
                            @csrf
                            <label for="file" class="custom-file-upload">
                                <div class="preview-image-post"
                                    style="width: 300px; height: 300px; display: none; position: absolute; background-color: #6c757d; width: 300px; left: 26px; top: 26px; max-height: 300px; border-radius: 10px; justify-content: center; align-items: center;"
                                    id="preview-image-post">
                                    <img src="" alt="" class="img-preview img-fluid" style="">
                                </div>
                                <div class="icon">
                                    <svg viewBox="0 0 24 24" fill="" xmlns="http://www.w3.org/2000/svg">
                                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                        <g id="SVGRepo_iconCarrier">
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M10 1C9.73478 1 9.48043 1.10536 9.29289 1.29289L3.29289 7.29289C3.10536 7.48043 3 7.73478 3 8V20C3 21.6569 4.34315 23 6 23H7C7.55228 23 8 22.5523 8 22C8 21.4477 7.55228 21 7 21H6C5.44772 21 5 20.5523 5 20V9H10C10.5523 9 11 8.55228 11 8V3H18C18.5523 3 19 3.44772 19 4V9C19 9.55228 19.4477 10 20 10C20.5523 10 21 9.55228 21 9V4C21 2.34315 19.6569 1 18 1H10ZM9 7H6.41421L9 4.41421V7ZM14 15.5C14 14.1193 15.1193 13 16.5 13C17.8807 13 19 14.1193 19 15.5V16V17H20C21.1046 17 22 17.8954 22 19C22 20.1046 21.1046 21 20 21H13C11.8954 21 11 20.1046 11 19C11 17.8954 11.8954 17 13 17H14V16V15.5ZM16.5 11C14.142 11 12.2076 12.8136 12.0156 15.122C10.2825 15.5606 9 17.1305 9 19C9 21.2091 10.7909 23 13 23H20C22.2091 23 24 21.2091 24 19C24 17.1305 22.7175 15.5606 20.9844 15.122C20.7924 12.8136 18.858 11 16.5 11Z"
                                                fill=""></path>
                                        </g>
                                    </svg>
                                </div>
                                <div class="text">
                                    <span>Click to upload image</span>
                                </div>
                                <input id="file" type="file" onchange="previewImage()" name="lokasi_file" required>
                            </label>
                            <div class="input">
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Title Post</label>
                                    <input type="text" class="form-control" id="exampleFormControlInput1"
                                        name="judul_foto" required>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleFormControlTextarea1" class="form-label">
                                        Description</label>
                                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="deskripsi_foto" required></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleFormControlTextarea1" class="form-label">
                                        Choose Album</label>
                                    <select class="form-select" name="album_id" aria-label="Default select example">
                                        @php
                                            $albums = DB::table('albums')
                                                ->select('*')
                                                ->where('user_id', '=', auth()->user()->id)
                                                ->get();
                                        @endphp
                                        @foreach ($albums as $album)
                                            <option value="{{ $album->id }}">{{ $album->nama_album }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <input type="hidden" value="{{ auth()->user()->id }}" name="user_id">
                            </div>
                        </div>
                </div>
                <button class="btn btn-primary mt-3" style="width: 1000px">POST</button>
                </form>
                <div id="newPostForm" style="display: none;">
                    <div class="card">
                        <div class="card-body d-flex">
                            <label for="file" class="custom-file-upload">
                                <div class="icon">
                                    <svg viewBox="0 0 24 24" fill="" xmlns="http://www.w3.org/2000/svg">
                                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                        <g id="SVGRepo_iconCarrier">
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M10 1C9.73478 1 9.48043 1.10536 9.29289 1.29289L3.29289 7.29289C3.10536 7.48043 3 7.73478 3 8V20C3 21.6569 4.34315 23 6 23H7C7.55228 23 8 22.5523 8 22C8 21.4477 7.55228 21 7 21H6C5.44772 21 5 20.5523 5 20V9H10C10.5523 9 11 8.55228 11 8V3H18C18.5523 3 19 3.44772 19 4V9C19 9.55228 19.4477 10 20 10C20.5523 10 21 9.55228 21 9V4C21 2.34315 19.6569 1 18 1H10ZM9 7H6.41421L9 4.41421V7ZM14 15.5C14 14.1193 15.1193 13 16.5 13C17.8807 13 19 14.1193 19 15.5V16V17H20C21.1046 17 22 17.8954 22 19C22 20.1046 21.1046 21 20 21H13C11.8954 21 11 20.1046 11 19C11 17.8954 11.8954 17 13 17H14V16V15.5ZM16.5 11C14.142 11 12.2076 12.8136 12.0156 15.122C10.2825 15.5606 9 17.1305 9 19C9 21.2091 10.7909 23 13 23H20C22.2091 23 24 21.2091 24 19C24 17.1305 22.7175 15.5606 20.9844 15.122C20.7924 12.8136 18.858 11 16.5 11Z"
                                                fill=""></path>
                                        </g>
                                    </svg>
                                </div>
                                <div class="text">
                                    <span>Click to upload image</span>
                                </div>
                                <input id="file" type="file">
                            </label>
                            <div class="input">
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Title Post</label>
                                    <input type="text" class="form-control" id="exampleFormControlInput1">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleFormControlTextarea1" class="form-label">
                                        Description</label>
                                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tombol tambah berada di luar elemen yang akan ditambahkan -->
            {{-- <span class="button-create-card-post">
            <button id="addPostBtn" class="fa-solid fa-plus text-white"></button>
        </span> --}}



            {{-- <span class="button-create-card-post">
            <button id="addPostBtn" class="fa-solid fa-plus text-white"></button>
        </span> --}}

        </div>
        <span class="line-create-post"></span>
        <div class="draft">
            <div class="head-draft">
                <span class="text-white">Draft</span>
                <span class="line-draft"></span>
            </div>
            <div class="body">
                <form action="/adddraft" method="POST" enctype="multipart/form-data">
                    @csrf
                    <label for="file" class="custom-file-upload-draft">
                        <div class="icon">
                            <svg viewBox="0 0 24 24" fill="" xmlns="http://www.w3.org/2000/svg">
                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                <g id="SVGRepo_iconCarrier">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M10 1C9.73478 1 9.48043 1.10536 9.29289 1.29289L3.29289 7.29289C3.10536 7.48043 3 7.73478 3 8V20C3 21.6569 4.34315 23 6 23H7C7.55228 23 8 22.5523 8 22C8 21.4477 7.55228 21 7 21H6C5.44772 21 5 20.5523 5 20V9H10C10.5523 9 11 8.55228 11 8V3H18C18.5523 3 19 3.44772 19 4V9C19 9.55228 19.4477 10 20 10C20.5523 10 21 9.55228 21 9V4C21 2.34315 19.6569 1 18 1H10ZM9 7H6.41421L9 4.41421V7ZM14 15.5C14 14.1193 15.1193 13 16.5 13C17.8807 13 19 14.1193 19 15.5V16V17H20C21.1046 17 22 17.8954 22 19C22 20.1046 21.1046 21 20 21H13C11.8954 21 11 20.1046 11 19C11 17.8954 11.8954 17 13 17H14V16V15.5ZM16.5 11C14.142 11 12.2076 12.8136 12.0156 15.122C10.2825 15.5606 9 17.1305 9 19C9 21.2091 10.7909 23 13 23H20C22.2091 23 24 21.2091 24 19C24 17.1305 22.7175 15.5606 20.9844 15.122C20.7924 12.8136 18.858 11 16.5 11Z"
                                        fill=""></path>
                                </g>
                            </svg>
                        </div>
                        <div class="text">
                            <span>Click to add new draft</span>
                        </div>
                        <input id="file" type="file" name="photo_draft">
                        <input type="text" name="user_id" value="{{ auth()->user()->id }}">
                    </label>
                </form>
                <div class="card card-draft">
                    <div class="card-body">
                        <label class="custom-draft-view d-flex">
                            <div class="img-draft">
                                <button>
                                    <img src="assets/img/posts-test.jpg" alt="">
                                </button>
                            </div>
                            <button class="btn button-delete-draft btn-danger"
                                onclick="return confirm('Are you sure you want to delete draft?')">
                                <i class="fa-solid fa-trash "></i>
                            </button>
                        </label>

                    </div>


                </div>
            </div>
        </div>
    </div>



    {{-- <script>
        document.addEventListener('DOMContentLoaded', function() {
            var addButton = document.getElementById('addPostBtn');
            var postsContainer = document.getElementById('postsContainer');

            addButton.addEventListener('click', function() {
                // Buat elemen baru
                var newPostForm = document.createElement('div');
                newPostForm.className = 'new-post-form'; // Tambahkan kelas baru jika diperlukan

                // Isi elemen baru dengan konten form posting baru
                newPostForm.innerHTML = `
            <div class="card">
                <div class="card-body d-flex">
                    <label for="file" class="custom-file-upload">
                        <div class="icon">
                            <svg viewBox="0 0 24 24" fill="" xmlns="http://www.w3.org/2000/svg">
                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                <g id="SVGRepo_iconCarrier">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M10 1C9.73478 1 9.48043 1.10536 9.29289 1.29289L3.29289 7.29289C3.10536 7.48043 3 7.73478 3 8V20C3 21.6569 4.34315 23 6 23H7C7.55228 23 8 22.5523 8 22C8 21.4477 7.55228 21 7 21H6C5.44772 21 5 20.5523 5 20V9H10C10.5523 9 11 8.55228 11 8V3H18C18.5523 3 19 3.44772 19 4V9C19 9.55228 19.4477 10 20 10C20.5523 10 21 9.55228 21 9V4C21 2.34315 19.6569 1 18 1H10ZM9 7H6.41421L9 4.41421V7ZM14 15.5C14 14.1193 15.1193 13 16.5 13C17.8807 13 19 14.1193 19 15.5V16V17H20C21.1046 17 22 17.8954 22 19C22 20.1046 21.1046 21 20 21H13C11.8954 21 11 20.1046 11 19C11 17.8954 11.8954 17 13 17H14V16V15.5ZM16.5 11C14.142 11 12.2076 12.8136 12.0156 15.122C10.2825 15.5606 9 17.1305 9 19C9 21.2091 10.7909 23 13 23H20C22.2091 23 24 21.2091 24 19C24 17.1305 22.7175 15.5606 20.9844 15.122C20.7924 12.8136 18.858 11 16.5 11Z"
                                        fill=""></path>
                                </g>
                            </svg>
                        </div>
                        <div class="text">
                            <span>Click to upload image</span>
                        </div>
                        <input id="file" type="file">
                    </label>
                    <div class="input">
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Title Post</label>
                            <input type="text" class="form-control" id="exampleFormControlInput1">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">
                                Description</label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                        </div>
                    </div>
                </div>
            </div>
        `;

                // Tambahkan elemen baru ke dalam #postsContainer
                postsContainer.appendChild(newPostForm);
            });

            // Tambahkan event listener untuk menyembunyikan form jika diklik di luar form
            document.addEventListener('click', function(event) {
                var newPostForms = document.querySelectorAll('.new-post-form');

                newPostForms.forEach(function(newPostForm) {
                    // Pastikan bahwa yang diklik bukan tombol dan elemen form
                    if (event.target !== addButton && !newPostForm.contains(event.target)) {
                        // Lakukan sesuatu, misalnya mengirimkan form
                        // Contoh: fetch('/createpost', { method: 'POST', body: new FormData(newPostForm) })

                        // Hapus elemen baru dari dokumen
                        newPostForm.parentNode.removeChild(newPostForm);
                    }
                });
            });
        });
    </script> --}}
    <script>
        function previewImage() {
            const image = document.querySelector('#file');
            const divimage = document.querySelector('#preview-image-post');
            const imagePreview = document.querySelector('.img-preview');

            imagePreview.style.display = 'block';
            divimage.style.display = 'flex';

            const oFReader = new FileReader();
            oFReader.readAsDataURL(image.files[0]);

            oFReader.onload = function(ofREvent) {
                imagePreview.src = ofREvent.target.result;
            }
        }

        // document.addEventListener('DOMContentLoaded', function() {
        //     var fileInput = document.getElementById('file');
        //     var form = document.getElementById('draftForm');

        //     fileInput.addEventListener('change', function() {
        //         // Periksa apakah ada file yang dipilih
        //         if (fileInput.files.length > 0) {
        //             // Buat FormData untuk mengirim formulir dengan file
        //             var formData = new FormData(form);

        //             // Kirim formulir menggunakan XMLHttpRequest
        //             var xhr = new XMLHttpRequest();
        //             xhr.open('POST', '/adddraft', true);

        //             xhr.onload = function() {
        //                 if (xhr.status >= 200 && xhr.status < 300) {
        //                     // Sukses, lakukan sesuatu jika diperlukan
        //                     console.log('Draft berhasil disimpan:', xhr.responseText);
        //                 } else {
        //                     // Terjadi kesalahan, tindakan yang sesuai
        //                     console.error('Gagal menyimpan draft:', xhr.statusText);
        //                 }
        //             };

        //             // Kirim data formulir
        //             xhr.send(formData);
        //         }
        //     });
        // });
    </script>
@endsection
