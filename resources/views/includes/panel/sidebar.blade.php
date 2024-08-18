        <!-- partial:partials/_sidebar.html -->
        <nav class="sidebar">
            <div class="sidebar-header">
                <a href="#" class="sidebar-brand">
                    @lang('SMM') <span>@lang('Coin')</span>
                </a>
                <div class="sidebar-toggler not-active">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </div>
            <div class="sidebar-body">
                <ul class="nav">
                    @include('includes.panel.sidebar-client')
                    @if(getPrefixLevel() != 'client')
                        @include('includes.panel.sidebar-' . getPrefixLevel())
                    @endif
                </ul>
            </div>
        </nav>
        <!-- partial -->
