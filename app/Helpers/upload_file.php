<?php




if (!function_exists('upload_image')) {
    /**
     * @param $file [tên file trùng tên input]
     * @param array $extend [ định dạng file có thể upload được]
     * @return array|int [ tham số trả về là 1 mảng - nếu lỗi trả về int ]
     */
    function upload_image($file, $folder = '', array $extend = array())
    {
        $code = 1; // biến xác định việc tải file có thành công không.
        // lay duong dan anh, là biến được sử dụng để lưu đường dẫn tới tệp tạm thời của hình ảnh được tải lên trên máy chủ
        // Khi người dùng tải lên một file, nó sẽ được lưu tạm thời trong một thư mục tạm của máy chủ. 
        //  tạo đường dẫn tới file tạm thời đã được tải lên.
        $baseFilename = public_path() . '/uploads/' . $_FILES[$file]['name'];

        $size = $_FILES[$file]['size'];
        $size =  round($size / (1024),1);

        // thong tin file
        $info = new SplFileInfo($baseFilename);

        // đuôi file
        $ext = strtolower($info->getExtension());

        // kiem tra dinh dang file
        if (!$extend)
            $extend = ['png', 'jpg', 'jpeg', 'webp', 'gif', 'mp4'];

        if (!in_array($ext, $extend)) // nếu định dạng file không thuộc extend thì việc tải file thất bại
            return $data['code'] = 0;

        // Tên file mới
        $nameFile = trim(str_replace('.' . $ext, '', strtolower($info->getFilename()))); // loại bỏ đuôi tệp, lấy tên file và chuyển thành chữ thường
        $filename = date('Y-m-d__') . \Illuminate\Support\Str::slug($nameFile) . '.' . $ext;;// tạo tên file bằng cách nối với ngày tháng năm hiện tại + chuỗi slug từ tên file + đuôi file.
        // thu muc goc de upload, tạo đường dẫn tới thư mục upload ảnh trong ứng dụng 
        $path = public_path() . '/uploads/' . date('Y/m/d/');
        if ($folder)
            $path = public_path() . '/' . $folder . '/' . date('Y/m/d/');

        if (!\File::exists($path))
            @mkdir($path, 0777, true);

        // di chuyen file vao thu muc uploads, di chuyển file từ trên máy chủ tới thư mục được chỉ định.
        move_uploaded_file($_FILES[$file]['tmp_name'], $path . $filename);
        $data = [
            'name'     => $filename,
            'code'     => $code,
            'ext'      => $ext,
            'path'     => $path,
            'size'     => $size,
            'path_img' => 'uploads/' . $filename
        ];

        return $data;
    }
}

function upload_file($file, $folder = '', array $allowedExtensions = [])
{
    $code = 1;

    // Đường dẫn tạm thời của tệp
    $tempFilePath = public_path() . '/uploads/' . $_FILES[$file]['name'];

    // Kiểm tra xem tệp có tồn tại không
    // if (!file_exists($tempFilePath)) {
    //     return [
    //         'code' => 0,
    //         'message' => 'Tệp không tồn tại.'
    //     ];
    // }

    $size = $_FILES[$file]['size'];
    $size =  round($size / (1024),1);

    // Kiểm tra định dạng phần mở rộng của tệp
    $info = new SplFileInfo($tempFilePath);
    $extension = strtolower($info->getExtension());

    if (!empty($allowedExtensions) && !in_array($extension, $allowedExtensions) && $extension !== 'mp4') {
        return [
            'code' => 0,
            'message' => 'Định dạng tệp không được phép.'
        ];
    }

    // Tạo tên mới cho tệp
    $nameFile = trim(str_replace('.' . $extension, '', strtolower($info->getFilename())));
    $filename = date('Y-m-d__') . \Illuminate\Support\Str::slug($nameFile) . '.' . $extension;;
    // $filename = date('Y-m-d__') . \Illuminate\Support\Str::slug($info->getBasename(), '_') . '.' . $extension;

    // Đường dẫn lưu trữ tệp
    $path = public_path($folder) . '/uploads/' . date('Y/m/d/');
    if ($folder)
        $path = public_path() . '/' . $folder . '/' . date('Y/m/d/');

    if (!file_exists($path)) {
        mkdir($path, 0777, true);
    }

    // Di chuyển tệp vào thư mục lưu trữ
    move_uploaded_file($_FILES[$file]['tmp_name'], $path . $filename);
    // move_uploaded_file($tempFilePath, $path . $filename);
    
    $data = [
        'name' => $filename,
        'code' => $code,
        'ext' => $extension,
        'path' => $path,
        'size'     => $size,
        'path_img' => $folder . '/' . date('Y/m/d/') . $filename
    ];

    return $data;
}




if (!function_exists('pare_url_file')) {
    function pare_url_file($image, $folder = 'uploads')
    {
        if (!$image) {
            return 'https://cuocsongdungnghia.com/wp-content/uploads/2018/05/loi-hinh-anh.jpg';
//            return '/images//preloader.png';
        }
        $explode = explode('__', $image);

        if (isset($explode[0])) {
            $time = str_replace('_', '/', $explode[0]);
            return '/' . $folder . '/' . date('Y/m/d', strtotime($time)) . '/' . $image;
        }
    }
}
