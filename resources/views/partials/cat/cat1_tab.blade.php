@forelse ($categories[0]->sellers as $seller)

    @include('partials.cat.info_tab')

@empty

    @include('partials.cat.alert_tab')

@endforelse