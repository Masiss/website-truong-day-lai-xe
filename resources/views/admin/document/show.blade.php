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
                <div class="card">
                    <div class="d-flex justify-content-end m-25 mb-0">
                        <button data-id="{{$document->id}}" name="btn-delete" class="btn p-0">
                            <i data-feather="x"></i>
                        </button>
                    </div>
                    <div class="card-body text-center mb-3">
                        <h1>{{$document->title}}</h1>
                        @if(isset($document->image))
                            <img src="{{$document->image}}" style="height: 25%;width: 25%"
                                 class="font-large-2 mb-1">
                        @endif
                        <p class="card-text text-start p-3 pt-0">
                            {!! nl2br($document->content) !!}...
                        </p>
                        @if(isset($document->attachment))
                            <button class="btn btn-primary">
                                <a class="text-white" href="{{$document->attachment}}" download>Tải tệp đính kèm</a>
                            </button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
    @push('javascript')
        <script type="text/javascript">
            document.getElementsByName('btn-delete').forEach(e => e.addEventListener('click', function () {
                var id = this.getAttribute('data-id');
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: '{{route('admin.document.destroy')}}',
                    data: {
                        id: id,
                    },
                    method: 'DELETE',
                    success: function (response) {
                        window.location = '{{route('admin.document.index')}}';
                    },
                    error: function (response) {
                        document.getElementById('error').innerHTML = response.error;
                    }
                })
            }))
        </script>
    @endpush
@endsection
