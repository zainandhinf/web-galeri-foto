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
        <div class="profile-user">
            <span class="title-edit-profile">EDIT PROFILE</span>
            <div id="postsContainer">
                <div class="card card-profile shadow">
                    <form action="/updateprofile" method="POST" enctype="multipart/form-data">
                        <div class="card-body d-flex">
                            @csrf
                            @method('PUT')
                            @php
                                $userData = DB::table('users')
                                    ->select('*')
                                    ->where('id', '=', auth()->user()->id)
                                    ->get();
                            @endphp
                            <label for="file" class="custom-file-upload">
                                @if ($userData[0]->foto_profil == null)
                                    <div class="preview-image-post"
                                        style="width: 300px; height: 300px; display: none; position: absolute; background-color: #6c757d; width: 300px; left: 26px; top: 26px; max-height: 300px; border-radius: 10px; justify-content: center; align-items: center;"
                                        id="preview-image-post">
                                        <img src="" alt="" class="img-preview img-fluid" style="">
                                    </div>
                                @else
                                    <div class="preview-image-post"
                                        style="width: 300px; height: 300px; display: block; position: absolute; background-color: #6c757d; width: 300px; left: 26px; top: 26px; max-height: 300px; border-radius: 10px; justify-content: center; align-items: center;"
                                        id="preview-image-post">
                                        <img src="{{ asset('storage/' . auth()->user()->foto_profil) }}" alt=""
                                            class="img-preview img-fluid" style="">
                                    </div>
                                @endif
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

                                <input type="hidden" name="oldImage" value="{{ $userData[0]->foto_profil }}">
                                <input id="file" type="file" onchange="previewImage()" name="lokasi_file">
                            </label>
                            <div class="input">
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Username</label>
                                    <input type="text" class="form-control" id="exampleFormControlInput1" name="username"
                                        value="{{ old('username', $userData[0]->username) }}">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Email</label>
                                    <input type="text" class="form-control" id="exampleFormControlInput1" name="email"
                                        value="{{ old('username', $userData[0]->email) }}">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Nama Lengkap</label>
                                    <input type="text" class="form-control" id="exampleFormControlInput1"
                                        name="nama_lengkap" value="{{ old('username', $userData[0]->nama_lengkap) }}">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Alamat</label>
                                    <input type="text" class="form-control" id="exampleFormControlInput1" name="alamat"
                                        value="{{ old('username', $userData[0]->alamat) }}">
                                </div>
                                <input type="hidden" value="{{ auth()->user()->id }}" name="user_id">
                            </div>
                            <div class="mb-3 me-3 mt-2 ms-3">
                                <label for="exampleFormControlTextarea1" class="form-label">
                                    Bio</label>
                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="bio"
                                    style="width: 290px; height: 300px;">{{ $userData[0]->bio }}</textarea>
                            </div>
                        </div>
                </div>
                <button class="btn btn-primary mt-3" style="width: 1300px">Edit Profile</button>
                </form>
                <div class="card card-profile shadow">
                    <h3 class="text-center mt-4">Edit Password</h3>
                    <form action="/updatepassword" method="POST" enctype="multipart/form-data">
                        <div class="card-body d-flex">
                            @csrf
                            @method('PUT')
                            @php
                                $userData = DB::table('users')
                                    ->select('*')
                                    ->where('id', '=', auth()->user()->id)
                                    ->get();
                            @endphp
                            <div class="input">
                                <div class="mb-3" style="width: 1200px;">
                                    <label for="exampleFormControlInput1" class="form-label">Old Password</label>
                                    <input type="password" class="form-control" id="exampleFormControlInput1"
                                        name="oldpassword" style="width: 100%">
                                </div>
                                <div class="mb-3" style="width: 1200px;">
                                    <label for="exampleFormControlInput1" class="form-label">New Password</label>
                                    <input type="password" class="form-control" id="exampleFormControlInput1"
                                        name="newpassword" style="width: 100%">
                                </div>
                                <div class="mb-3" style="width: 1200px;">
                                    <label for="exampleFormControlInput1" class="form-label">Confirm New Password</label>
                                    <input type="password" class="form-control" id="exampleFormControlInput1"
                                        name="confirmnewpassword" style="width: 100%">
                                </div>
                                <input type="hidden" value="{{ auth()->user()->id }}" name="user_id">
                            </div>
                        </div>
                </div>
                <button class="btn btn-primary mt-3" style="width: 1300px">Edit Password</button>
                </form>
            </div>
        </div>
    </div>

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
    </script>
@endsection
