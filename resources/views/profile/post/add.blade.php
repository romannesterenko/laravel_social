@extends('partials.main.profile')
@section('styles')
    <!-- include summernote css/js -->

@endsection
@section('profile_content')
    <div class="card card-small">
        <h3 class="title text-center">Utwórz wpis</h3>
        @if($errors->any())
            <div class="alert alert-danger">
                {!! implode('', $errors->all('<div class="d-flex"><i class="bi bi-check"></i> <div>:message</div></div>')) !!}
            </div>
        @endif
        <div class="col">
            <form action="{{ route('posts.add_post') }}" method="post">
                @csrf
                <input type="hidden" name="author" value="{{ Auth::id() }}">

                <div class="mb-3 mt-3">
                    <label for="title" class="form-label fw-bold">Opublikuj w społeczności</label>
                    <select name="community" class="form-control_custom form-control_select mb-3">
                        <option value="0">Publikowanie poza społecznością</option>
                        @foreach($communities as $community)
                            <option value="{{$community->id}}" @if(!empty($_REQUEST['in_community'])&&$community->id==$_REQUEST['in_community']) selected @endif>{{$community->title}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3 mt-3">
                    <label for="title" class="form-label fw-bold">Nazwa postu</label>
                    <input type="text" name="title" class="form-control_custom" value="{{ old('title') }}" id="title">
                </div>
                <div class="mb-3">
                    <label for="mytextarea" class="form-label fw-bold">Text postu</label>
                    <textarea name="text" class="form-control_custom" id="mytextarea" placeholder="Nic nowego?">{{ old('text') }}</textarea>
                </div>
                <div class="mb-3 d-flex">
                    <div class="customRadio pr-3">
                        <input type="radio" name="typePost" value="gallery" id="dreamweaver" checked >
                        <label for="dreamweaver" class="fw-bold"><i class="bi-image pr-1"></i>Dodaj obrazy do posta</label>
                    </div>
                    <div class="customRadio pr-3">
                        <input type="radio" name="typePost" value="video" id="sublime">
                        <label for="sublime" class="fw-bold"><i class="bi-youtube pr-1"></i>Dodaj wideo do posta</label>
                    </div>
                </div>
                <div class="mb-3 check_box_block video_block">
                    <label for="video" class="form-label fw-bold">Link do filmu na Youtube</label>
                    <input type="text" name="video" class="form-control_custom" value="{{ old('video') }}" id="video">
                    <div class="py-3 video_preview">
                        <div id="player"></div>
                    </div>
                </div>
                <div class="mb-3 check_box_block unused_images_block gallery_block">
                    <x-unused-images></x-unused-images>
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
    <script src="{{ asset('assets/js/plugins/tinymce/tinymce.min.js') }}"></script>
    <script>
        tinymce.init({
            selector: "#mytextarea",
            height: "200",
            language: 'pl',
            plugins: "emoticons",
            toolbar: "emoticons | undo redo | styleselect | forecolor | bold italic",
            toolbar_location: "bottom",
            menubar: false
        });
    </script>
    <style>
        .tox.tox-tinymce{
            margin-bottom: 15px;
        }
        .tox-statusbar{
            display: none!important;
        }
    </style>
@endsection
