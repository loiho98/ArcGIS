<style>
    .sidebar-wrapper {
        /* background-image: url("https://images.unsplash.com/photo-1542241647-9cbbada2b309?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjExMDk0fQ&w=1000&q=80"); */
        /* background-repeat: no-repeat;
        background-size: auto;
        background-blend-mode: darken; */
        background-color: #212529;
    }
    .sidebar{
        height: 580px;
        border-color: black;
    }
</style>
<div class="sidebar">
    <div class="sidebar-wrapper">
        <div class="logo">
            <a href="#" class="simple-text logo-normal">{{ __('Danh mục') }}</a>
        </div>
        <ul class="nav">
            <li @if ($pageSlug ?? ''=='profile' ) @endif>
                <a href="{{ route('profile.edit')  }}">
                    <i class="tim-icons icon-single-02"></i>
                    <p>{{ __('Thông tin User') }}</p>
                </a>
            </li>
            {{-- <li @if ($pageSlug ?? ''=='icons' )  @endif>
                <a href="{{ route('pages.icons') }}">
            <i class="tim-icons icon-atom"></i>
            <p>{{ __('Icons') }}</p>
            </a>
            </li> --}}
            <li @if ($pageSlug ?? ''=='maps' ) @endif>
                <a href="{{ route('pages.maps') }}">
                    <i class="tim-icons icon-square-pin"></i>
                    <p>{{ __('Bản đồ') }}</p>
                </a>
            </li>
            <li @if ($pageSlug ?? ''=='tables' ) @endif>
                <a href="{{ route('pages.tables') }}">
                    <i class="tim-icons icon-bullet-list-67"></i>
                    <p>{{ __('Danh mục địa điểm') }}</p>
                </a>
            </li>
            {{-- <li @if ($pageSlug ?? '' == 'typography') class="active " @endif>
                <a href="{{ route('pages.typography') }}">
            <i class="tim-icons icon-align-center"></i>
            <p>{{ __('Typography') }}</p>
            </a>
            </li>
            <li @if ($pageSlug ?? ''=='rtl' ) class="active " @endif>
                <a href="{{ route('pages.rtl') }}">
                    <i class="tim-icons icon-world"></i>
                    <p>{{ __('RTL Support') }}</p>
                </a>
            </li> --}}

        </ul>
    </div>
</div>
