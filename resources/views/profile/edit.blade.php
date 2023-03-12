@extends('partials.main.profile')
@section('styles')
    <!-- include summernote css/js -->

@endsection
@section('profile_content')
        <div class="card card-small">
            <h3 class="title">Edycja profilu</h3>
            <form class="signup-inner--form edit-profile--form" enctype="multipart/form-data" method="post" action="{{ route('profile.update') }}">
                @csrf
                <div class="row">
                    <div class="col-12 text-left">
                        <label for="email">Email</label>
                        <input type="email" value="{{ Auth::user()->email }}" id="email" name="email" class="single-field" placeholder="Email">
                    </div>
                    <div class="col-md-6 text-left">
                        <label for="email">Imię</label>
                        <input type="text" value="{{ Auth::user()->name }}" name="name" class="single-field" placeholder="First Name">
                    </div>
                    <div class="col-md-6 text-left">
                        <label for="email">Nazwisko</label>
                        <input type="text" value="{{ Auth::user()->last_name }}" name="last_name" class="single-field" placeholder="Last Name">
                    </div>
                    <div class="col-md-6 text-left">
                        <label for="email">Mężczyzna/Kobieta</label>
                        <select class="nice-select" name="gender">
                            <option value="male" {{ Auth::user()->gender=='male'? 'selected':'' }}>Mężczyzna</option>
                            <option value="female" {{ Auth::user()->gender=='female'? 'selected':'' }}>Kobieta</option>
                        </select>
                    </div>
                    <div class="col-md-6 text-left">
                        <label for="email">Zawód</label>
                        <input type="text" value="{{ Auth::user()->profession }}" name="profession" class="single-field">
                    </div>
                    <div class="col-md-6 text-left">
                        <label for="email">Data urodzin</label>
                        <input type="date" value="{{ Auth::user()->birthday }}" name="birthday" class="single-field">
                    </div>
                    <div class="col-md-6 text-left">
                        <label for="hobby">Hobby</label>
                        <input type="text" id="hobby" value="{{ Auth::user()->hobby }}" name="hobby" class="single-field">
                    </div>
                    <div class="col-md-6 text-left">
                        <label for="country">Kraj</label>
                        <input type="text" value="{{ Auth::user()->country }}" name="country" class="single-field">
                    </div>
                    <div class="col-12 text-left">
                        <label for="email">O mnie</label>
                        <textarea name="about" id="summernote">{!! Auth::user()->about !!}</textarea>
                    </div>
                    <div class="col-md-6 mt-4">
                        <label for="country">Avatar</label>
                        <input type="file" name="avatar" accept="image/*" onchange="loadFile(event, 'avatar')">
                        @if(Auth::user()->avatar)
                            <button class="submit-btn" id="delete_avatar" onclick="clearSrc(event, 'avatar', 'delete_avatar')">Usuń awatara</button>
                            <input type="hidden" name="delete_avatar" value="0">
                            <img id="avatar" class="mt-4" src="/images/profile/avatars/{{Auth::user()->avatar}}"/>
                        @else
                            <img id="avatar" class="mt-4" src=""/>
                        @endif
                    </div>
                    <div class="col-md-6 mt-4">
                        <label for="country">Fon image</label>
                        <input type="file" name="fon_image" accept="image/*" onchange="loadFile(event, 'fon_image')">
                        @if(Auth::user()->fon_image)
                            <button class="submit-btn" id="delete_fon_image" onclick="clearSrc(event, 'fon_image', 'delete_fon_image')">Usuń obraz</button>
                            <input type="hidden" name="delete_fon_image" value="0">
                            <img id="fon_image" class="mt-4" src="/images/profile/fon_src/{{Auth::user()->fon_image}}"/>
                        @else
                            <img id="fon_image" class="mt-4" src=""/>
                        @endif
                    </div>
                    <div class="col-12">
                        <button class="submit-btn" id="submit-all" type="submit">Zapisz dane</button>
                    </div>
                </div>
            </form>
        </div>

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
        $(document).ready(function() {
            $('#summernote').summernote({
                tabsize: 1,
                height: 200,
                toolbar: [
                    ['font', ['bold', 'underline', 'italic']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['insert', ['link']],
                ]
            });
        });
    </script>
@endsection
