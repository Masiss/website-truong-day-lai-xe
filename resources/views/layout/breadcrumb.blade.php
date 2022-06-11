
<div class="breadcrumb-wrapper">
    <ol class="breadcrumb">
@foreach($breadCrumb as $value)
            <li class="breadcrumb-item">
                <a>{{ucfirst($value)}}</a>
            </li>
@endforeach
    </ol>
</div>
