<div class="breadcrumb-wrapper">
    <ol class="breadcrumb">
        @foreach($breadCrumb as $value)
            @if($loop->last)
                <li class="breadcrumb-item  active ">
                    {{ucfirst($value)}}
                </li>
            @else
                <li class="breadcrumb-item ">
                    <a>{{ucfirst($value)}}</a>
                </li>
            @endif
        @endforeach
    </ol>
</div>
