<div class="sidebar" wire:ignore.self>
    <div class="tog-active d-none d-lg-block" data-tog="true" data-active=".app">
        <i class="fas fa-bars"></i>
    </div>
    <ul class="list">
        <li class="list-item {{ request()->routeIs('admin.home') ? 'active' : '' }}">
            <a href="{{ route('admin.home') }}">
                <div>
                    <i class="fa-solid fa-grip"></i>
                    @lang('admin.Home')
                </div>
            </a>
        </li>
        <li class="list-item">
            <a href="{{ route('home') }}" target="_blank">
                <div>
                    <i class="fas fa-house"></i>
                    @lang('admin.Visit front page')
                </div>
            </a>
        </li>
        <li class="list-item">
            <a data-bs-toggle="collapse" href="#Notifications"
                aria-expanded="
          {{ request()->routeIs('admin.notifications.index') || request()->routeIs('admin.library.index') ? 'true' : 'false' }}">
                <div>
                    <i class="fa-solid fa-bell"></i>
                    @lang('admin.Notifications')
                </div>
                <i class="fa-solid fa-angle-right arrow"></i>
            </a>
        </li>
        <div wire:ignore.self id="Notifications"
            class="collapse item-collapse
      {{ request()->routeIs('admin.notifications.index') || request()->routeIs('admin.library.index') ? 'show' : '' }}
  ">
            <li class="list-item {{ request()->routeIs('admin.notifications.index') ? 'active' : '' }}">
                <a href="{{ route('admin.notifications.index') }}">
                    <div>
                        <i class="fa-solid fa-bell"></i>
                        @lang('admin.Notifications')
                    </div>
                </a>
            </li>
            <li class="list-item {{ request()->routeIs('admin.library.index') ? 'active' : '' }}">
                <a href="{{ route('admin.library.index') }}" class="">
                    <div>
                        <i class="fa-solid fa-envelope-open-text"></i>
                        @lang('admin.Notifications Library')
                    </div>
                </a>
            </li>
        </div>

        <li class="list-item">
            <a data-bs-toggle="collapse" href="#settings" aria-expanded="false">
                <div>
                    <i class="fa-solid fa-gear icon"></i>
                    @lang('admin.Settings')
                </div>
                <i class="fa-solid fa-angle-right arrow"></i>
            </a>
        </li>
        <div id="settings" class="collapse item-collapse">
            <li class="list-item">
                <a href="{{ route('admin.settings') }}" class="">
                    <div>
                        <i class="fa-solid fa-gear icon"></i>
                        @lang('admin.Settings')
                    </div>
                </a>
            </li>
            <li class="list-item">
                <a href="/translations" class="">
                    <div>
                        <i class="fa-solid fa-language"></i>
                        @lang('admin.Translate Settings')
                    </div>
                </a>
            </li>
        </div>
        <li class="list-item">
            <a href="{{ route('admin.privacy-policy.index') }}" class="">
                <div>
                    <i class="fa-solid fa-file-circle-question"></i>
                    @lang('admin.Privacy policy')
                </div>
            </a>
        </li>

        <li class="list-item">
            <a href="{{ route('admin.gifts') }}" class="">
                <div>
                    <i class="fa-solid fa-gift"></i>
                    جرب حظك
                </div>
            </a>
        </li>

        <li class="list-item">
            <a href="{{ route('admin.usage-policy.index') }}" class="">
                <div>
                    <i class="fa-solid fa-file-circle-check"></i>
                    @lang('admin.Usage policy')
                </div>
            </a>
        </li>
        @can('read_users')
            <li class="list-item">
                <a href="{{ route('admin.users') }}" class="">
                    <div>
                        <i class="fas fa-user-tie"></i>
                        @lang('admin.Moderators')
                    </div>
                </a>
            </li>
        @endcan
        @can('read_users')
            <!-- <li class="list-item">
                                                                                            <a href="{{ route('admin.categories') }}" class="">
                                                                                                <div>
                                                                                                    <i class="fa-solid fa-list"></i>
                                                                                                    اقسام الموقع
                                                                                                </div>
                                                                                            </a>
                                                                                        </li> -->
        @endcan
        <li class="list-item">
            <a data-bs-toggle="collapse" href="#users" aria-expanded="false">
                <div>
                    <i class="fa-solid fa-users"></i>
                    @lang('admin.Users')
                </div>
                <i class="fa-solid fa-angle-right arrow"></i>
            </a>
        </li>
        <div id="users" class="collapse item-collapse">
            @can('read_clients')
                <li class="list-item">
                    <a href="{{ route('admin.clients') }}" class="">
                        <div>
                            <i class="fa-solid fa-user-large"></i>
                            @lang('admin.Clients')
                        </div>
                    </a>
                </li>
            @endcan
            <li class="list-item">
                <a href="{{ route('admin.contacts') }}" class="">
                    <div>
                        <i class="fa-solid fa-user-large"></i>
                        جهات الاتصال
                    </div>
                </a>
            </li>
            <li class="list-item">
                <a href="{{ route('admin.gifts') }}" class="">
                    <div>
                        <i class="fa-solid fa-user-secret"></i>
                        الهدايا
                    </div>
                </a>
            </li>
        </div>
        <!-- <li class="list-item">
            <a href="{{ route('admin.all_articles') }}">
                <div>
                    <i class="fa-regular fa-newspaper"></i>
                    @lang('admin.Articles')
                </div>
            </a>
        </li>
        <li class="list-item {{ request()->routeIs('admin.products') ? 'active' : '' }}">
            <a href="{{ route('admin.products') }}" class="">
                <div>
                    <i class="fa-solid fa-boxes-stacked"></i>
                    @lang('admin.Products')
                </div>
            </a>
        </li> -->
        <!-- <li class="list-item">
            <a data-bs-toggle="collapse" href="#pages" aria-expanded="false">
                <div>
                    <i class="fa-solid fa-layer-group"></i>
                    @lang('admin.Site services')
                </div>
                <i class="fa-solid fa-angle-right arrow"></i>
            </a>
        </li>
        <div id="pages" class="collapse item-collapse">
            @can('read_city')
    <li class="list-item">
                                                                                                <a href="{{ route('admin.cities') }}" class="">
                                                                                                    <div>
                                                                                                        <i class="fa-solid fa-city"></i>
                                                                                                        @lang('admin.Cities')
                                                                                                    </div>
                                                                                                </a>
                                                                                            </li>
@endcan
            <li class="list-item">
                <a href="{{ route('admin.sliders.index') }}" class="">
                    <div>
                        <i class="fa-solid fa-image"></i>
                        @lang('admin.Sliders')
                    </div>
                </a>
            </li>

            <li class="list-item">
                <a href="{{ route('admin.pages') }}" class="">
                    <div>
                        <i class="fa-solid fa-pager"></i>
                        @lang('admin.Pages')
                    </div>
                </a>
            </li>
            <li class="list-item">
                <a href="{{ route('admin.menus') }}" class="">
                    <div>
                        <i class="fa-solid fa-table-cells-large"></i>
                        @lang('admin.Menus')
                    </div>
                </a>
            </li>
            <li class="list-item">
                <a href="{{ route('admin.email_menu') }}" class="">
                    <div>
                        <i class="fa-solid fa-file-image"></i>
                        @lang('admin.Menus poster')
                    </div>
                </a>
            </li>
        </div> -->
        <li class="list-item">
            <a data-bs-toggle="collapse" href="#support" aria-expanded="false">
                <div>
                    <i class="fa-solid fa-headset "></i>
                    @lang('admin.Technical support')
                </div>
                <i class="fa-solid fa-angle-right arrow"></i>
            </a>
        </li>
        <div class="collapse item-collapse" id="support">
            <li class="list-item">
                <a href="{{ route('admin.tickets.index') }}">
                    <div>
                        <i class="fa-solid fa-ticket "></i>
                        @lang('admin.Ticket')
                        <div class="main-badge">{{ App\Models\Ticket::count() }}</div>
                    </div>
                </a>
            </li>
        </div>
        <li class="list-item">
            <a data-bs-toggle="collapse" href="#message-library" aria-expanded="false">
                <div>
                    <i class="fas fa-envelope-open-text icon"></i>
                    @lang('admin.Library Message')
                </div>
                <i class="fa-solid fa-angle-right arrow"></i>
            </a>
        </li>
        <div id="message-library" class="collapse item-collapse">
            <li class="list-item">
                <a href="{{ route('admin.images') }}">
                    <div>
                        <i class="fa-solid fa-camera"></i>
                        @lang('admin.Image Message')
                    </div>
                </a>
            </li>
            <li class="list-item">
                <a href="{{ route('admin.texts') }}">
                    <div>
                        <i class="fa-solid fa-file-lines"></i>
                        @lang('admin.text_messages')
                    </div>
                </a>
            </li>
            <li class="list-item">
                <a href="{{ route('admin.SendMessage') }}">
                    <div>
                        <i class="fa-solid fa-message"></i>
                        @lang('admin.Send Message')
                    </div>
                </a>
            </li>
        </div>


        {{-- @can('read_program')
            <li class="list-item">
                <a href="{{ route('admin.programs') }}" class="">
                    <div>
                        <i class="fa-solid fa-bars-progress"></i>
                        @lang('admin.Groups')
                    </div>
                </a>
            </li>
        @endcan --}}
        <li class="list-item">
            <a href="{{ route('admin.cities') }}" class="">
                <div>
                    <i class="fa-solid fa-bars-progress"></i>
                    المدن
                </div>
            </a>
        </li>
        <li class="list-item">
            <a href="{{ route('admin.countries') }}" class="">
                <div>
                    <i class="fa-solid fa-bars-progress"></i>
                    الدول
                </div>
            </a>
        </li>


        <li class="list-item">
            <a href="{{ route('admin.contactes') }}" class="">
                <div>
                    <i class="fa-solid fa-handshake-angle"></i>
                    @lang('admin.Contact Us')
                    <div class="main-badge">{{ App\Models\ContactUs::count() }}</div>

                </div>
            </a>
        </li>
    </ul>
</div>
