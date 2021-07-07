<div class="content-body" id="app">
    <div class="row">
        <div class="col-md-9">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="metric-content">
                                {{-- 头部合同标题等信息 --}}
                                @include('admin.task._top')
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class=" card" style=";padding:.25rem .4rem .4rem">
                        <ul class="nav nav-tabs " role="tablist">
                            <li class="nav-item">
                                <a href="#tab_events" class="nav-link active" data-toggle="tab">进度</a>
                            </li>
                            <li class="nav-item">
                                <a href="#tab_electronics" class="nav-link" data-toggle="tab">图片</a>
                            </li>
                            <li class="nav-item">
                                <a href="#tab_files" class="nav-link" data-toggle="tab">附件</a>
                            </li>
                            <li class="nav-item pull-right header"></li>
                        </ul>
                        <div class="tab-content" style="">
                            <div class="tab-pane active" id="tab_events">
                                {{-- 进度 --}}
                                @include('admin.task._events')
                            </div>
                            <div class="tab-pane" id="tab_electronics">
                                {{-- 图片信息 --}}
                                @include('admin.task._electronics')
                            </div>
                            <div class="tab-pane" id="tab_files">
                                {{-- 附件 --}}
                                @include('admin.task._files')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card total">
                {{-- 详情 --}}
                @include('admin.task.detail')
            </div>
        </div>
    </div>
</div>
