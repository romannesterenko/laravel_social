@if(Auth::check())
<!-- share box start -->
<div class="card card-small">
    <div class="share-box-inner">
        <!-- profile picture end -->
        <div class="profile-thumb">
            <a href="#">
                <figure class="profile-thumb-middle">
                    <img src="{{ asset('storage/avatar/'.Auth::user()->avatar) }}" alt="profile picture">
                </figure>
            </a>
        </div>
        <!-- profile picture end -->

        <!-- share content box start -->
        <div class="share-content-box w-100">
            <div class="share-text-box">
                <textarea class="share-text-field" aria-disabled="true" placeholder="Nic nowego?" data-toggle="modal" data-target="#textbox" id="email"></textarea>
                <button class="btn-share" data-toggle="modal" data-target="#textbox" >Publikować</button>
            </div>
        </div>
        <!-- share content box end -->

        <!-- Modal start -->
        <div class="modal fade" id="textbox" aria-labelledby="textbox">
            <div class="modal-dialog">
                <form class="modal-content">
                    <input type="hidden" name="author" value="{{Auth::user()->id}}">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Nic nowego?</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body custom-scroll">
                        <input name="title" class="quick_add_input custom-scroll" placeholder="Tytuł postu">
                    </div>
                    <div class="modal-body custom-scroll pb-0">
                        <textarea name="text" class="share-field-big custom-scroll" id="top_editorr" placeholder="Tekst postu"></textarea>
                    </div>

                    <div class="modal-body custom-scroll pt-0">
                        <input class="form-control" name="picture[]" multiple type="file" id="formFile" data-browse-on-zone-click="true">
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="post-share-btn w-50" id="quick_add_button" data-dismiss="modal">Cofnij publikację</button>
                        <button type="button" class="post-share-btn w-50 add_publication">Publikować</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- Modal end -->
    </div>
</div>
<!-- share box end -->

@section('scripts')
     <script>
        $(document).ready(function() {
            var token = $('[name="_token"]');
            var $el1 = $("#formFile");
            $el1.fileinput({
                allowedFileExtensions: ['jpg', 'jpeg', 'png', 'gif', 'webp'],
                uploadUrl: "/store_image",
                uploadAsync: true,
                @if(Auth::check()&&count(Auth::user()->unused_images())>0)
                initialPreview: [
                    @foreach(Auth::user()->unused_images() as $image)
                        '{{asset('storage/u_images/'.$image->url)}}',
                    @endforeach
                ],
                initialPreviewAsData: true,
                initialPreviewConfig: [
                        @foreach(Auth::user()->unused_images() as $image)
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
                },
                deleteUrl: "/delete_image",
                overwriteInitial: false, // append files to initial preview
                maxFileCount: 5,
                browseOnZoneClick: true,
                defaultPreviewContent: '' +
                        '<div class="custom_file_input_label">Przeciągnij i upuść pliki tutaj …<br>(lub kliknij, aby wybrać pliki)</div>',
                browseClass: "post-share-btn w-100",
                browseLabel: "Wybierz obraz",
                mainClass: "d-grid",
                showCaption: false,
                showCancel: false,
                showBrowse: true,
                showRemove: false,
                showUpload: false,
                ajaxDeleteSettings: {
                    method: 'DELETE',
                    data: {
                        '_token':$(token).val()
                    }
                }
            }).on("filebatchselected", function(event, files) {
                $el1.fileinput("upload");
            });

            async function uploadFile(files, editor) {
                const data = new FormData();
                for (let i = 0; i < files.length; i++) {
                    data.append("files[]", files[i]);
                }
                try {
                    const images = (await axios({
                        data,
                        method: 'post',
                        url: "{{ route('summernote.upload') }}",
                    })).data;
                    for (let i = 0; i < images.length; i++) {
                        console.log(images[i]);
                        editor.summernote('insertImage', '/storage/' + images[i], function ($image) {
                            //$image.css('width', '100%');
                        });
                    }
                } catch (e) {
                    console.log(e);
                }
            }

            async function deleteFile(file) {
                const data = new FormData();
                data.append('file', file);
                try {
                    await axios({
                        data,
                        method: 'post',
                        url: "{{ route('summernote.delete') }}",
                    });
                } catch (e) {
                    console.log(e);
                }
            }

            var editor = $('#exampleFormControlTextarea1');
            var config = {
                tabsize: 1,
                height: 120,
                toolbar: [
                    ['font', ['bold', 'underline', 'italic']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['insert', ['link', 'picture', 'video']],
                ],
                callbacks: {
                    onImageUpload: function (files) {
                        uploadFile(files, editor);
                    },
                    onMediaDelete: function ($target) {
                        console.log($target)
                        const url = $target[0].src,
                            cut = "{{ URL::to('/') }}" + "/storage/post_coments",
                            image = url.replace(cut, '');
                        deleteFile(image);
                    }
                }
            }
            editor.summernote(config);
            /*$('#exampleFormControlTextarea1').summernote({
                tabsize: 1,
                height: 120,
                toolbar: [
                    ['font', ['bold', 'underline', 'italic']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['insert', ['link', 'image', 'video']],
                ]
            });*/
        });
    </script>
@endsection
@endif
