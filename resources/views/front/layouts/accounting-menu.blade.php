<div class="d-flex gap-2 mb-3">
    <a class="btn btn-info btn-sm {{ request()->routeIs('front.accounting') ? 'active' : '' }}"
        href="{{ url('/accounting') }}">@lang('Accounting')</a>
    <a class="btn btn-info btn-sm {{ request()->routeIs('front.reports') ? 'active' : '' }}"
        href="{{ url('/reports') }}">@lang('Reports')</a>
    <a class="btn btn-info btn-sm {{ request()->routeIs('front.accounting-department') ? 'active' : '' }}"
        href="{{ url('/selectfilter') }}">@lang('accounting management')</a>
</div>
