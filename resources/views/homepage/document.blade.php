@extends('homepage_layout.master')
@section('content')
    <div class="d-flex w-100" style="padding-top: 5rem; padding-left: 3rem;">
        <div class="card col-sm-13 w-100">
            <div class="card-header d-flex justify-content-center">
                <h4 class="card-title text-black">
                    <strong> TÀI LIỆU</strong>
                </h4>
            </div>
            <div class="card-body px-5 ">
                <div class="row" id="list">

                </div>
            </div>
        </div>
    </div>
    @push('js')
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

            @admin()
            function destroy() {
                document.getElementsByName('btn-delete').forEach(e => e.addEventListener('click', function () {
                    var id = this.getAttribute('data-id');
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: '{{route('admin.document.destroy')}}',
                        data: {
                            id: id
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

            @endadmin
        </script>
    @endpush
@endsection
