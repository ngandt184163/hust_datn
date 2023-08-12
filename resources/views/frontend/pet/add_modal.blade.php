
<div class="modal fade" id="modal-add">
    <div class="modal-dialog">
        <div class="modal-content">
            {{-- <div class="container">
                <div class="row">
                    <div class="col-lg-push-3  col-lg-6"> --}}
                        <form data-url="{{ route('get_user.pet.store.ajax') }}" id="form-add" method="POST" action="" autocomplete="off" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-header">
                                <h4 class="modal-title">Add Pet</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên</label>
                                    <input id="pet-name" style="border: 1px solid gray" type="text" name="name" placeholder="Tên" class="form-control" value="{{ old('name', $pet->name ?? "") }}">
                                    {{-- @error('name') --}}
                                    <small id="emailHelp" class=" name-err form-text text-danger"></small>
                                    {{-- @enderror --}}
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Mô tả</label>
                                    <textarea id="pet-description" style="border: 1px solid gray" name="description" class="form-control" id="" cols="30" rows="3">{{ old('description', $pet->description ?? "") }}</textarea>
                                </div>
                                <div class="form-group">
                                    <div style="display: flex">
                                        <label for="exampleInputEmail1">Danh mục </label>
                                        <button class="btn btn-link"  style="color: #fa6243; padding-left: 136px"  id="addCategoryButton" type="button">Thêm danh mục</button>
                                    </div>
                                    
                                    <select id="pet-category_id" name="category_id" class="form-control">
                                        <option value="">Chọn danh mục </option>
                                        @foreach($categories ?? [] as $item)
                                            <option value="{{ $item->id }}" {{ ($pet->category_id ?? 0) == $item->id ? "selected" : "" }}>{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                    {{-- @error('category_id') --}}
                                        <small id="emailHelp" class="category_id-err form-text text-danger">{{ $errors->first('category_id') }}</small>
                                    {{-- @enderror --}}
                                </div>
                                <div id="customCategoryContainer" style="display: none;">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Danh mục tùy chọn</label>
                                        <input style="border: 1px solid gray" id="pet-custom_category" type="text" name="custom_category" placeholder="Nhập danh mục" class="form-control">
                                    </div>
                                </div>
                                {{-- @error('custom_category') --}}
                                    <small id="emailHelp" class="custom_category-err form-text text-danger">{{ $errors->first('custom_category') }}</small>
                                {{-- @enderror --}}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Giới tính</label>
                                    <select id="pet-sex" name="sex" class="form-control">
                                        <option value="duc" {{ ($product->sex ?? 'duc') == 'duc' ? "selected" : "" }}>Con đực</option>
                                        <option value="cai" {{ ($product->sex ?? 'duc') == 'cai' ? "selected" : "" }}>Con cái</option>
                                        <option value="cai" {{ ($product->sex ?? 'duc') == 'cai' ? "selected" : "" }}>Lưỡng tính</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tuổi</label>
                                    <input id="pet-age" style="border: 1px solid gray" type="number" name="age" placeholder="0" class="form-control" value="{{ old('age', $pet->age ?? 0) }}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Hình ảnh</label>
                                    <input id="pet-avatar" type="file" class="form-control" name="avatar">
                                    @if (isset($pet->avatar) && $pet->avatar)
                                        <img src="{{ pare_url_file($pet->avatar) }}" style="width: 60px;height: 60px; border-radius: 10px; margin-top: 10px" alt="">
                                    @endif
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Add</button>
                            </div>
                        </form>
                    {{-- </div>
                </div>
            </div> --}}
        </div>
    </div>
</div>




<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
//     $(function toggleClass(element) {
//     $('#addCategoryButton').on('click', function() {
//         $('#customCategoryContainer').show();
//     });
// });

$(function() {
    $('#addCategoryButton').on('click', function() {
        $('#customCategoryContainer').toggle();
    });
});

</script>