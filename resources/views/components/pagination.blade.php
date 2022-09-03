{{--<div>--}}
{{--    <!-- The only way to do great work is to love what you do. - Steve Jobs -->--}}
{{--</div>--}}
<nav aria-label="Page navigation example">
    <ul class="pagination justify-content-end mt-3">
        <li class="page-item">
            <a class="page-link"
               href="{{$paginate->url(1)}}">
                {{"First"}}
            </a>
        </li>
        <li class="page-item">
            <a class="page-link"
               href="{{$paginate->previousPageUrl()}}"
               aria-label="Previous">
                <span aria-hidden="true">&laquo; Prev</span>
            </a>
        </li>
        @if($paginate->currentPage()>4)
            @for($i=$paginate->currentPage()-3;$i<=$paginate->currentPage()+3 && $i<=$paginate->totalPage;$i++)
                <li class="page-item @if($paginate->currentPage()==$i) active @endif">
                    <a class="page-link "
                       href="{{$paginate->url($i)}}">
                        {{$i}}
                    </a>
                </li>
            @endfor
        @else
            @for($i=1;$i<=$paginate->currentPage()+3 && $i<=$paginate->totalPage;$i++ )
                <li class="page-item @if($paginate->currentPage()==$i) active @endif">
                    <a class="page-link "
                       href="{{$paginate->url($i)}}">
                        {{$i}}
                    </a>
                </li>
            @endfor
        @endif
        <li class="page-item">
            <a class="page-link"
               href="{{$paginate->nextPageUrl()}}"
               aria-label="Next">
                <span aria-hidden="true">Next &raquo;</span>
            </a>
        </li>
        <li class="page-item">
            <a class="page-link"
               href="{{$paginate->url($paginate->lastPage())}}">
                {{"Last"}}
            </a>
        </li>
    </ul>
</nav>
