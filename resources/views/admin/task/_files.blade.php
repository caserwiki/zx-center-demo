<div class="markdown-body editormd-html-preview">
    <div class="upload_go btn btn-primary"><i class="feather icon-plus"></i><a
            href="/admin/files/create?product_id={{$data['product']}}&task_id={{$data['id']}}&type=0">上传文件</a>
    </div>
    <div class="row receipts">
        @foreach ($files as $file)
            @if ($file['type'] === 0)
        <div class="col-md-2 col-sm-2 col-12 file_list">
            <div>
                <a href="/uploads/{{$file['path']}}" target="_blank">
                    <img src="/static/filesicon/{{substr(strrchr($file['path'], '.'), 1)}}.png" />
                    <p>{{basename($file['name'])}}</p>
                </a>
            </div>
        </div>
            @endif
        @endforeach
    </div>
</div>
