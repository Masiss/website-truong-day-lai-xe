<ul class="email-media-list">
    @foreach($contacts as $contact)
        <li class="d-flex user-mail mail-read">
            <div class="mail-left pe-50">
                <div class="user-action">
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="customCheck12"/>
                        <label class="form-check-label" for="customCheck12"></label>
                    </div>
                </div>
            </div>
            <div onclick="show(this)" data-id="{{$contact->id}}"
                 data-url="{{route('admin.contact.show',$contact->id)}}">
                <div class="mail-body">
                    <div class="mail-details">
                        <div class="mail-items">
                            <h5 class="mb-25">{{$contact->name}}</h5>
                            <p class="text-truncate mb-0">{{$contact->type_contacting}}.</p>
                            @if(isset($contact->time_contacting))
                                <span
                                    class="text-truncate mb-0">Thời gian có thể gọi tư vấn: {{$contact->time_contacting}}</span>
                            @endif
                        </div>
                        <div class="mail-meta-item">
                            <span class="mx-50 bullet bullet-success bullet-sm"></span>
                            <span class="mail-date">{{$contact->created_at}}</span>
                        </div>
                    </div>
                    <div class="mail-message">
                        <p class="mb-0 text-truncate">
                            {{$contact->message}}
                        </p>
                    </div>
                </div>
            </div>
        </li>
    @endforeach
</ul>
<div class="no-results">
    <h5>No Items Found</h5>
</div>
