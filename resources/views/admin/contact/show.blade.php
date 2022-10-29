<!-- Detailed Email Header starts -->
{{--<div class="email-detail-header">--}}
{{--    <div class="email-header-right ms-2 ps-1">--}}
{{--        <ul class="list-inline m-0">--}}
{{--            <li class="list-inline-item">--}}
{{--                <span class="action-icon favorite"><i data-feather="star" class="font-medium-2"></i></span>--}}
{{--            </li>--}}
{{--            <li class="list-inline-item">--}}
{{--                <div class="dropdown no-arrow">--}}
{{--                    <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true"--}}
{{--                       aria-expanded="false">--}}
{{--                        <i data-feather="tag" class="font-medium-2"></i>--}}
{{--                    </a>--}}
{{--                </div>--}}
{{--            </li>--}}
{{--            <li class="list-inline-item">--}}
{{--                <span class="action-icon"><i data-feather="mail" class="font-medium-2"></i></span>--}}
{{--            </li>--}}
{{--            <li class="list-inline-item">--}}
{{--                <span class="action-icon"><i data-feather="trash" class="font-medium-2"></i></span>--}}
{{--            </li>--}}
{{--            <li class="list-inline-item email-prev">--}}
{{--                <span class="action-icon"><i data-feather="chevron-left" class="font-medium-2"></i></span>--}}
{{--            </li>--}}
{{--            <li class="list-inline-item email-next">--}}
{{--                <span class="action-icon"><i data-feather="chevron-right" class="font-medium-2"></i></span>--}}
{{--            </li>--}}
{{--        </ul>--}}
{{--    </div>--}}
{{--</div>--}}
<!-- Detailed Email Header ends -->
<!-- Detailed Email Content starts -->
<div class="email-scroll-area">
    <div class="row">
        <div class="col-12">

            <div class="email-label">
                <span class="mail-label badge rounded-pill badge-light-primary">{{$contact->type_contacting}}</span>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header email-detail-head">
                    <div class="user-details d-flex justify-content-between align-items-center flex-wrap">
                        <span onclick="back()" class="action-icon"><i data-feather="chevron-left" class="font-medium-4"></i></span>
                        <div class="mail-items">
                            <h5 class="mb-0">{{$contact->name}}</h5>
                            <div class="email-info-dropup dropdown">
                  <span
                      role="button"
                      class="dropdown-toggle font-small-3 text-muted"
                      id="card_top01"
                      data-bs-toggle="dropdown"
                      aria-haspopup="true"
                      aria-expanded="false"
                  >
                    {{$contact->email}}
                  </span>
                                <div class="dropdown-menu" aria-labelledby="card_top01">
                                    <table class="table table-sm table-borderless">
                                        <tbody>
                                        <tr>
                                            <td class="text-end">From:</td>
                                            <td>{{$contact->email}}</td>
                                        </tr>
                                        <tr>
                                            <td class="text-end">Date:</td>
                                            <td>{{$contact->create_at}}</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mail-meta-item d-flex align-items-center">
                        <small class="mail-date-time text-muted">{{$contact->created_at}}</small>
                        {{--                        <div class="dropdown ms-50">--}}
                        {{--                            <div--}}
                        {{--                                role="button"--}}
                        {{--                                class="dropdown-toggle hide-arrow"--}}
                        {{--                                id="email_more"--}}
                        {{--                                data-bs-toggle="dropdown"--}}
                        {{--                                aria-haspopup="true"--}}
                        {{--                                aria-expanded="false"--}}
                        {{--                            >--}}
                        {{--                                <i data-feather="more-vertical" class="font-medium-2"></i>--}}
                        {{--                            </div>--}}
                        {{--                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="email_more">--}}
                        {{--                                <div class="dropdown-item"><i data-feather="corner-up-left" class="me-50"></i>Reply--}}
                        {{--                                </div>--}}
                        {{--                                <div class="dropdown-item"><i data-feather="corner-up-right" class="me-50"></i>Forward--}}
                        {{--                                </div>--}}
                        {{--                                <div class="dropdown-item"><i data-feather="trash-2" class="me-50"></i>Delete--}}
                        {{--                                </div>--}}
                        {{--                            </div>--}}
                        {{--                        </div>--}}
                    </div>
                </div>
                <div class="card-body mail-message-wrapper pt-2">
                    <div class="mail-message">
                        <p class="card-text">
                            @if(isset($contact->message))
                                {{$contact->message}}
                            @else
                                Thời gian có thể gọi: {{$contact->time_contacting}}
                            @endif
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Detailed Email Content ends -->

