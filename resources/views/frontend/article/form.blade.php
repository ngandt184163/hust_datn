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
                <label for="exampleInputEmail1">Mô tả</label>
                <textarea name="description" class="form-control" id="" cols="30" rows="3">{{ old('description', $article->description ?? "") }}</textarea>
                @error('description')
                <small id="emailHelp" class="form-text text-danger">{{ $errors->first('description') }}</small>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Lưu dữ liệu</button>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <label for="exampleInputEmail1">Pet</label>
                <select name="pet_id" class="form-control">
                    <option value="">Chọn pet</option>
                    @foreach($pets ?? [] as $item)
                        <option value="{{ $item->id }}" {{ ($article->pet_id ?? 0) == $item->id ? "selected" : "" }}>{{ $item->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="exampleInputPassword1">Video</label>
                <input type="file" class="form-control" name="video" value="">
                @if (isset($article->video) && $article->video)
                    <p>{{ $article->video }}</p>
                @endif
                @error('video')
                    <small id="emailHelp" class="form-text text-danger">{{ $errors->first('video') }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label for="exampleInputPassword1">Hình ảnh</label>
                <input type="file" class="form-control" name="avatar" value="">
                @if (isset($article->avatar) && $article->avatar)
                    <img src="{{ pare_url_file($article->avatar) }}" style="width: 60px;height: 60px; border-radius: 10px; margin-top: 10px" alt="">
                @endif
                @error('avatar')
                    <small id="emailHelp" class="form-text text-danger">{{ $errors->first('avatar') }}</small>
                @enderror
            </div>
        </div>
    </div>
</form>


