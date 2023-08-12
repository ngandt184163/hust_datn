@extends('backend.layouts.app_backend')
@section('content')
    <div class="d-flex justify-content-between align-items-center">
        <h2>Danh sách thú cưng</h2>
        <a href="{{ route('get_admin.pet.create') }}">Thêm mới</a>
    </div>
    <div>
        <form class="form-inline">
            <div class="form-group mb-2 mr-2">
                <label for="inputPassword2" class="sr-only">Tên</label>
                <input type="text" name="n" class="form-control" value="{{ Request::get('n') }}" placeholder=" abc ">
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
                    <th>Tên</th>
                    <th>Tuổi</th>
                    <th>Loại</th>
                    <th>Author</th>
                    <th>Giới tính</th>
                    <th>Ngày tạo</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pets ?? [] as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>
                            <a href="{{ route('get.pet.detail', $item->id) }}" style="display: inline-block;position: relative">
                                <img src="{{ pare_url_file($item->avatar) }}" style="width: 60px;height: 60px; border-radius: 10px;object-fit: cover" alt="">
                            </a>
                        </td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->age }}</td>
                        <td>{{ $item->category->name ?? "[N\A]" }}</td>
                        <td>{{ $item->user->name ?? "[N\A]" }}</td>
                        <td>{{ $item->sex == 'duc'? "Con đực" : "Con cái" }}</td>
                        <td>{{ $item->created_at }}</td>
                        <td>
                            <a href="{{ route('get_admin.pet.update', $item->id) }}">Edit</a>
                            <a href="javascript:;void(0)">|</a>
                            {{-- <a href="{{ route('get_admin.pet.delete', $item->id) }}">Delete</a> --}}
                            <a onclick="return confirm('Bạn có chắc chắn muốn xóa?')" href="{{ route('get_admin.pet.delete', $item->id) }}">Delete</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div>
        {!! $pets->appends($query ?? [])->links() !!}
    </div>
@stop
