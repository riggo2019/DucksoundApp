@include('dashboard.component.breadcrumb', ['title' => $config['seo']['index']['title']])

<div class="wrapper wrapper-content animated fadeIn">
    <div class="p-w-md m-t-sm">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox">
                    <div class="ibox-title">
                        <div class="ibox-tools">
                            <h5>{{ $config['seo']['index']['table'] }}</h5>
                        </div>
                    </div>
                    <div class="ibox-content">
                        @include('album_info.component.filter')
                    </div>
                    <div class="ibox-content">
                        @include('album_info.component.table')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>