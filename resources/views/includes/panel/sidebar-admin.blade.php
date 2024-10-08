<li class="nav-item nav-category">@lang('منو مدیریت')</li>
<li class="nav-item">
    <a href="{{ route(getPrefixُTheme() . 'dashboard') }}" class="nav-link">
        <i class="link-icon" data-feather="inbox"></i>
        <span class="link-title">@lang('داشبورد مدیریت')</span>
    </a>
</li>
<li class="nav-item">
    <a href="{{ route(getPrefixُTheme() . 'gateways') }}" class="nav-link">
        <i class="link-icon" data-feather="inbox"></i>
        <span class="link-title">@lang('درگاه‌ها')</span>
    </a>
</li>
<li class="nav-item">
    <a href="{{ route(getPrefixُTheme() . 'merchants') }}" class="nav-link">
        <i class="link-icon" data-feather="inbox"></i>
        <span class="link-title">@lang('پایانه‌ها')</span>
    </a>
</li>
<li class="nav-item">
    <a href="{{ route(getPrefixُTheme() . 'currencies') }}" class="nav-link">
        <i class="link-icon" data-feather="inbox"></i>
        <span class="link-title">@lang('ارزها')</span>
    </a>
</li>
<li class="nav-item">
    <a href="{{ route(getPrefixُTheme() . 'payments') }}" class="nav-link">
        <i class="link-icon" data-feather="inbox"></i>
        <span class="link-title">@lang('تراکنش‌ها')</span>
    </a>
</li>

<li class="nav-item nav-category">@lang('مدیریت کاربران')</li>
<li class="nav-item">
    <a href="{{ route(getPrefixُTheme() . 'clients') }}" class="nav-link">
        <i class="link-icon" data-feather="users"></i>
        <span class="link-title">@lang('مشتریان')</span>
    </a>
</li>
<li class="nav-item">
    <a href="{{ route(getPrefixُTheme() . 'staffs') }}" class="nav-link">
        <i class="link-icon" data-feather="users"></i>
        <span class="link-title">@lang('پرسنل')</span>
    </a>
</li>