<footer class="footer">
    <div class="container-fluid">
        <ul class="nav">
            <li class="nav-item">
                <a href="https://localhost:6443/arcgis/manager/service.html?name=TraVinh.MapServer" target="blank" class="nav-link">
                    {{ __('Arcgis Server Manager') }}
                </a>
            </li>
            <li class="nav-item">
                <a href="http://localhost/arcgis/webadaptor" target="blank" class="nav-link">
                    {{ __('Arcgis Adaptor') }}
                </a>
            </li>
            {{-- <li class="nav-item">
                <a href="#" class="nav-link">
                    {{ __('About Us') }}
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    {{ __('Blog') }}
                </a>
            </li> --}}
        </ul>
        <div class="copyright">
            &copy; {{ now()->year }} {{ __('thiết kế bởi') }} Hồ Phước Lợi.
        </div>
    </div>
</footer>
