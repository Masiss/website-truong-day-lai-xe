@foreach($documents as $document)
    <div class="col-md-4">
        <div class="card">
            @admin
            <div class="d-flex justify-content-end m-25 mb-0">
                <button data-id="{{$document->id}}" name="btn-delete" class="btn p-0">
                    <i data-feather="x"></i>
                </button>
            </div>
            @endadmin
            @if($document->hasAtt)
            <div class="d-flex justify-content-end m-25 mb-0">
                    <i data-feather="file"></i>
            </div>
            @endif
            <div class="card-body text-center">
                @if(isset($document->image))
                    <img src="{{$document->image}}" style="height: 100%;width: 100%"
                         class="font-large-2 mb-1">
                @endif
                <h5 class="card-title">{{$document->title}}</h5>
                <p class="card-text">{{$document->subtitle}}...</p>
                @guest()
                    <a class="btn btn-primary" href="{{route('document.show',$document->id)}}"> Chi tiết</a>

                @else
                    @admin()
                    <a class="btn btn-primary" href="{{route('admin.document.show',$document->id)}}"> Chi tiết</a>
                    @endadmin
                @endguest
            </div>
        </div>
    </div>
@endforeach
