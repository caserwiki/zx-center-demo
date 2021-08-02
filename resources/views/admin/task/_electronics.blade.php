<div class="markdown-body editormd-html-preview">
    <div class="upload_go btn btn-primary"><i class="feather icon-plus"></i><a
            href="/admin/files/create?product_id={{$data['product']}}&task_id={{$data['id']}}&type=1">上传图片</a>
    </div>
    <div class="row receipts">
        @foreach ($files as $file)
            @if ($file['type'] === 1)
        <div class="col-md-3 col-sm-3 col-12 img_list">
            <div class="img-thumbnail">
                <a href="/uploads/{{$file['path']}}" target="_blank">
                    <img src="/uploads/{{$file['path']}}" />
                </a>
            </div>
        </div>
            @endif
        @endforeach
    </div>
</div>
