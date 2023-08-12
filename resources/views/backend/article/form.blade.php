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
{{--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" crossorigin="anonymous"--}}
{{--        referrerpolicy="no-referrer"></script>--}}

<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.7/css/fileinput.css" media="all"
      rel="stylesheet" type="text/css"/>
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.7/js/fileinput.js"
        type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.7/themes/fa/theme.js"
        type="text/javascript"></script>


<script>
    $(function (){
        $('#copy_menu').off('click').click(function () {
            let $rowMenu = $('.row-menu-temple').clone().removeClass('row-menu-temple');
            $rowMenu.find('.action-row-menu').removeClass('hide');
            $('#wrap-row-menu').append($rowMenu);
        })

        $('#wrap-row-menu').on('click', '.btn-remove', function () {
            let $this = $(this);
            if (confirm("Bạn có chắc chắn muốn xoá menu này?"))
            {
                $this.closest('.row-menu').remove();
            }
        })

        $('#wrap-row-menu').on('click', '.btn-move-up' ,function () {
            let $this = $(this);
            let $rowMenu  = $this.closest('.row-menu');
            let $rowMenuBefore = $rowMenu.prev();
            $rowMenu.after($rowMenuBefore);
        })

        $('#wrap-row-menu').on('click', '.btn-move-down', function () {
            let $this = $(this);
            let $rowMenu  = $this.closest('.row-menu');
            let $rowMenuBefore = $rowMenu.next();
            $rowMenu.before($rowMenuBefore);
        })
    })
</script>
