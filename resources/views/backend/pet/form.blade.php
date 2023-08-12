<form method="POST" action="" autocomplete="off" enctype="multipart/form-data">
    <div class="row">
        <div class="col-sm-8">
            @csrf
            <div class="form-group">
                <label for="exampleInputEmail1">Tên</label>
                <input type="text" name="name" placeholder="Tên" class="form-control" value="{{ old('name', $pet->name ?? "") }}">
                @error('name')
                <small id="emailHelp" class="form-text text-danger">{{ $errors->first('name') }}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Mô tả</label>
                <textarea name="description" class="form-control" id="" cols="30" rows="3">{{ old('description', $pet->description ?? "") }}</textarea>
                @error('description')
                <small id="emailHelp" class="form-text text-danger">{{ $errors->first('description') }}</small>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Lưu dữ liệu</button>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <label for="exampleInputEmail1">Danh mục</label>
                <select name="category_id" class="form-control">
                    <option value="">Chọn danh mục</option>
                    @foreach($categories ?? [] as $item)
                        <option value="{{ $item->id }}" {{ ($pet->category_id ?? 0) == $item->id ? "selected" : "" }}>{{ $item->name }}</option>
                    @endforeach
                </select>
                @error('category_id')
                    <small id="emailHelp" class="form-text text-danger">{{ $errors->first('category_id') }}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Giới tính</label>
                <select name="sex" class="form-control">
                    <option value="duc" {{ ($product->sex ?? 'duc') == 'duc' ? "selected" : "" }}>Con đực</option>
                    <option value="cai" {{ ($product->sex ?? 'duc') == 'cai' ? "selected" : "" }}>Con cái</option>
                </select>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Tuổi</label>
                <input type="number" name="age" placeholder="0" class="form-control" value="{{ old('age', $pet->age ?? 0) }}">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Hình ảnh</label>
                <input type="file" class="form-control" name="avatar">
                @if (isset($pet->avatar) && $pet->avatar)
                    <img src="{{ pare_url_file($pet->avatar) }}" style="width: 60px;height: 60px; border-radius: 10px; margin-top: 10px" alt="">
                @endif
            </div>
        </div>
    </div>
</form>


{{-- 
<script>
    $(function (){

    })
</script> --}}
