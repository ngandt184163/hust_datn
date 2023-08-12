@extends('backend.layouts.app_backend')
@section('content')
    <div class="d-flex justify-content-between align-items-center">
        <h2>Bài viết</h2>
        {{-- <a href="{{ route('get_admin.article.create') }}">Thêm mới</a> --}}
        <div class="">
            <select name="menu_id" class="form-control" id="menuSelect">
                <option value="">Thêm mới</option>
                <option value="1">Bài đăng</option>
                <option value="2">Blog</option>
            </select>
        </div>
    </div>
    <div>
        <form class="form-inline">
            <div class="form-group mb-2 mr-2">
                <label for="inputPassword2" class="sr-only">Tên</label>
                <input type="text" name="n" class="form-control" value="{{ Request::get('n') }}" placeholder="Tên bài viết">
            </div>
            <button type="submit" class="btn btn-primary mb-2">Find</button>
        </form>
    </div>
    <div class="table-responsive">
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Avatar</th>
                    <th>Tên bài viết</th>
                    <th>Danh mục</th>
                    <th>Author</th>
                    <th>Ngày tạo</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
                @foreach($articles ?? [] as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>
                            <a href="{{ route('get.article.detail', $item->id) }}" style="display: inline-block;position: relative">
                                <img src="{{ pare_url_file($item->avatar) }}" style="width: 60px;height: 60px; border-radius: 10px" alt="">
                                <span class="badge badge-danger" style="position: absolute;right: 10px;top: 10px">{{ $item->images_count }}</span>
                            </a>
                        </td>
                        <td>
                            {{ $item->name }} <br>
                        </td>
                        <td>{{ $item->menu->name ?? "[N\A]" }}</td>
                        <td>{{ $item->user->name ?? "[N\A]" }}</td>
                        <td>{{ $item->created_at }}</td>
                        <td>
                            <a href="{{ $item->type == 1 ? route('get_admin.article.update', $item->id) : route('get_admin.article_blog.update', $item->id) }}">Edit</a>
                            {{-- <a href="{{ route('get_admin.article.update', $item->id) }}">Edit</a> --}}
                            <a href="javascript:;void(0)">|</a>
                            {{-- <a href="{{ route('get_admin.article.delete', $item->id) }}">Delete</a> --}}
                            <a onclick="return confirm('Bạn có chắc chắn muốn xóa?')" href="{{ route('get_admin.article.delete', $item->id) }}">Delete</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div>
        {!! $articles->appends($query ?? [])->links() !!}
    </div>


    <script>
        // Lấy thẻ select theo id
        const menuSelect = document.getElementById('menuSelect');
    
        // Thêm sự kiện "change" vào thẻ select
        menuSelect.addEventListener('change', function() {
            // Lấy giá trị của tùy chọn đã chọn
            const selectedValue = this.value;
    
            // Kiểm tra giá trị của tùy chọn
            if (selectedValue === '1') {
                // Chuyển hướng đến route tương ứng khi người dùng chọn "Bài đăng"
                window.location.href = "{{ route('get_admin.article.create') }}";
            } else if (selectedValue === '2') {
                // Chuyển hướng đến route tương ứng khi người dùng chọn "Blog"
                // Replace "route_blog_here" bằng route cho blog của bạn
                window.location.href = "{{ route('get_admin.article_blog.create') }}";
            }
            // Thêm các tùy chọn khác nếu cần
        });
    </script>
@stop
