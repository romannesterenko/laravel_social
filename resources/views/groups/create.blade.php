@extends('partials.main.layout')
@section('content')
    @include('groups.partials.top_block')
    <!-- post status start -->
    <div class="card widget-item">
        <h3 class="title text-center">Utwórz społeczność</h3>
        @if($errors->any())
            <div class="alert alert-danger">
                {!! implode('', $errors->all('<div class="d-flex"><i class="bi bi-check"></i> <div>:message</div></div>')) !!}
            </div>
        @endif
        <div class="col">
            <form action="{{ route('groups.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="author" value="{{ Auth::id() }}">
                <div class="mb-3 mt-3">
                    <label for="title" class="form-label fw-bold">Nazwa społeczności</label>
                    <input type="text" name="title" class="form-control_custom" value="{{ old('title') }}" id="title">
                </div>
                <div class="mb-3 mt-3">
                    <label for="title" class="form-label fw-bold">Tematyka społeczności</label>
                    <select name="category" class="form-control_custom form-control_select mb-3">
                        <option value="0">Bez Kategorii</option>
                        @foreach($community_types as $community_type)
                            <option value="{{$community_type->id}}">{{$community_type->title}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="mytextarea" class="form-label fw-bold">Opis społeczności</label>
                    <textarea name="description" class="form-control_custom" id="mytextarea" placeholder="Napisz kilka słów o swojej społeczności">{{ old('description') }}</textarea>
                </div>
                <div class="mb-3">
                    <label for="country" class="form-label fw-bold">Fotografia społecznościowa</label><br/>
                    <input type="file" name="image" accept="image/*" onchange="loadFile(event, 'fon_image')">
                    <img id="fon_image" class="mt-4" src=""/>

                </div>
                <div class="mb-3 d-flex justify-content-end">
                    <div class="d-flex">
                        <button class="post-share-btn" type="submit"><i class="bi-file-post pr-1"></i> Publikować</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- post status end -->
@endsection
@section('scripts')
    <script>
        var loadFile = function(event, id) {
            var output = document.getElementById(id);
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function() {
                URL.revokeObjectURL(output.src) // free memory
            }
        };
        var clearSrc = function (event, img, input) {
            event.preventDefault();
            $('#'+img).attr('src', '');
            $('[name="'+input+'"]').val(1);
        };
    </script>
@endsection
