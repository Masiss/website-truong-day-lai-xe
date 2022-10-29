<div class="sidebar-left">
    <div class="sidebar">
        <div class="sidebar-content email-app-sidebar">
            <div class="email-app-menu">

                <div class="sidebar-menu-list">
                    <!-- <hr /> -->
                    <h6 class="section-label mt-3 mb-1 px-2">Labels</h6>
                    <div class="list-group list-group-labels">
                        @foreach($types as $type)
                            <button name="btn-type" data-type="{{$type->value}}" href="#" class="list-group-item list-group-item-action"
                            ><span class="bullet bullet-sm bullet-primary me-1"></span>{{\App\Enums\TypeContactEnums::toVNese($type->value)}}</button
                            >
                        @endforeach
                        <button name="btn-type"  href="#" class="list-group-item list-group-item-action"
                        ><span class="bullet bullet-sm bullet-primary me-1"></span>Tất cả</button
                        >
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
