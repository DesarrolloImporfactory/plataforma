@inject('layoutHelper', 'JeroenNoten\LaravelAdminLte\Helpers\LayoutHelper')

@php( $dashboard_url = View::getSection('dashboard_url') ?? config('adminlte.dashboard_url', 'home') )

@if (config('adminlte.use_route_url', false))
    @php( $dashboard_url = $dashboard_url ? route($dashboard_url) : '' )
@else
    @php( $dashboard_url = $dashboard_url ? url($dashboard_url) : '' )
@endif

<a href="{{ $dashboard_url }}"
    @if($layoutHelper->isLayoutTopnavEnabled())
        class="navbar-brand logo-switch {{ config('adminlte.classes_brand') }} flex justify-center"
    @else
        class="brand-link logo-switch {{ config('adminlte.classes_brand') }} flex justify-center"
    @endif>
    <div class="flex justify-center">
        {{-- Large brand logo --}}
        <img src="{{ asset(config('adminlte.logo_img_xl')) }}"
        alt="{{ config('adminlte.logo_img_alt', 'AdminLTE') }}"
        class="logo-xl absolute top-0 " style="max-height: 33px; margin-top:0.8em; max-width: 91%">
    </div>

</a>
