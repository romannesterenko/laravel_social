@extends('admin.layouts.layout')
@section('content')
    <h2 class="py-3">Редактирование поста "{{ $post->title }}"</h2>
    @if($errors->any())
        <div class="alert alert-danger">
            {!! implode('', $errors->all('<i class="fas fa-check-circle"></i> <div>:message</div>')) !!}
        </div>
    @endif
    <div class="col">
        <form method="post" action="{{ route('admin.posts.update', $post) }}" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Title</label>
                <input type="text" name="title" class="form-control" value="{{ $post->title }}" id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>

            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Text</label>
                <textarea class="form-control" name="text" id="exampleFormControlTextarea1" rows="5">{{ $post->text }}</textarea>
            </div>
            <label for="formFile" class="form-label">Picture</label>
            <div class="mb-3">
                <input class="form-control" name="picture[]" multiple type="file" id="formFile" data-browse-on-zone-click="true">
            </div>
            <button type="submit" class="btn btn-primary submit_button">Submit</button>
        </form>
    </div>
@endsection

@section('scripts')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>

    <script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.5.0/js/plugins/buffer.min.js" type="text/javascript"></script>
    <script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.5.0/js/plugins/filetype.min.js" type="text/javascript"></script>

    <!-- piexif.min.js is needed for auto orienting image files OR when restoring exif data in resized images and when you
        wish to resize images before upload. This must be loaded before fileinput.min.js -->
    <script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.5.0/js/plugins/piexif.min.js" type="text/javascript"></script>

    <!-- sortable.min.js is only needed if you wish to sort / rearrange files in initial preview.
        This must be loaded before fileinput.min.js -->
    <script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.5.0/js/plugins/sortable.min.js" type="text/javascript"></script>

    <!-- bootstrap.bundle.min.js below is needed if you wish to zoom and preview file content in a detail modal
        dialog. bootstrap 5.x or 4.x is supported. You can also use the bootstrap js 3.3.x versions. -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

    <!-- the main fileinput plugin script JS file -->
    <script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.5.0/js/fileinput.min.js"></script>

    <!-- following theme script is needed to use the Font Awesome 5.x theme (`fa5`). Uncomment if needed. -->
    <!-- script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.5.0/themes/fa5/theme.min.js"></script -->

    <!-- optionally if you need translation for your language then include the locale file as mentioned below (replace LANG.js with your language locale) -->
    <script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.5.0/js/locales/LANG.js"></script>


    <script>
        $(document).ready(function() {
            var token = $('[name="_token"]');
            var $el1 = $("#formFile");
            $el1.fileinput({
                allowedFileExtensions: ['jpg', 'jpeg', 'png', 'gif', 'webp'],
                uploadUrl: "/store_image",
                uploadAsync: true,
                @if(count($post->images())>0)
                    initialPreview: [
                        @foreach($post->images() as $image)
                            '{{asset('storage/u_images/'.$image->url)}}',
                        @endforeach
                    ],
                    initialPreviewAsData: true,
                    initialPreviewConfig: [
                        @foreach($post->images() as $image)
                            {
                                caption: "{{ $image->id }}",
                                filename: "{{ $image->id }}",
                                downloadUrl: '{{ asset('storage/u_images/'.$image->url) }}',
                                description: "",
                                width: "120px",
                                key: {{ $image->id }}
                            },
                        @endforeach
                    ],
                @endif
                uploadExtraData:{
                    '_token':$(token).val(),
                    'entity': 'post',
                    'user': '{{Auth::id()}}',
                    'post': '{{$post->id}}',
                },
                deleteUrl: "/delete_image",
                overwriteInitial: false, // append files to initial preview
                maxFileCount: 5,
                browseOnZoneClick: true,
                browseClass: "btn btn-info",
                mainClass: "d-grid",
                showCaption: false,
                showCancel: false,
                showBrowse: false,
                showRemove: false,
                showUpload: false,
                ajaxDeleteSettings: {
                    method: 'DELETE',
                    data: {
                        '_token':$(token).val()
                    }
                }
            }).on('fileuploaded', function(event, previewId, index, fileId) {
                $('.submit_button').before('<input type="hidden" data-id="pic_int_'+previewId.response.initialPreviewConfig[0].key+'" name="pics[]" value="'+previewId.response.initialPreviewConfig[0].key+'" />')
            }).on("filebatchselected", function(event, files) {
                $el1.fileinput("upload");
            });


            $('#exampleFormControlTextarea1').summernote({
                tabsize: 1,
                height: 120,
                toolbar: [
                    ['font', ['bold', 'underline', 'italic']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['insert', ['link']],
                ]
            });
        });
    </script>
@endsection
