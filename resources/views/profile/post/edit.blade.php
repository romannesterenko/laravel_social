@extends('partials.main.profile')
@section('profile_content')
    <div class="card card-small">
        <h3 class="title text-center">Utwórz wpis</h3>
        @if($errors->any())
            <div class="alert alert-danger">
                {!! implode('', $errors->all('<i class="fas fa-check-circle"></i> <div>:message</div>')) !!}
            </div>
        @endif
        <div class="col">
            <form action="{{ route('posts.update_post', $post) }}" method="post">
                @csrf
                <input type="hidden" name="author" value="{{ Auth::id() }}">
                <div class="mb-3 mt-3">
                    <label for="title" class="form-label fw-bold">Nazwa postu</label>
                    <input type="text" name="title" class="form-control_custom" value="{{ $post->title }}" id="title">
                </div>
                <div class="mb-3">
                    <label for="mytextarea" class="form-label fw-bold">Text postu</label>
                    <textarea name="text" class="form-control_custom" id="mytextarea" placeholder="Nic nowego?">{{ $post->text }}</textarea>
                </div>

                <div class="mb-3 d-flex">
                    <div class="customRadio pr-3">
                        <input type="radio" name="typePost" value="gallery" id="dreamweaver" @if($post->typePost=='gallery')checked @endif>
                        <label for="dreamweaver" class="fw-bold"><i class="bi-image pr-1"></i>Dodaj obrazy do posta</label>
                    </div>
                    <div class="customRadio pr-3">
                        <input type="radio" name="typePost" value="video" id="sublime" @if($post->typePost=='video')checked @endif>
                        <label for="sublime" class="fw-bold"><i class="bi-youtube pr-1"></i>Dodaj wideo do posta</label>
                    </div>
                </div>
                <div class="mb-3 check_box_block video_block">
                    <label for="video" class="form-label fw-bold">Link do filmu na Youtube</label>
                    <input type="text" name="video" class="form-control_custom" value="{{ $post->video }}" id="video">
                    <div class="my-3 video_preview">
                        <div id="player"></div>
                    </div>
                </div>
                <div class="mb-3 check_box_block unused_images_block gallery_block">
                    <x-post-images :post="$post"></x-post-images>
                </div>
                <div class="mb-3 d-flex justify-content-end">
                    <div class="d-flex">
                        <button class="post-share-btn" type="submit"><i class="bi-file-post pr-1"></i> Publikować</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('scripts')
    <style>
        .video_preview {
            width: 100%;
            height: 400px;
            border: 1px solid #444444;
            overflow: hidden;
            position: relative;
        }
        .video_preview iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }
    </style>
    <style>
        .tox.tox-tinymce{
            margin-bottom: 15px;
        }
        .tox-statusbar{
            display: none!important;
        }
    </style>
    <script src="{{ asset('assets/js/plugins/tinymce/tinymce.min.js') }}"></script>
    <script>
        tinymce.init({
            selector: "#mytextarea",
            height: "200",
            plugins: "emoticons",
            toolbar: "emoticons | undo redo | styleselect | forecolor | bold italic",
            toolbar_location: "bottom",
            menubar: false
        });
    </script>
@endsection
