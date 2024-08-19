@include('dashboard.component.breadcrumb', ['title' => $config['seo']['index']['title']])

<div class="wrapper wrapper-content animated fadeIn">
    <div class="p-w-md m-t-sm">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox-content">
                    <div class="filter_table">
                        <h5>{{ $config['seo']['index']['table'] }}</h5>
                    </div>
                    @include('type.component.filter')
                </div>
                <div class="ibox-content">
                    @include('type.component.table')
                </div>
            </div>
        </div>
    </div>
</div>
