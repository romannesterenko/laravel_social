<div class="card" id="comments">
    <h4 class="text-center mb-4 pb-2">Lista komentarzy do wpisu</h4>
    @if(Auth::check())
        <form method="post" action="{{ route('comments.create') }}" class="pb-5">
            @csrf
            <input type="hidden" name="user" value="{{ Auth::id() }}">
            <input type="hidden" name="post" value="{{ $post->id }}">
            <textarea class="form-control" name="text" id="top_editor" rows="5"></textarea>
            <button type="submit" class="post-share-btn w-100 add_comment">Publikować komentarz</button>
        </form>
    @endif

    <div class="row">
        <div class="w-100">
            @foreach($post->coments as $coment)
                <div class="d-flex flex-start border-left ml-3 pl-2 pr-3 comment-block" data-coment-id = "{{ $coment->id }}">
                    <img class="shadow-1-strong me-3  load_profile"  role="button" title="Popover Header" data-content="Some content inside the popover"
                         src="{{ $coment->comentUser->avatar_src }}" data-toggle="popover" data-id="{{ $coment->comentUser->id }}" alt="{{ $coment->comentUser->full_name }}" />
                    <div class="flex-grow-1 flex-shrink-1">
                        <div class="comment_bl" data-coment-id = "{{ $coment->id }}">
                            <div class="d-flex justify-content-between align-items-center">
                                <p class="mb-1">
                                    <a href="" class="fw-bolder">{{ $coment->comentUser->full_name }}</a>
                                    <span class="small"> - {{ $coment->created_at->diffForHumans() }}</span>
                                </p>
                                @if(Auth::check())
                                    <div class="d-flex">
                                        <button class="post-meta-like d-flex align-items-center mr-3 reply" data-coment-id = "{{ $coment->id }}">
                                            <i class="bi bi-reply"></i>
                                        </button>
                                        @if($coment->allowEdit())
                                            <button class="post-meta-like d-flex align-items-center mr-3 edit" data-coment-id = "{{ $coment->id }}">
                                                <i class="bi bi-pencil"></i>
                                            </button>
                                            <form action="{{ route('comments.delete', $coment) }}" class="delete_comment_action" style="padding-top: 3px;" method="post">
                                                @csrf
                                                @method('delete')
                                                <input type="hidden" name="id" value="{{$coment->id}}">
                                                <button type="submit" class="post-meta-like d-flex align-items-center mr-3" data-coment-id = "{{ $coment->id }}">
                                                    <i class="bi bi-disc"></i>
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                @endif
                            </div>
                            <p class="mb-0">{!! $coment->text !!}</p>
                            <div class="d-flex py-2 comments-meta-block" data-id="{{ $coment->id }}">
                                <x-comment-meta :coment="$coment"></x-comment-meta>
                            </div>
                        </div>
                        @if($coment->childs->count()>0)
                            @foreach($coment->childs as $coment)
                                <div class="d-flex flex-start mt-4  border-left pl-2 comment-block" data-coment-id = "{{ $coment->id }}">
                                    <img class="shadow-1-strong me-3 load_profile"
                                         src="{{ $coment->comentUser->avatar_src }}" data-id="{{ $coment->comentUser->id }}" alt="{{ $coment->comentUser->full_name }}" />
                                    <div class="flex-grow-1 flex-shrink-1">
                                        <div class="comment_bl" data-coment-id = "{{ $coment->id }}">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <p class="mb-1">
                                                    <a href="">{{ $coment->comentUser->full_name }}</a> <span class="small">- {{ $coment->created_at->diffForHumans() }}</span>
                                                </p>
                                                @if(Auth::check())
                                                    <div class="d-flex">
                                                        <button class="post-meta-like d-flex align-items-center mr-3 reply" data-coment-id = "{{ $coment->id }}">
                                                            <i class="bi bi-reply"></i>
                                                        </button>
                                                        @if($coment->allowEdit())
                                                            <button class="post-meta-like d-flex align-items-center mr-3 edit" data-coment-id = "{{ $coment->id }}">
                                                                <i class="bi bi-pencil"></i>
                                                            </button>
                                                            <form action="{{ route('comments.delete', $coment) }}" class="delete_comment_action" style="padding-top: 3px;" method="post">
                                                                @csrf
                                                                @method('delete')
                                                                <input type="hidden" name="id" value="{{$coment->id}}">
                                                                <button type="submit" class="post-meta-like d-flex align-items-center mr-3" data-coment-id = "{{ $coment->id }}">
                                                                    <i class="bi bi-disc"></i>
                                                                </button>
                                                            </form>
                                                        @endif
                                                    </div>
                                                @endif
                                            </div>
                                            <p class="mb-0">{!! $coment->text !!}</p>
                                            <div class="d-flex py-2 comments-meta-block" data-id="{{ $coment->id }}">
                                                <x-comment-meta :coment="$coment"></x-comment-meta>
                                            </div>
                                        </div>
                                        @if($coment->childs->count()>0)
                                            @foreach($coment->childs as $coment)
                                                <div class="d-flex flex-start mt-4 border-left pl-2">
                                                    <img class="shadow-1-strong me-3 load_profile"
                                                         src="{{ $coment->comentUser->avatar_src }}" data-id="{{ $coment->comentUser->id }}" alt="{{ $coment->comentUser->full_name }}" />

                                                    <div class="flex-grow-1 flex-shrink-1">
                                                        <div class="comment_bl" data-coment-id = "{{ $coment->id }}">
                                                            <div class="d-flex justify-content-between align-items-center">
                                                                <p class="mb-1">
                                                                    <a href="">{{ $coment->comentUser->full_name }}</a> <span class="small">- {{ $coment->created_at->diffForHumans() }}</span>
                                                                </p>
                                                                @if(Auth::check())
                                                                    <div class="d-flex">
                                                                        @if($coment->allowEdit())
                                                                            <button class="post-meta-like d-flex align-items-center mr-3 edit" data-coment-id = "{{ $coment->id }}">
                                                                                <i class="bi bi-pencil"></i>
                                                                            </button>
                                                                            <form action="{{ route('comments.delete', $coment) }}" class="delete_comment_action" method="post">
                                                                                @csrf
                                                                                @method('delete')
                                                                                <input type="hidden" name="id" value="{{$coment->id}}">
                                                                                <button type="submit" class="post-meta-like d-flex align-items-center mr-3" data-coment-id = "{{ $coment->id }}">
                                                                                    <i class="bi bi-disc"></i>
                                                                                </button>
                                                                            </form>
                                                                        @endif
                                                                    </div>
                                                                @endif
                                                            </div>
                                                            <p class="mb-0">{!! $coment->text !!}</p>
                                                            <div class="d-flex py-2 comments-meta-block" data-id="{{ $coment->id }}">
                                                                <x-comment-meta :coment="$coment"></x-comment-meta>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@if(Auth::check())
@section('scripts')
    <script src="{{ asset('assets/js/plugins/tinymce/tinymce.min.js') }}"></script>
    <script>
        let config = {
            selector: "#top_editor",
            height: "150",
            language: 'pl',
            plugins: "emoticons",
            toolbar: "emoticons | undo redo | styleselect | forecolor | bold italic",
            toolbar_location: "bottom",
            menubar: false
        };
        $(document).ready(function() {
            $('.reply').click(function (){
                $('.reply_com_form').remove()
                $('.reply').not($(this)).removeClass('opened')
                tinymce.remove();
                if(!$(this).hasClass('opened')) {
                    $('.comment_bl[data-coment-id="' + $(this).data('coment-id') + '"]').after('' +
                        '<div class="reply_com_form py-4" data-coment-id="' + $(this).data('coment-id') + '">' +
                        '   <form method="post" action="{{ route('comments.create') }}">' +
                        '   <input type="hidden" name="_token" value="' + $('[name="_token"]').val() + '">' +
                        '   <input type="hidden" name="user" value="{{ Auth::id() }}">' +
                        '   <input type="hidden" name="post" value="{{ $post->id }}">' +
                        '   <input type="hidden" name="parent_id" value="' + $(this).data('coment-id') + '">' +
                        '   <textarea class="form-control" name="text" id="top_editor_' + $(this).data('coment-id') + '" rows="5"></textarea>' +
                        '   <button type="submit" class="post-share-btn w-100 add_comment">Publikować komentarz</button>' +
                        '   </form>' +
                        '</div>' +
                        '');
                    config.selector = '#top_editor_' + $(this).data('coment-id');
                    window.tinymce.init(config);
                    $(this).addClass('opened');
                    config.selector = '#top_editor';
                    tinymce.init(config);
                }else{
                    $(this).removeClass('opened');
                    config.selector = '#top_editor';
                    tinymce.init(config);
                }
                /*$('#top_editor_'+$(this).data('coment-id')).summernote({
                    tabsize: 1,
                    height: 60,
                    toolbar: [
                        ['font', ['bold', 'underline', 'italic']],
                        ['para', ['ul', 'ol', 'paragraph']],
                        ['insert', ['link', 'picture']],
                    ]
                });
                var id = $('#top_editor_'+$(this).data('coment-id')).attr('id');*/
            });
            $('.edit').click(function (){
                $('.reply_com_form').remove()
                $('.edit').not($(this)).removeClass('opened')
                tinymce.remove();
                if(!$(this).hasClass('opened')) {
                    let text = '';
                    let block = $('.comment_bl[data-coment-id="' + $(this).data('coment-id') + '"]');
                    $(block).find('p:not(.mb-0):not(.mb-1)').each(function (i, elem) {
                        text += '<p>' + $(elem).html() + '</p>'
                    })
                    $(block).after('' +
                        '<div class="reply_com_form py-4">' +
                        '   <form method="post" action="/comments/update/' + $(this).data('coment-id') + '/">' +
                        '   <input type="hidden" name="_token" value="' + $('[name="_token"]').val() + '">' +
                        '   <input type="hidden" name="user" value="{{ Auth::id() }}">' +
                        '   <input type="hidden" name="post" value="{{ $post->id }}">' +
                        '   <input type="hidden" name="parent_id" value="' + $(this).data('coment-id') + '">' +
                        '   <textarea class="form-control" name="text" id="top_editor_' + $(this).data('coment-id') + '" rows="5">' + text + '</textarea>' +
                        '   <button type="submit" class="post-share-btn w-100 add_comment">Edytuj komentarz</button>' +
                        '   </form>' +
                        '</div>' +
                    '');
                    config.selector = '#top_editor_' + $(this).data('coment-id');
                    tinymce.init(config);
                    config.selector = '#top_editor';
                    tinymce.init(config);
                    $(this).addClass('opened');
                }else{
                    $(this).removeClass('opened');
                    config.selector = '#top_editor';
                    tinymce.init(config);
                }
            });
            tinymce.init(config);
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
@endif
