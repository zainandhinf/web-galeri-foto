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
            <span class="title">POST</span>
            <div id="postsContainer">
                @php
                    $posts = DB::table('fotos')
                        ->select('*')
                        ->where('album_id', '=', $album[0]->id)
                        ->get();
                    $drafts = DB::table('drafts')
                        ->select('*')
                        ->where('album_id', '=', $album[0]->id)
                        ->get();
                    // dd($drafts);
                @endphp
                @if ($posts->isEmpty() && $drafts->isEmpty())
                    <div id="postsContainer">
                        <div class="no-post-available">
                            <h1>~ No Post Available ~</h1>
                        </div>
                    </div>
                @else
                    <div class="d-flex">
                        <div>
                            @foreach ($posts as $post)
                                <div class="card shadow">
                                    <form action="/editpost" method="POST" enctype="multipart/form-data">
                                        @method('PUT')
                                        @csrf
                                        <div class="card-body d-flex">
                                            <label for="file" class="custom-file-upload-post">
                                                <div class="preview-image-post" id="preview-image-post">
                                                    <img src="{{ asset('storage/' . $post->lokasi_file) }}" alt=""
                                                        class="img-preview img-fluid" style="">
                                                </div>
                                                {{-- <div class="preview-image-post"
                                                    style="width: 300px; height: 300px; display: block; position: absolute; background-color: #6c757d; width: 300px; left: 26px; top: 26px; max-height: 300px; border-radius: 10px; justify-content: center; align-items: center;"
                                                    id="preview-image-post">
                                                    <img src="{{ asset('storage/' . $post->lokasi_file) }}" alt=""
                                                        class="img-preview img-fluid" style="">
                                                </div> --}}
                                                {{-- <div class="icon">
                                                    <svg viewBox="0 0 24 24" fill=""
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                            stroke-linejoin="round"></g>
                                                        <g id="SVGRepo_iconCarrier">
                                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                                d="M10 1C9.73478 1 9.48043 1.10536 9.29289 1.29289L3.29289 7.29289C3.10536 7.48043 3 7.73478 3 8V20C3 21.6569 4.34315 23 6 23H7C7.55228 23 8 22.5523 8 22C8 21.4477 7.55228 21 7 21H6C5.44772 21 5 20.5523 5 20V9H10C10.5523 9 11 8.55228 11 8V3H18C18.5523 3 19 3.44772 19 4V9C19 9.55228 19.4477 10 20 10C20.5523 10 21 9.55228 21 9V4C21 2.34315 19.6569 1 18 1H10ZM9 7H6.41421L9 4.41421V7ZM14 15.5C14 14.1193 15.1193 13 16.5 13C17.8807 13 19 14.1193 19 15.5V16V17H20C21.1046 17 22 17.8954 22 19C22 20.1046 21.1046 21 20 21H13C11.8954 21 11 20.1046 11 19C11 17.8954 11.8954 17 13 17H14V16V15.5ZM16.5 11C14.142 11 12.2076 12.8136 12.0156 15.122C10.2825 15.5606 9 17.1305 9 19C9 21.2091 10.7909 23 13 23H20C22.2091 23 24 21.2091 24 19C24 17.1305 22.7175 15.5606 20.9844 15.122C20.7924 12.8136 18.858 11 16.5 11Z"
                                                                fill=""></path>
                                                        </g>
                                                    </svg>
                                                </div> --}}
                                                {{-- <div class="text">
                                                    <span>Click to upload image</span>
                                                </div> --}}
                                                <div style="display: none;">
                                                    <input type="hidden" name="oldImage" value="{{ $post->lokasi_file }}">
                                                    <input id="file-edit" type="file" onchange="previewImage()"
                                                        name="lokasi_file">
                                                </div>
                                            </label>
                                            {{-- <label for="file" class="custom-file-upload-post">
                                                <div class="preview-image-post" id="preview-image-post">
                                                    <img src="{{ asset('storage/' . $post->lokasi_file) }}" alt=""
                                                        class="img-preview img-fluid" style="">
                                                </div> --}}
                                            {{-- <div class="icon">
                            <svg viewBox="0 0 24 24" fill="" xmlns="http://www.w3.org/2000/svg">
                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round">
                                </g>
                                <g id="SVGRepo_iconCarrier">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M10 1C9.73478 1 9.48043 1.10536 9.29289 1.29289L3.29289 7.29289C3.10536 7.48043 3 7.73478 3 8V20C3 21.6569 4.34315 23 6 23H7C7.55228 23 8 22.5523 8 22C8 21.4477 7.55228 21 7 21H6C5.44772 21 5 20.5523 5 20V9H10C10.5523 9 11 8.55228 11 8V3H18C18.5523 3 19 3.44772 19 4V9C19 9.55228 19.4477 10 20 10C20.5523 10 21 9.55228 21 9V4C21 2.34315 19.6569 1 18 1H10ZM9 7H6.41421L9 4.41421V7ZM14 15.5C14 14.1193 15.1193 13 16.5 13C17.8807 13 19 14.1193 19 15.5V16V17H20C21.1046 17 22 17.8954 22 19C22 20.1046 21.1046 21 20 21H13C11.8954 21 11 20.1046 11 19C11 17.8954 11.8954 17 13 17H14V16V15.5ZM16.5 11C14.142 11 12.2076 12.8136 12.0156 15.122C10.2825 15.5606 9 17.1305 9 19C9 21.2091 10.7909 23 13 23H20C22.2091 23 24 21.2091 24 19C24 17.1305 22.7175 15.5606 20.9844 15.122C20.7924 12.8136 18.858 11 16.5 11Z"
                                        fill=""></path>
                                </g>
                            </svg>
                        </div>
                        <div class="text">
                            <span>Click to upload image</span>
                        </div> --}}
                                            {{-- <input id="file" type="file" onchange="previewImage()"
                                                    name="lokasi_file">
                                            </label> --}}
                                            <div class="input">
                                                <div class="mb-3">
                                                    <label for="exampleFormControlInput1" class="form-label">Title
                                                        Post</label>
                                                    <input type="text" class="form-control" id="exampleFormControlInput1"
                                                        name="judul_foto" value="{{ $post->judul_foto }}">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="deskripsi" class="form-label">
                                                        Description</label>
                                                    <textarea class="form-control" id="deskripsi" rows="8" name="deskripsi_foto" placeholder="Description..">{{ $post->deskripsi_foto }}</textarea>
                                                </div>
                                                <input type="hidden" value="{{ auth()->user()->id }}" name="user_id">
                                                {{-- <input type="hidden" value="{{ $draft->id }}" name="draft_id[]">
                                            <input type="hidden" value="{{ $draft->file_location }}" name="lokasi_file[]">
                                            <input type="hidden" value="{{ $draft->album_id }}" name="album_id"> --}}
                                                <input type="hidden" name="slug" value="{{ $album[0]->slug }}">
                                                <input type="hidden" name="foto_id" value="{{ $post->id }}">

                                                <button type="submit" class="btn btn-primary">Update Post</button>

                                                <input type="hidden" id="post_id_delete" name="post_id_delete"
                                                    value="{{ $post->id }}">
                                                <input type="hidden" id="post_file_delete" name="post_file_location_delete"
                                                    value="{{ $post->lokasi_file }}">
                                                <input type="hidden" name="slug" value="{{ $album[0]->slug }}">
                                                <a class="btn btn-danger" onclick="deletepost()">
                                                    Delete Post
                                                </a>

                                                {{-- <a href="/deletedraft/{{ $draft->id }}">delete</a> --}}
                                                {{-- <form action="/deletedraft" class="me-0" method="POST"
                                            id="deletedraft" style="margin-left: 25px; margin-bottom: 10px;">
                                            @method('delete')
                                            @csrf --}}
                                                {{-- <input type="hidden" id="draft_id_delete" name="draft_id_delete"
                                                value="{{ $draft->id }}">
                                            <input type="hidden" id="draft_file_delete" name="file_location_delete"
                                                value="{{ $draft->file_location }}">
                                            <input type="hidden" name="slug" value="{{ $album[0]->slug }}">
                                            <a class="btn btn-danger" onclick="deletedraft()">
                                                Delete Draft
                                            </a> --}}
                                                {{-- <button class="btn btn-danger" onclick="deletedraft()">
                                            Delete Draft
                                        </button> --}}
                                                {{-- <button class="btn btn-danger"
                                            onclick="return confirm('Are you sure you want to delete draft?')">
                                            Delete Draft
                                        </button> --}}
                                                {{-- </form> --}}
                                            </div>
                                        </div>

                                    </form>

                                </div>
                            @endforeach
                            <div>
                                <form action="/deletepost" class="me-0" method="POST" id="deletepost"
                                    style="display: none; margin-left: 25px; margin-bottom: 10px;">
                                    @method('delete')
                                    @csrf
                                    <input type="hidden" id="input_post_id" name="post_id" value="">
                                    <input type="hidden" id="input_post_file" name="file_location" value="">
                                    <input type="hidden" name="slug" value="{{ $album[0]->slug }}">
                                    <button class="btn btn-danger"
                                        onclick="return confirm('Are you sure you want to delete post?')">
                                        Delete Post
                                    </button>
                                </form>
                            </div>
                            <form id="uploadPostForm" action="/uploadpost" method="POST" enctype="multipart/form-data">
                                @csrf
                                @php
                                    $drafts = DB::table('drafts')
                                        ->select('*')
                                        ->where('album_id', '=', $album[0]->id)
                                        ->get();
                                @endphp
                                @if ($drafts->isEmpty())
                                @else
                                    <hr style="margin-left: -73px">
                                    <h1 class="text-black" style="margin-left: 448px">Draft</h1>
                                    <button type="submit" class="btn btn-primary"
                                        onclick="submitUploadPost()">Upload</button>
                                    @foreach ($drafts as $draft)
                                        <div class="card shadow">
                                            {{-- <form action="/uploadpost" method="POST" enctype="multipart/form-data"> --}}
                                            <div class="card-body d-flex">
                                                <label for="file{{ $draft->id }}" class="custom-file-upload-post">
                                                    <div class="preview-image-post" id="preview-image-post">
                                                        <img src="{{ asset('storage/' . $draft->file_location) }}"
                                                            alt="" class="img-preview img-fluid" style="">
                                                    </div>
                                                    {{-- <div class="icon">
                                        <svg viewBox="0 0 24 24" fill="" xmlns="http://www.w3.org/2000/svg">
                                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round">
                                            </g>
                                            <g id="SVGRepo_iconCarrier">
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                    d="M10 1C9.73478 1 9.48043 1.10536 9.29289 1.29289L3.29289 7.29289C3.10536 7.48043 3 7.73478 3 8V20C3 21.6569 4.34315 23 6 23H7C7.55228 23 8 22.5523 8 22C8 21.4477 7.55228 21 7 21H6C5.44772 21 5 20.5523 5 20V9H10C10.5523 9 11 8.55228 11 8V3H18C18.5523 3 19 3.44772 19 4V9C19 9.55228 19.4477 10 20 10C20.5523 10 21 9.55228 21 9V4C21 2.34315 19.6569 1 18 1H10ZM9 7H6.41421L9 4.41421V7ZM14 15.5C14 14.1193 15.1193 13 16.5 13C17.8807 13 19 14.1193 19 15.5V16V17H20C21.1046 17 22 17.8954 22 19C22 20.1046 21.1046 21 20 21H13C11.8954 21 11 20.1046 11 19C11 17.8954 11.8954 17 13 17H14V16V15.5ZM16.5 11C14.142 11 12.2076 12.8136 12.0156 15.122C10.2825 15.5606 9 17.1305 9 19C9 21.2091 10.7909 23 13 23H20C22.2091 23 24 21.2091 24 19C24 17.1305 22.7175 15.5606 20.9844 15.122C20.7924 12.8136 18.858 11 16.5 11Z"
                                                    fill=""></path>
                                            </g>
                                        </svg>
                                    </div>
                                    <div class="text">
                                        <span>Click to upload image</span>
                                    </div> --}}
                                                    {{-- <input id="file" type="file" onchange="previewImage()" name="lokasi_file"> --}}
                                                </label>
                                                <div class="input">
                                                    <div class="mb-3">
                                                        <label for="exampleFormControlInput1" class="form-label">Title
                                                            Post</label>
                                                        <input type="text" class="form-control"
                                                            id="exampleFormControlInput1" name="judul_foto[]"
                                                            placeholder="*optional..(if not filled in, the post title will use the album name)">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="deskripsi{{ $draft->id }}" class="form-label">
                                                            Description</label>
                                                        <textarea class="form-control" id="deskripsi{{ $draft->id }}" rows="8" name="deskripsi_foto[]"
                                                            placeholder="*optional.."></textarea>
                                                    </div>
                                                    <input type="hidden" value="{{ auth()->user()->id }}"
                                                        name="user_id[]">
                                                    <input type="hidden" value="{{ $draft->id }}" name="draft_id[]">
                                                    <input type="hidden" value="{{ $draft->file_location }}"
                                                        name="lokasi_file[]">
                                                    <input type="hidden" value="{{ $draft->album_id }}"
                                                        name="album_id">
                                                    {{-- <input type="hidden" name="slug" value="{{ $album[0]->slug }}"> --}}
                                                    {{-- <a href="/deletedraft/{{ $draft->id }}">delete</a> --}}
                                                    {{-- <form action="/deletedraft" class="me-0" method="POST"
                                                        id="deletedraft" style="margin-left: 25px; margin-bottom: 10px;">
                                                        @method('delete')
                                                        @csrf --}}
                                                    <input type="hidden" id="draft_id_delete" name="draft_id_delete"
                                                        value="{{ $draft->id }}">
                                                    <input type="hidden" id="draft_file_delete"
                                                        name="file_location_delete" value="{{ $draft->file_location }}">
                                                    <input type="hidden" name="slug" value="{{ $album[0]->slug }}">
                                                    <a class="btn btn-danger" onclick="deletedraft()">
                                                        Delete Draft
                                                    </a>
                                                    {{-- <button class="btn btn-danger" onclick="deletedraft()">
                                                        Delete Draft
                                                    </button> --}}
                                                    {{-- <button class="btn btn-danger"
                                                        onclick="return confirm('Are you sure you want to delete draft?')">
                                                        Delete Draft
                                                    </button> --}}
                                                    {{-- </form> --}}
                                                </div>
                                            </div>
                                            {{--
                        </form> --}}

                                        </div>
                                        {{-- <button class="btn btn-primary mt-3" style="width: 1000px">POST</button> --}}
                                    @endforeach
                                @endif
                            </form>
                        </div>
                        <div>
                            <form action="/deletedraft" class="me-0" method="POST" id="deletedraft"
                                style="display: none; margin-left: 25px; margin-bottom: 10px;">
                                @method('delete')
                                @csrf
                                <input type="hidden" id="input_draft_id" name="draft_id" value="">
                                <input type="hidden" id="input_draft_file" name="file_location" value="">
                                <input type="hidden" name="slug" value="{{ $album[0]->slug }}">
                                <button class="btn btn-danger"
                                    onclick="return confirm('Are you sure you want to delete draft?')">
                                    Delete Draft
                                </button>
                            </form>
                        </div>
                        {{-- <div>
                            @foreach ($drafts as $draft)
                                <form action="/deletedraft" class="me-0" method="POST"
                                    style="margin-left: 25px; margin-bottom: 10px;">
                                    @method('delete')
                                    @csrf
                                    <input type="hidden" id="" name="draft_id" value="{{ $draft->id }}">
                                    <input type="hidden" id="" name="file_location"
                                        value="{{ $draft->file_location }}">
                                    <input type="hidden" name="slug" value="{{ $album[0]->slug }}">
                                    <button class="btn btn-danger"
                                        onclick="return confirm('Are you sure you want to delete draft?')">
                                        Delete Draft
                                    </button>
                                </form>
                            @endforeach
                        </div> --}}
                    </div>
                @endif
            </div>
        </div>
        <span class="line-create-post position-fixed"></span>
        <div class="draft" style="margin-left:30px;">
            <div class="head-draft">
                <span class="text-black">Album</span>
                <span class="line-draft"></span>
            </div>
            <div class="body">
                <form id="draftForm" action="/adddraft" method="POST" enctype="multipart/form-data">
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
                            <span>Click to add new post</span>
                        </div>
                        <input id="file" type="file" name="file_location[]" onchange="handleFileChange()"
                            multiple>
                        <input type="text" name="album_id" value="{{ $album[0]->id }}">
                        <input type="text" name="slug" value="{{ $album[0]->slug }}">
                    </label>
                </form>
                <div class="album-info">
                    <form action="/updatealbum" method="POST">
                        @method('PUT')
                        @csrf
                        <input type="hidden" name="album_id" value="{{ $album[0]->id }}">
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label text-black">Name Album</label>
                            <input type="text" class="form-control" id="exampleFormControlInput1" name="nama_album"
                                value="{{ $album[0]->nama_album }}">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label text-black">Description</label>
                            <input type="text" class="form-control" id="exampleFormControlInput1" name="deskripsi"
                                value="{{ $album[0]->deskripsi }}">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label text-black">Data Created : </label>
                            <span
                                class="fs-5 text-black">{{ \Carbon\Carbon::parse($album[0]->tanggal_dibuat)->format('d-m-Y') }}</span>
                        </div>
                        <button type="submit" class="btn btn-primary">Edit Data</button>
                    </form>
                </div>
                {{-- <div class="card card-draft">
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


                </div> --}}
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
        function handleFileChange() {
            var form = document.getElementById('draftForm');
            form.submit();
        }

        function deletedraft() {
            var draft_id = document.getElementById('draft_id_delete');
            var file = document.getElementById('draft_file_delete');
            var input_draft_id = document.getElementById('input_draft_id');
            var input_draft_file = document.getElementById('input_draft_file');
            var formdelete = document.getElementById('deletedraft');

            input_draft_id.value = draft_id.value;
            input_draft_file.value = file.value;
            console.log(input_draft_id.value);
            console.log(input_draft_file.value);
            console.log(formdelete);


            formdelete.submit();
        }

        function deletepost() {
            var post_id = document.getElementById('post_id_delete');
            var file = document.getElementById('post_file_delete');
            var input_post_id = document.getElementById('input_post_id');
            var input_post_file = document.getElementById('input_post_file');
            var formdelete = document.getElementById('deletepost');

            input_post_id.value = post_id.value;
            input_post_file.value = file.value;
            console.log(input_post_id.value);
            console.log(input_post_file.value);
            console.log(formdelete);


            formdelete.submit();
        }

        // function submitUploadPost() {
        //     console.log("haha");
        //     var formsubmituploadpost = document.getElementById('uploadPostForm');
        //     var formdeletedraft = document.getElementById('deletedraft');

        //     formdeletedraft.style.display = 'none';
        //     formsubmituploadpost.submit();
        // }



        // function handleFileChange() {
        //     var form = document.getElementById('draftForm');
        //     var files = document.getElementById('file').files;

        //     // Loop melalui setiap file yang dipilih
        //     for (var i = 0; i < files.length; i++) {
        //         var formData = new FormData();
        //         formData.append('photo_draft[]', files[i]); // Menggunakan nama yang sama dengan input file di form
        //         formData.append('user_id', form.user_id.value); // Ambil nilai user_id dari form

        //         // Kirim permintaan AJAX untuk setiap file
        //         fetch('/adddraft', {
        //                 method: 'POST',
        //                 body: formData
        //             })
        //             .then(response => {
        //                 if (response.ok) {
        //                     console.log('File uploaded successfully');
        //                 } else {
        //                     console.error('Failed to upload file');
        //                 }
        //             })
        //             .catch(error => console.error('Error:', error));
        //     }
        // }

        function previewImage() {
            const image = document.querySelector('#file-edit');
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
