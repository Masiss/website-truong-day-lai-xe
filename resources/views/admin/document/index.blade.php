@extends('layout.master')
@push('css')
    <link rel="stylesheet" type="text/css" href="{{asset('css/vertical-menu.min.css')}}">
@endpush
@section('content')
    <a class="btn btn-primary mb-2 ms-2" href="{{route('admin.document.create')}}">
        Thêm
    </a>
    <span id="success" class="alert alert alert-success"></span>
    <span id="error" class="alert alert alert-danger"></span>
    <section id="modal-examples">
        <div id="list" class="row">
            <!-- share project card -->

        </div>
    </section>

    @push('javascript')
            <script src="https://cdn.jsdelivr.net/npm/editorjs-html@3.4.0/build/edjsHTML.browser.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/editorjs-parser@1/build/Parser.browser.min.js"></script>
        <script>
            window.onload = callAPI();
            function callAPI() {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: '{{route('documentAPI')}}',
                    success: function (data) {
                        // const edjsParser = edjsHTML();
                        //
                        // let html = edjsParser.parse(data);
                        // console.log(html);
                        document.getElementById('list').innerHTML = data;
                        feather.replace();
                        destroy();
                    }
                })
            }
            function destroy() {
                document.getElementsByName('btn-delete').forEach(e => e.addEventListener('click', function () {
                    var id = this.getAttribute('data-id');
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: '{{route('admin.document.destroy')}}',
                        data: {
                            id:id
                        },
                        method: 'DELETE',
                        success: function (response) {
                            document.getElementById('success').innerHTML = response.success;
                            callAPI();
                        },
                        error: function (resonpse) {
                            document.getElementById('error').innerHTML = resonpse.error;
                            callAPI();
                        }
                    })
                }));
            }
            function customParser(block){
                return `<custom-tag> ${block.data.text} </custom-tag>`;
            }

        </script>
    @endpush
@endsection
