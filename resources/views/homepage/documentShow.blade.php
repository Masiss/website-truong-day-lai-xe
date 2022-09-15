@extends('layout.master')
@push('css')
    <link rel="stylesheet" type="text/css" href="{{asset('css/vertical-menu.min.css')}}">
@endpush
@section('content')
    <span id="error" class="alert alert alert-danger"></span>
    <section id="modal-examples">
        <div id="list" class="row">
            <!-- share project card -->
            <div class="col-xl-13">
                <div id="document" class="card">
                    <div id="editorjs" class="card-body text-center mb-3">

                    </div>
                </div>
            </div>
        </div>
    </section>
    @push('javascript')
        <script src="https://cdn.jsdelivr.net/npm/editorjs-html@3.4.0/build/edjsHTML.js"></script>
        <script src="{{asset('js/customParser.js')}}"></script>
        <script>
            let data;
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '{{route('document.show.api',['id'=>$document->id])}}',
                dataType: 'JSON',
                success: function (response) {
                    const edjsParser = edjsHTML({attaches: attachmentParser,image:imageParser});
                    const HTML = edjsParser.parse(response);
                    HTML.forEach(e => document.getElementById('editorjs').innerHTML += e)
                    ;
                }
            })
        </script>
    @endpush
@endsection
