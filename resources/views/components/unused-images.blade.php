@if(count(Auth::user()->unused_images())<4)
<label id="drop_zone" data-user-id="{{ Auth::id() }}" data-max="{{4-count(Auth::user()->unused_images())}}">
    <input type="file" data-user-id="{{ Auth::id() }}" name="files[]" style="display: none"/>
    <p>Przeciągnij jeden lub więcej obrazów do tej strefy zrzutu lub kliknij, aby wybrać obrazy.</p>
</label>
@endif
@if(count(Auth::user()->unused_images())>0)
    @if(count(Auth::user()->unused_images())==1)
        @foreach(Auth::user()->unused_images() as $key => $image)
            <div class="col-12" style="padding-right: 0; padding-left: 0">
                <figure class="post-thumb" style="height: 100%">
                    <img class="fit-cover" src="{{ asset('storage/u_images/'.$image->url) }}" alt="_{{$key}}">
                </figure>
                <button class="delete_picture_button" data-toggle="modal" data-target="#exampleModal{{ $image->id }}" data-id="{{ $image->id }}"><i class="bi-trash"></i></button>
                <div class="modal fade form-modal" id="exampleModal{{ $image->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <input type="hidden" name="id" value="{{ $image->id }}">
                @csrf
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Usuwanie obrazu</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            Czy na pewno chcesz usunąć ten obraz?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="post-share-btn decline_delete_image" data-dismiss="modal">Nie</button>
                            <button type="button" class="post-share-btn confirm_delete_image">Tak</button>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        @endforeach
    @endif
    @if(count(Auth::user()->unused_images())==2)
        <div class="post-thumb-gallery img-gallery">
            <div class="row no-gutters">
                @foreach(Auth::user()->unused_images() as $key => $image)
                    <div class="col-6">
                        <figure class="post-thumb" style="height: 100%">
                            <img class="fit-cover" src="{{ asset('storage/u_images/'.$image->url) }}" alt="_{{$key}}">
                        </figure>
                        <button class="delete_picture_button" data-toggle="modal" data-target="#exampleModal{{ $image->id }}" data-id="{{ $image->id }}"><i class="bi-trash"></i></button>
                        <div class="modal fade form-modal" id="exampleModal{{ $image->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <input type="hidden" name="id" value="{{ $image->id }}">
                            @csrf
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Usuwanie obrazu</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        Czy na pewno chcesz usunąć ten obraz?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="post-share-btn decline_delete_image" data-dismiss="modal">Nie</button>
                                        <button type="button" class="post-share-btn confirm_delete_image">Tak</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
    @if(count(Auth::user()->unused_images())>=3)
        <div class="post-thumb-gallery img-gallery">
            <div class="row no-gutters">
                @foreach(Auth::user()->unused_images() as $key => $image)
                    <div class="col-8 position-relative">
                        <figure class="post-thumb" style="height: 100%">
                            <img class="fit-cover" src="{{ asset('storage/u_images/'.$image->url) }}" alt="_{{$key}}">
                        </figure>
                        <button class="delete_picture_button" data-toggle="modal" data-target="#exampleModal{{ $image->id }}" data-id="{{ $image->id }}"><i class="bi-trash"></i></button>
                        <div class="modal fade form-modal" id="exampleModal{{ $image->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <input type="hidden" name="id" value="{{ $image->id }}">
                            @csrf
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Usuwanie obrazu</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        Czy na pewno chcesz usunąć ten obraz?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="post-share-btn decline_delete_image" data-dismiss="modal">Nie</button>
                                        <button type="button" class="post-share-btn confirm_delete_image">Tak</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if($key==0)
                        @break
                    @endif
                @endforeach
                <div class="col-4">
                    <div class="row " style="height: 100%">
                        @foreach(Auth::user()->unused_images() as $key => $image)
                            @if($key==0)
                                @continue
                            @endif
                            <div class="col-12">
                                <figure class="post-thumb" style="height: 100%">
                                    <img class="fit-cover" src="{{ asset('storage/u_images/'.$image->url) }}" alt="_{{$key}}">
                                </figure>
                                <button class="delete_picture_button" data-toggle="modal" data-target="#exampleModal{{ $image->id }}" data-id="{{ $image->id }}"><i class="bi-trash"></i></button>
                                <div class="modal fade form-modal" id="exampleModal{{ $image->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <input type="hidden" name="id" value="{{ $image->id }}">
                                    @csrf
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Usuwanie obrazu</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                Czy na pewno chcesz usunąć ten obraz?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="post-share-btn decline_delete_image" data-dismiss="modal">Nie</button>
                                                <button type="button" class="post-share-btn confirm_delete_image">Tak</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @if($key==3)
                                @break
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    @endif
@endif

