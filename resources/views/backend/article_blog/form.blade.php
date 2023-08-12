<form method="POST" action="" autocomplete="off" enctype="multipart/form-data">
    <div class="row">
        <div class="col-sm-8">
            @csrf
            <div class="form-group">
                <label for="exampleInputEmail1">Tên</label>
                <input type="text" name="name" placeholder="Tên" class="form-control" value="{{ old('name', $article->name ?? "") }}">
                @error('name')
                <small id="emailHelp" class="form-text text-danger">{{ $errors->first('name') }}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Nội dung bài viết</label>
                <textarea name="content" class="form-control" id="content" cols="30" rows="3">{{ old('description', $article->content ?? "") }}</textarea>
                @error('content')
                <small id="emailHelp" class="form-text text-danger">{{ $errors->first('content') }}</small>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Lưu dữ liệu</button>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <label for="exampleInputEmail1">Danh mục</label>
                <select name="menu_id" class="form-control">
                    <option value="">Chọn danh mục</option>
                    @foreach($menus ?? [] as $item)
                        <option value="{{ $item->id }}" {{ ($article->menu_id ?? 0) == $item->id ? "selected" : "" }}>{{ $item->name }}</option>
                    @endforeach
                </select>
                @error('menu_id')
                    <small id="emailHelp" class="form-text text-danger">{{ $errors->first('menu_id') }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label for="exampleInputPassword1">Mô tả ngắn</label>
                <textarea class="form-control" rows="2"  name="description">{{ $article->description ?? '' }}</textarea>
            </div>

            <div class="form-group">
                <label for="exampleInputPassword1">Video</label>
                <input type="file" class="form-control" name="video">
                @if (isset($article->video) && $article->video)
                    <p>{{ $article->video }}</p>
                @endif
            </div>

            <div class="form-group">
                <label for="exampleInputPassword1">Hình ảnh</label>
                <input type="file" class="form-control" name="avatar">
                @if (isset($article->avatar) && $article->avatar)
                    <img src="{{ pare_url_file($article->avatar) }}" style="width: 60px;height: 60px; border-radius: 10px; margin-top: 10px" alt="">
                @endif
            </div>
        </div>
    </div>
</form>



<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
<script>
    var options = {
        filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
        filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token=',
        filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
        filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token='
    };

    $(function () {
        CKEDITOR.replace('content', options);
    })
</script>
