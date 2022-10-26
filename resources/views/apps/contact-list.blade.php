@php use App\Enums\TypeContactEnums; @endphp
<ul class="email-media-list">
    @foreach($contacts as $contact)
        <li
            class="d-flex user-mail
            @if(TypeContactEnums::isReplied($contact->type_contacting))
            mail-read
            @endif
        ">
            <div class="mail-body">
                <div class="mail-details">
                    <div class="mail-items">
                        <h5 class="mb-25">{{$contact->name}}</h5>
                        <span class="text-truncate">{{$contact->type_contacting}}</span>
                    </div>
                    <div class="mail-meta-item">
                        <span class="mail-date">{{$contact->created_at}}</span>
                    </div>
                    <div class="mail-message d-flex justify-content-center">
                        <p class="text-truncate mb-0">
                            {{$contact->message}}
                        </p>
                    </div>
                    <div class="d-flex">
                        @if(!TypeContactEnums::isReplied($contact->type_contacting))
                            <button class="btn">
                                <a href="{{route('admin.contact.show',$contact->id)}}">Phản hồi</a>
                            </button>
                        @endif
                        <form action="{{route('admin.contact.destroy',$contact->id)}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn">
                                <span>Xoá</span>
                            </button>
                        </form>
                    </div>
                </div>

            </div>
        </li>
    @endforeach
</ul>
