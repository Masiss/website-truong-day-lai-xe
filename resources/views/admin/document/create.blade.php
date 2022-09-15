@extends('layout.master')
@push('vendor')
@endpush
@push('css')
    <link rel="stylesheet" type="text/css" href="{{asset('css/vertical-menu.min.css')}}">
    {{--    <link rel="stylesheet" type="text/css" href="{{asset('css/ck-content.css')}}">--}}
    <link rel="stylesheet" type="text/css" href="{{asset('css/simple-image.css')}}">
@endpush
@section('content')

    <div class="content-body">
        <section class="app-user-view-account">
            {{--            <div class="row">--}}
            <!-- User Content -->
            <div class="col-xl-13 ">
                <!-- Project table -->
                <div class="card">
                    <span id="alert" class="alert alert-danger"></span>
                    <h4 class="card-header">Thêm tài liệu</h4>
                    <form class="mx-3 mb-1"
{{--                          method="POST"--}}
{{--                          action="{{route('admin.document.store',['_token'=>csrf_token()])}}"--}}
                          enctype="multipart/form-data">
                        @csrf
                        <div id="editorjs" name="text"></div>
                        <button id="save-button">Save</button>
                        <pre id="output"></pre>
                    </form>
                </div>
                <!-- /Project table -->
            </div>
            <!--/ User Content -->
            {{--            </div>--}}
        </section>
    </div>

    @push('javascript')
        // Page JS

        {{--        <script src="{{asset('js/editor.js')}}"></script>--}}
        {{--        <script src="{{asset('js/simple-image.js')}}"></script>--}}
        <script src="https://cdn.jsdelivr.net/npm/@editorjs/editorjs@latest"></script>
        <script src="https://cdn.jsdelivr.net/npm/@editorjs/image@2.3.0"></script>
        <script src="https://cdn.jsdelivr.net/npm/@editorjs/header@latest"></script>
        <script src="https://cdn.jsdelivr.net/npm/@editorjs/simple-image@latest"></script>
        <script src="https://cdn.jsdelivr.net/npm/@editorjs/paragraph@2.8.0/dist/bundle.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@editorjs/underline@latest"></script>
        <script src="https://cdn.jsdelivr.net/npm/@editorjs/marker@latest"></script>
        <script src="https://cdn.jsdelivr.net/npm/@editorjs/attaches@latest"></script>
        <script src="https://cdn.jsdelivr.net/npm/editorjs-html@3.4.0/build/edjsHTML.browser.js"></script>
        <script>
            const ImageTool = window.ImageTool;
            const editor = new EditorJS({
                placeholder: 'Let`s write an awesome story!',
                autofocus: true,
                tools: {
                    attaches: {
                        class: AttachesTool,
                        config: {
                            endpoint: '{{route('admin.document.upload-file',['_token'=>csrf_token()])}}'
                        }
                    },
                    Marker: {
                        class: Marker,
                        shortcut: 'CMD+SHIFT+M',
                    },
                    underline: Underline,
                    paragraph: {
                        class: Paragraph,
                        inlineToolbar: true,
                    },
                    header: {
                        class: Header,
                        config: {
                            placeholder: 'Enter a header',
                            levels: [1, 2, 3, 4],
                            defaultLevel: 3
                        }
                    },
                    image: {
                        class: ImageTool,
                        inlineToolbar: true,
                        config: {
                            endpoints: {
                                byFile: '{{route('admin.document.upload-image',['_token'=>csrf_token()])}}', // Your backend file uploader endpoint
                            }
                        }
                    }
                },
            });

            document.getElementById('save-button').addEventListener('click', function (event) {
                event.preventDefault();
                editor.save().then((outputData) => {

                    // console.log('Article data: ', outputData.blocks)
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url:'{{route('admin.document.store')}}',
                        data:outputData,
                        method:'POST',
                        success:function(html){
                            window.location=html.location;
                        }
                    })
                }).catch((error) => {
                    document.getElementById('alert').innerHTML = error;
                });
            })

        </script>
    @endpush
@endsection
