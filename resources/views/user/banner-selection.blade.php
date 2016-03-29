<div class="ui three column grid">
    <div class="column">
        <h3 class="header">Home Page</h3>
        <form id="addHomePhotoForm" action="{{ route('addBanner', ['name' => 'home']) }}" method="POST"
              class="dropzone">
            {{ csrf_field() }}
        </form>
    </div>
    <div class="column">
        <h3 class="header">School Page</h3>
        <form id="addSchoolPhotoForm" action="{{ route('addBanner', ['name' => 'school']) }}" method="POST"
              class="dropzone">
            {{ csrf_field() }}
        </form>
    </div>
    <div class="column">
        <h3 class="header">Course Page</h3>
        <form id="addCoursePhotoForm" action="{{ route('addBanner', ['name' => 'course']) }}" method="POST"
              class="dropzone">
            {{ csrf_field() }}
        </form>
    </div>
</div>

@section('footer')
    @parent
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.2.0/dropzone.js"></script>
    <script>
        Dropzone.options.addHomePhotoForm = {
            maxFileSize: 3,
            maxFiles: 1,
            acceptedFiles: '.jpeg, .jpg, .tiff, .gif, .bmp, .png',
            addRemoveLinks: true,
            clickable: true,
            removedfile: function (file) {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: 'POST',
                    url: 'admin/removeBanner',
                    data: {
                        name: 'home'
                    },
                    dataType: 'html'
                });
                var _ref;
                return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;
            },
            init: function () {
                if ('{{ $home_banner->bannerSet() }}' == true) {
                    // Add pre-existing images to Dropzone
                    var mockFile = {
                        id: '{!! $home_banner->id !!}',
                        name: '{!! $home_banner->name !!}'
                    };

                    // Call the default addedfile event handler
                    this.emit("addedfile", mockFile);
                    // And optionally show the thumbnail of the file:
                    this.emit("thumbnail", mockFile, "/{!! $home_banner->path !!}");
                    this.emit("complete", mockFile);
                }
            }
        };
        Dropzone.options.addSchoolPhotoForm = {
            maxFileSize: 3,
            maxFiles: 1,
            acceptedFiles: '.jpeg, .jpg, .tiff, .gif, .bmp, .png',
            addRemoveLinks: true,
            clickable: true,
            removedfile: function (file) {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: 'POST',
                    url: 'admin/removeBanner',
                    data: {
                        name: 'school'
                    },
                    dataType: 'html'
                });
                var _ref;
                return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;
            },
            init: function () {
                if ('{{ $school_banner->bannerSet() }}' == true) {
                    // Add pre-existing images to Dropzone
                    var mockFile = {
                        id: '{!! $school_banner->id !!}',
                        name: '{!! $school_banner->name !!}'
                    };

                    // Call the default addedfile event handler
                    this.emit("addedfile", mockFile);
                    // And optionally show the thumbnail of the file:
                    this.emit("thumbnail", mockFile, "/{!! $school_banner->path !!}");
                    this.emit("complete", mockFile);
                }
            }
        };
        Dropzone.options.addCoursePhotoForm = {
            maxFileSize: 3,
            maxFiles: 1,
            acceptedFiles: '.jpeg, .jpg, .tiff, .gif, .bmp, .png',
            addRemoveLinks: true,
            clickable: true,
            removedfile: function (file) {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: 'POST',
                    url: 'admin/removeBanner',
                    data: {
                        name: 'course'
                    },
                    dataType: 'html'
                });
                var _ref;
                return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;
            },
            init: function () {
                // Add pre-existing images to Dropzone
                if ('{{ $course_banner->bannerSet() }}' == true) {
                    var mockFile = {
                        id: '{!! $course_banner->id !!}',
                        name: '{!! $course_banner->name !!}'
                    };

                    // Call the default addedfile event handler
                    this.emit("addedfile", mockFile);
                    // And optionally show the thumbnail of the file:
                    this.emit("thumbnail", mockFile, "/{!! $course_banner->path !!}");
                    this.emit("complete", mockFile);
                }
            }
        };
    </script>
@endsection