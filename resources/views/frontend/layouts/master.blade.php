
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <title>@yield('title_page','Trang chủ')</title>
    <link rel="icon" href="{{ asset('theme_frontend/images/fav.png') }}" type="image/png" sizes="16x16">

    <link rel="stylesheet" href="{{ asset('theme_frontend/css/main.min.css') }}">
    <link rel="stylesheet" href="{{ asset('theme_frontend/css/weather-icons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('theme_frontend/css/toast-notification.css') }}">
    <link rel="stylesheet" href="{{ asset('theme_frontend/css/page-tour.css') }}">
    <link rel="stylesheet" href="{{ asset('theme_frontend/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('theme_frontend/css/color.css') }}">
    <link rel="stylesheet" href="{{ asset('theme_frontend/css/responsive.css') }}">


    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script>
        function pare_url_file(image, folder = 'uploads') {
            if (!image) {
                return 'https://cuocsongdungnghia.com/wp-content/uploads/2018/05/loi-hinh-anh.jpg';
            }
            var explode = image.split('__');
    
            if (explode[0]) {
                var time = explode[0].replace('_', '/');
                return '/' + folder + '/' + new Date(time).toISOString().slice(0, 10).replace(/-/g, '/') + '/' + image;
            }
        }
    </script>

    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>

    <script>

        // Enable pusher logging - don't include this in production
        Pusher.logToConsole = true;

        var pusher = new Pusher('ad573658a742e127e0af', {
        cluster: 'ap1'
        });
        
        const currentUserId = @json(auth()->user()->id ?? 0) ;
        console.log("id nguoi dung:", currentUserId);
        var channel = pusher.subscribe('notification-channel');
        channel.bind('user_has_notification', function(data) {
            console.log("id sự kiện:", data.userId);
            console.log("id nguoi dung:", currentUserId);
            if (data.userId == currentUserId ){
                console.log('vào đây chưa');
                // alert(JSON.stringify(data));
                const newNotificationsCount = parseInt(document.getElementById('notification-count').textContent) + 1;
                document.getElementById('notification-count').textContent = newNotificationsCount;
                $.toast({
                    text: 'Bạn có thông báo mới.',
                    heading: 'Thông báo',
                    showHideTransition: 'slide',
                    icon: 'success',
                    loader: true,
                    loaderBg: '#9EC600',
                    position: 'bottom-left',
                    hideAfter: 5000
                    });
            }
        });

        // hủy thông báo
        var channel_2 = pusher.subscribe('un-notification-channel');
        channel_2.bind('user_un_notification', function(data) {
            console.log("id sự kiện:", data.userId);
            console.log("id nguoi dung:", currentUserId);
            if (data.userId == currentUserId ){
                console.log('vào đây chưa');
                // alert(JSON.stringify(data));
                const newNotificationsCount = parseInt(document.getElementById('notification-count').textContent) - 1;
                document.getElementById('notification-count').textContent = newNotificationsCount;
                $.toast({
                    text: 'Ai đó đã hủy tương tác với bạn.',
                    heading: 'Thông báo',
                    showHideTransition: 'slide',
                    icon: 'warning',
                    loader: true,
                    loaderBg: '#9EC600',
                    position: 'bottom-left',
                    hideAfter: 5000
                    });
            }
        });
    </script>

</head>
<body>
<div class="wavy-wraper">
    <div class="wavy">
        <span style="--i:1;">p</span>
        <span style="--i:2;">e</span>
        <span style="--i:3;">t</span>
        <span style="--i:4;">t</span>
        <span style="--i:5;">o</span>
        <span style="--i:6;">.</span>
        <span style="--i:7;">.</span>
        <span style="--i:8;">.</span>
    </div>
</div>
<div class="theme-layout">
    <div class="postoverlay"></div>

    <div class="responsive-header">
        <div class="mh-head first Sticky">
			<span class="mh-btns-left">
				<a class="" href="#menu"><i class="fa fa-align-justify"></i></a>
			</span>
            <span class="mh-text">
				<a href="newsfeed.html" title=""><img src="" alt=""></a>
			</span>
            <span class="mh-btns-right">
				<a class="fa fa-sliders" href="#shoppingbag"></a>
			</span>
        </div>
        <div class="mh-head second">
            <form class="mh-form">
                <input placeholder="search" />
                <a href="#/" class="fa fa-search"></a>
            </form>
        </div>
    </div><!-- responsive header -->

    <div class="topbar stick">
        <div class="logo">
            <a title="" href="/"><img width="10px" height="10px" style="border-radius: 25%" src="https://brocanvas.com/wp-content/uploads/2022/01/Hinh-anh-chu-cho-nho-dang-yeu-.jpg" alt=""></a>
        </div>
        <div class="top-area">
            @guest
            <div class="main-menu">
				<span>
			    	<a href="{{ route('get.login') }}">Đăng nhập</a>
			    </span>
                <span>
			    	<a href="{{ route('get.register') }}">Đăng kí</a>
			    </span>
            </div>
            @endguest
            
            @auth
                <div class="top-search">
                    <form method="get" action="{{ route('get.search') }}" class="">
                        <input type="text" name="k" value="{{ Request::get('k') }}" placeholder="Tìm kiếm tên pet, chủ nhân">
                        <button data-ripple><i class="ti-search"></i></button>
                    </form>
                </div>

                <ul class="setting-area-backup">
                    <li><a href="/" title="Home" ><i class="fa fa-home"></i></a></li>
                    <li><a href="{{ route('get.blog') }}" title="Blog" ><i class="fa fa-pencil"></i></a></li>
                    <li><a href="{{ route('get.map') }}" title="Map" ><i class="fa fa-map"></i></a></li>
                </ul>
            @endauth

            @auth
                <div class="notification notification-icon">
                    <span id="notification-count" class="notification-count">{{ session('newNotificationsCount') }}</span>
                    {{-- <span id="newNotificationsCount" class="notification-count">{{ session('newNotificationsCount') }}</span> --}}
                    <span class="fa fa-bell"></span>
                </div>
            @endauth
            
            <!-- Giao diện thông báo -->
            {{-- <div>
                <h6>Thông báo.</h6> --}}
                <div id="notification-container" class="notification-container hidden">
                    <!-- Nội dung thông báo -->
    
                    <div class="notification-item">
                        <h5 style="color: #fa6243;">Thông báo</h5>
                    </div>
    
                </div>
            {{-- </div> --}}
            
  
            {{-- nontification --}}
            <div class="user-img">
                @auth
                <h5>Hi {{ \Auth::user()->name ?? "" }}</h5>
                <img class="avt" id="user-avatar" src="{{ pare_url_file(Auth::user()->avatar) }}" alt="">
                <span class="status f-online"></span>
                <div class="user-setting">
                    <ul class="log-out">
                        <li><a href="{{ route('get.profile.detail', ['id' => Auth::user()->id])}}" title=""><i class="ti-user"></i>Trang cá nhân</a></li>
                        <li><a href="{{ route('get.account')}}" title=""><i class="ti-user"></i>Cập nhật thông tin</a></li>
                        <li><a href="{{ route('get_user.profile.update_password')}}" title=""><i class="ti-key"></i>Đổi mật khẩu</a></li>
                        <li><a href="{{ route('get_user.pet.index')}}" title=""><i class="ti-pencil-alt"></i>Pet</a></li>
                        <li><a href="{{ route('get_user.article.index') }}" title=""><i class="ti-settings"></i>Article</a></li>
                        <li><a href="{{ route('get_user.article_blog.index') }}" title=""><i class="ti-settings"></i>Blog</a></li>
                        <li><a href="{{ route('get.logout.user') }}" title=""><i class="ti-settings"></i>Logout</a></li>
                    </ul>
                </div>
                @endauth
            </div>
        </div>
    </div><!-- topbar -->

    <section>
        @yield('content')
    </section>
    
    <div class="bottombar">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <span class="copyright">© 20184163-2022.2 Đồ án tốt nghiệp .</span>
                </div>
            </div>
        </div>
    </div>

</div>

{{-- ============= --}}
{{-- <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.3/dist/jquery.min.js:2:30310"></script> --}}
{{-- ============= --}}
<script src="{{ asset('theme_frontend/js/main.min.js') }}"></script>
<script src="{{ asset('theme_frontend/js/toast-notificatons.js') }}"></script>
<script src="{{ asset('theme_frontend/js/script.js') }}"></script>


    <script type="text/javascript" charset="utf-8">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>

    {{-- xu li an hien nut load more --}}
    <script>
        var isAuthenticated = {{ Auth::check() ? 'true' : 'false' }};
        if (!isAuthenticated) {
            var loadMoreBtn = $('#loadMoreBtn');
            if(loadMoreBtn) {
                loadMoreBtn.hide();
            }
        }
    </script>

{{-- xử lí lỗi không mong muốn --}}
    <script>
        $(document).ready(function() {
            var hasReloaded = @json(session('hasReloaded'));
            var currentUrl = window.location.href;
            var url = new URL(currentUrl);
            var pathname = url.pathname;
            var pathComponents = pathname.split("/").filter(component => component !== "");
            if ((pathComponents[0] === "account" && (pathComponents[1] === "article" || pathComponents[1] === "article-blog"))) { 
                          
                window.addEventListener('load', function() {
                    if (hasReloaded) {
                        @php
                            session(['hasReloaded' => false]);
                        @endphp
                        // Thực hiện load lại trang
                        console.log("load lại trang");
                        location.reload();
                        
                    }
                });
            }
        });
        
    </script>

    {{-- xử lí load more --}}
    <script>

        // xử lí load more
        $(document).ready(function() {
            var loadMoreCalled = false; // Biến để kiểm tra xem đã gọi hàm loadMoreArticles() trước đó hay chưa
            // xu li lay duong dan hien tai cua trinh duyet
            var currentUrl = window.location.href;
            console.log(currentUrl); // In ra URL của trang web hiện tại
            var url = new URL(currentUrl);

            // var protocol = url.protocol; // "http:"
            // var hostname = url.hostname; // "127.0.0.1"
            // var port = url.port; // "8000"
            var pathname = url.pathname; // "/account/pet/18"

            // Tách thành phần sau dấu /
            var pathComponents = pathname.split("/").filter(component => component !== "");
            console.log(pathComponents); // ["account", "pet", "18"]

            var page = 1; // Trang hiện tại
            var perPage = 10; // Số bài viết lấy cho mỗi trang
            var loadMoreBtn = $('#loadMoreBtn');

            loadMoreBtn.click(function() {
                loadMoreArticles(); // Gọi hàm để tải thêm bài viết
            });
            
            function loadMoreArticles() {
                $.ajax({
                    url: "/load-more-articles", // Thay thế bằng đường dẫn tới API hoặc tệp xử lý yêu cầu
                    method: "POST",
                    data: {
                        page: page,
                        perPage: perPage,
                        pathComponents : pathComponents,
                        _token: "{{ csrf_token() }}" // Thêm token CSRF để bảo mật
                    },
                    beforeSend: function(xhr) {
                        // Kiểm tra và xử lý đối tượng o trước khi gửi yêu cầu
                        if (!xhr.hasOwnProperty("hasContent")) {
                            xhr.hasContent = true;
                        }
                        if (!xhr.hasOwnProperty("data") || xhr.data === null) {
                            xhr.data = {};
                        }
                    },
                    success: function(response) {
                        // Xử lý dữ liệu phản hồi từ server
                        var articles = response;

                        console.log("danh sách bài viết: ",articles);
                        // Thêm các bài viết mới vào view hiện tại
                        if (Array.isArray(articles) && articles.length > 0) {
                            $.each(articles, function(index, article) {
                                // Sử dụng mã PHP để nhúng hàm pare_url_file vào đoạn mã JavaScript
                                var avatarUrl = pare_url_file(article?.user?.avatar || "");
                                var videoUrl = pare_url_file(article.video || "");
                                var imageUrl = pare_url_file(article.avatar || "");
                                console.log(article);

                        var localCreatedAt = new Date(article.created_at).toLocaleString('en-US', { timeZone: 'Asia/Ho_Chi_Minh' });

                                if(pathComponents.length === 0 || pathComponents[0] === 'video' || pathComponents[0] === 'kham-pha') {
                                // Thêm mã HTML để hiển thị thông tin bài viết
                                    var html = '<div class="central-meta item">' +
                                        '<div class="user-post">' +
                                        '<div class="friend-info">' +
                                        '<figure>' +
                                        '<img style="width: 40px;height: 40px;border-radius: 50%;object-fit: cover" src="' + avatarUrl + '" alt="">' +
                                        '</figure>' +
                                        '<div class="friend-name">' +
                                        '<div class="more">' +
                                        '<div class="more-post-optns"><i class="ti-more-alt"></i>' +
                                        '<ul>' +
                                        '<li>' +
                                        '<a data-id="'+article.id+'" class="view-detail-btn">' +
                                        '<i class="fa fa-pencil-square-o"></i> Chi tiết' +
                                        '</a>' +
                                        '</li>' +
                                        '</ul>' +
                                        '</div>' +
                                        '</div>' +
                                        '<ins><a href="/profile/' + article.user_id + '" title="' + article.user.name + '">Hi  ' + article.user.name + '</a></ins>' +
                                        '<span><i class="fa fa-globe"></i> published: ' + localCreatedAt + ' </span>' +
                                        '</div>' +
                                        '<div class="post-meta">' +
                                        '<figure>' +
                                        '<div class="img-bunch">' +
                                        '<div class="row">' +
                                        '<div class="col-lg-12 col-md-12 col-sm-12">' +
                                        '<figure>' +
                                        '<a data-id="'+article.id+'" class="view-detail-btn" title="">' +
                                        (article.video ?
                                            '<video class="video" id="'+article.id+'" data-id="'+article.id+'"  width="100%" height="240" controls>' +
                                            '<source src="' + videoUrl + '" type="video/mp4">' +
                                            '</video>' :
                                            '<img src="' + imageUrl + '" style="width: 100%;height: auto" alt="">') +
                                        '</a>' +
                                        '</figure>' +
                                        '<div class="we-video-info">' +
                                        '<ul>' +
                                        '<li>' +
                                        '<div class="likes heart" title="Like/Dislike">' +
                                        '<a data-article-id="' + article.id + '" class="like-article like like_out" onclick="toggleClass(this)" href="\#">❤</a>' +
                                        '<span id="total_like_' + article.id + '">' + article.total_like + '</span>' +
                                        '</div>' +
                                        '</li>' +
                                        '<li>' +
                                        '<span class="comment" title="Comments">' +
                                        '<i class="fa fa-commenting"></i>' +
                                        '<ins id="total_comment_' + article.id + '">' + (article.total_comment || 0) + '</ins>' +
                                        '</span>' +
                                        '</li>' +
                                        '</ul>' +
                                        '</div>' +
                                        '</div>' +
                                        '</div>' +
                                        '</div>' +
                                        '</figure>' +
                                        '</div>' +
                                        '</div>' +
                                        '</div>';

                                    // Thêm nội dung mới vào phần tử có ID là "articlesContainer"
                                    $('.add-article').append(html);
                                    // console.log("chèn ở đây");
                                }
                                if(pathComponents[0] === 'profile') {
                                    var html = '<div class="col-lg-3 col-md-6 col-sm-6">' +
                                                '<div class="tube-post">' +
                                                '<figure>' +
                                                '<a data-id="'+article.id+'" class="view-detail-btn">' +
                                                '<img style="height: 190px;object-fit: cover" src="' + imageUrl + '" alt="">' +
                                                '</a>' +
                                                '<em>Like: ' +'<span id="total_like_' + article.id + '">' + article.total_like + '</span>' +'</em>' +
                                                '</figure>' +
                                                '<div class="tube-title">' +
                                                '<h6><a data-id="'+article.id+'" class="view-detail-btn" title="'+ article.name +'">'+ article.name +'</a></h6>' +
                                                '</div>' +
                                                '</div>' +
                                                '</div>';

                                    $('#article-profile').append(html);
                                }

                                if(pathComponents[0] === 'account' && pathComponents[1] === 'article') {
                                    var html = '<div class="col-lg-3 col-md-6 col-sm-6">' +
                                                    '<div class="tube-post">' +
                                                        '<figure>' +
                                                            '<a data-id="'+article.id+'" class="view-detail-btn">' +
                                                                '<img style="height: 190px;object-fit: cover" src="' + imageUrl + '" alt="">' +
                                                            '</a>' +
                                                            '<em>Like: ' +'<span id="total_like_' + article.id + '">' + article.total_like + '</span>' +'</em>' +
                                                            '<div class="more">' +
                                                                '<div class="more-post-optns"><i class="ti-more-alt"></i>' +
                                                                    '<ul>' +
                                                                        '<li class="">' +
                                                                            '<a href="/account/article/update/' + article.id + '">Sửa</a>' +
                                                                        '</li>' +
                                                                        '<li class="">' +
                                                                            '<a onclick="return confirm(\'Bạn có chắc chắn muốn xóa?\')" href="/account/article/delete/' + article.id + '">Xoá</a>' +
                                                                        '</li>' +
                                                                    '</ul>' +
                                                                '</div>' +
                                                            '</div>' +
                                                        '</figure>' +
                                                        '<div class="tube-title">' +
                                                            '<h6><a data-id="'+article.id+'" class="view-detail-btn" title="'+ article.name +'">'+ article.name +'</a></h6>' +
                                                        '</div>' +
                                                    '</div>' +
                                                '</div>';
                                    $('#article-article').append(html);

                                }
                                if(pathComponents[0] === 'account' && pathComponents[1] === 'article-blog') {
                                    var html = '<div class="col-lg-3 col-md-6 col-sm-6">' +
                                                    '<div class="tube-post">' +
                                                        '<figure>' +
                                                            '<img style="height: 190px;object-fit: cover" src="'+ imageUrl +'" alt="">' +
                                                            '<em>Like: ' +'<span id="total_like_' + article.id + '">' + article.total_like + '</span>' +'</em>' +
                                                            '<div class="more">' +
                                                                '<div class="more-post-optns"><i class="ti-more-alt"></i>' +
                                                                    '<ul>' +
                                                                        '<li class="">' +
                                                                            '<a href="/account/article-blog/update/' + article.id + '">Sửa</a>' +
                                                                        '</li>' +
                                                                        '<li class="">' +
                                                                            '<a onclick="return confirm(\'Bạn có chắc chắn muốn xóa?\')" href="/account/article-blog/delete/' + article.id + '">Xoá</a>' +
                                                                        '</li>' +
                                                                    '</ul>' +
                                                                '</div>' +
                                                            '</div>' +
                                                        '</figure>' +
                                                        '<div class="tube-title">' +
                                                            '<h6><a data-id="'+article.id+'" class="view-detail-btn" title="">'+ article.name +'</a></h6>' +
                                                        '</div>' +
                                                    '</div>' +
                                                '</div>';
                                    $('#article-blog').append(html);

                                }
                                if(pathComponents[0] === 'pet') {
                                    var html = '<div class="col-lg-6 col-md-6">' +
                                                    '<div class="central-meta">' +
                                                        '<div class="blog-post">' +
                                                            '<div class="friend-info">' +
                                                                '<figure>' +
                                                                    '<img style="width: 40px;height: 40px;border-radius: 50%;object-fit: cover" src="'+ avatarUrl +'" alt="">' +
                                                                '</figure>' +
                                                                '<div class="friend-name">' +
                                                                    '<ins><a href="/profile/' + article.user_id + '" title="' + article.user.name + '">Hi  ' + article.user.name + '</a></ins>' +
                                                                    '<span><i class="fa fa-globe"></i> published: ' + localCreatedAt + ' </span>' +
                                                                '</div>' +
                                                                '<div class="post-meta">' +
                                                                    '<figure>' +
                                                                        '<a title="" data-id="'+article.id+'" class="view-detail-btn">' +
                                                                            '<img style="height: 300px" src="'+ imageUrl +'" alt="">' +
                                                                        '</a>' +
                                                                    '</figure>' +
                                                                    '<div class="description">' +
                                                                        '<a data-ripple="" class="learnmore view-detail-btn" data-id="'+article.id+'">Chi tiết</a>' +
                                                                        '<h2 style="min-height: 55px"><a href="/article/' + article.id + '" title="">'+ article.name +'</a></h2>' +
                                                                        '<p style="min-height: 52px">'+ article.description +'</p>' +
                                                                    '</div>' +
                                                                '</div>' +
                                                            '</div>' +
                                                        '</div>' +
                                                    '</div>' +
                                                '</div>';
                                    $('#article-pet').append(html);

                                }    
                                if(pathComponents[0] === 'blog') {
                                    var html = '<div class="col-lg-6 col-md-6">' +
                                                    '<div class="central-meta">' +
                                                        '<div class="blog-post">' +
                                                            '<div class="friend-info">' +
                                                                '<figure>' +
                                                                    '<img style="width: 40px;height: 40px;border-radius: 50%;object-fit: cover" src="'+avatarUrl+'" alt="">' +
                                                                '</figure>' +
                                                                '<div class="friend-name">' +
                                                                    '<ins><a href="/profile/' + article.user_id + '" title="' + article.user.name + '">Hi  ' + article.user.name + '</a></ins>' +
                                                                    '<span><i class="fa fa-globe"></i> published: ' + localCreatedAt + ' </span>' +
                                                                '</div>' +
                                                                '<div class="post-meta">' +
                                                                    '<figure>' +
                                                                        // '<a title="" href="/blog/' + article.id + '">' +
                                                                        //     '<img style="height: 300px" src="'+imageUrl+'" alt="">' +
                                                                        // '</a>' +
                                                                        '<a data-id="'+article.id+'" class="view-detail-btn" title="">' +
                                                                        (article.video ?
                                                                            '<video class="video" id="'+article.id+'" data-id="'+article.id+'" width="100%" height="300" controls>' +
                                                                            '<source src="' + videoUrl + '" type="video/mp4">' +
                                                                            '</video>' :
                                                                            '<img src="' + imageUrl + '" style="width: 100%;height: 300px" alt="">') +
                                                                        '</a>' +
                                                                    '</figure>' +
                                                                    '<div class="description">' +
                                                                        '<a data-ripple="" class="learnmore view-detail-btn" data-id="'+article.id+'" >Chi tiết</a>' +
                                                                        '<h2 style="min-height: 55px"><a data-id="'+article.id+'" class="view-detail-btn" title="">' + article.name + '</a></h2>' +
                                                                        // '<p style="min-height: 52px">' + article.description + '</p>' +
                                                                        `<p style="min-height: 52px">${article.description ?? ' '}</p>` +
                                                                    '</div>' +
                                                                '</div>' +
                                                            '</div>' +
                                                        '</div>' +
                                                    '</div>' +
                                                '</div>';

                                    $('#article-blog').append(html);
                                }
                            });

                        } else {
                            console.log("Không có bài viết để hiển thị");
                            loadMoreBtn.hide();
                            $.toast({
                                text: 'Không còn bài viết để tải',
                                heading: 'Thông báo',
                                showHideTransition: 'slide',
                                icon: 'warning',
                                loader: true,
                                loaderBg: '#9EC600',
                                position: 'bottom-left',
                                hideAfter: 5000
                                });
                        }

                        console.log(page);
                        // Tăng số trang lên 1
                        page++;
                    },
                    error: function(xhr, status, error) {
                        console.log(error); // Xử lý lỗi nếu có
                    }
                });
            }

        });
        // xử lí load more
    </script>

    {{-- xu li like, comment --}}
    <script>
         // Xử lý sự kiện nhấn nút like
        $(document).ready(function() {
            $(".articleDetailContainer").on('click', '.like-article', function(e) {
                e.preventDefault();
                var articleId = $(this).data('article-id');

                $.ajax({
                    url: '/article/like/' + articleId,
                    method: 'GET',
                    data: {
                        articleId: articleId // Thay thế bằng ID của bài viết tương ứng
                    },
                    success: function(response) {
                        // Xử lý phản hồi từ server
                        if (response.success) {
                            // Cập nhật dữ liệu mới trực tiếp trên trang chi tiết bài viết
                            console.log("vì sao");
                            if(document.getElementById('likeCount')){
                                $('#likeCount').text(response.total_like);
                            }
                            
                            console.log("like count: ", response.total_like);
                            
                            if (document.getElementById('total_like_' + articleId)){
                                if(response.isLiked){
                                    const likeCount = parseInt(document.getElementById('total_like_' + articleId).textContent) + 1;
                                    document.getElementById('total_like_' + articleId).textContent = likeCount;
                                }else {
                                    const likeCount = parseInt(document.getElementById('total_like_' + articleId).textContent) - 1;
                                    document.getElementById('total_like_' + articleId).textContent = likeCount;
                                }
                            }
                            
                            // toastr.success(response.message);
                            console.log('thích hoặc bỏ thích thành công á. ');
                            
                            // cập nhật giao diện cho nút like
                            console.log(response.isLiked);
                            if (response.isLiked) {
                                $('.like_in').css({
                                    'font-weight': 'bold',
                                    'background': '#fa6342',
                                    'color': '',
                                    'border': ''
                                });
                                $('.like_out').css({
                                    'color': '#fa6342'
                                });  
                            } else {
                                $('.like_in').css({
                                'font-weight': '',
                                'background': '',
                                'color': 'black',
                                'border': '1px solid #fa6342'
                                });
                                $('.like_out').css({
                                    'color': ''
                                }); 
                            }
                        } else {
                            console.log('lỗi mẹ nó rồi.');
                            $.toast({
                                    text: 'Có thể bạn chưa đăng nhập, vui lòng đăng nhập để bình luận.',
                                    heading: 'Lỗi',
                                    showHideTransition: 'slide',
                                    icon: 'error',
                                    loader: true,
                                    loaderBg: '#9EC600',
                                    position: 'bottom-left',
                                    hideAfter: 5000
                                    });
                        }
                    },
                    error: function(xhr, status, error) {
                        // Xử lý lỗi nếu có
                        // toastr.error('Something went wrong');
                    }
                });
            });

            // Xử lý sự kiện nhấn nút comment
            $(".articleDetailContainer").on('submit', '.comment-form', function(e) {
                e.preventDefault();
                var articleId = $(this).data('article-id');

                $.ajax({
                    url: '/article/' + articleId,
                    method: 'POST',
                    data: {
                        articleId: articleId, // Thay thế bằng ID của bài viết tương ứng
                        comment: $('#content').val(), // Thay thế bằng nội dung comment thực tế
                    },
                    success: function(response) {
                        // Xử lý phản hồi từ server
                        console.log(response.comments);
                        var comments = response.comments;
                        if (response.success) {
                            // Cập nhật dữ liệu mới trực tiếp trên trang chi tiết bài viết
                            var avatarUrl = pare_url_file(comments.user.avatar || "");
                            var createdAtString = comments.created_at; // "2023-07-23T13:57:32.000000Z"
                            var createdAtDate = new Date(createdAtString);
                            var localCreatedAt = createdAtDate.toLocaleString('en-US', { timeZone: 'Asia/Ho_Chi_Minh' });

                            // cập nhật số lượng comment ra màn hình
                            if (document.getElementById('total_comment_' + articleId)){
                                var commentCount = parseInt(document.getElementById('total_comment_' + articleId).textContent) + 1;
                                document.getElementById('total_comment_' + articleId).innerHTML = commentCount;
                            }
                            // console.log(parseInt(document.getElementById(articleId).textContent));
                            // console.log("số lượng cmt:", commentCount);
                            var html = '<li>' +
                                        '<div class="comet-avatar">' +
                                        '<img style="width: 35px;height: 35px;border-radius: 50%;" src="' + avatarUrl + '" alt="">' +
                                        '</div>' +
                                        '<div class="we-comment">' +
                                        '<h5> <a href="/profile/' + comments.user.id +' " title="">' + comments.user.name + '</a></h5>' +
                                        '<br>' +
                                        '<p>' + localCreatedAt + ' : ' + comments.content + '</p>' +
                                        '</div>' +
                                        '</li>';

                            $('#commentList').append(html);
                            // $('#commentCount').text(response.commentCount);
                            $("textarea").val("");
                            console.log('post bình luận thành công.');
                            $('.form-text.text-danger').text('');
                        } else {
                            console.log('post bình luận không thành công.');
                            $.toast({
                                    text: 'Có thể bạn chưa đăng nhập, vui lòng đăng nhập để bình luận.',
                                    heading: 'Lỗi',
                                    showHideTransition: 'slide',
                                    icon: 'error',
                                    loader: true,
                                    loaderBg: '#9EC600',
                                    position: 'bottom-left',
                                    hideAfter: 5000
                                    });

                        }
                    },
                    error: function(xhr, status, error) {
                        // Xử lý lỗi nếu có
                        console.log('ERROR: post bình luận không thành công.');
                        // toastr.error('Something went wrong');
                        var response = JSON.parse(xhr.responseText);
                        if (response.hasOwnProperty('errors')) {
                            var errors = response.errors;
                            // Hiển thị các thông báo lỗi
                            $('.form-text.text-danger').text(errors.comment);
                            console.log(errors.comment);
                        }
                    }
                });
            });

            // xử lí sự kiện nhấn like pet
            $('.like-pet').click(function(e) {
                e.preventDefault();
                var petId = $(this).data('pet-id');

                $.ajax({
                    url: '/pet/like/' + petId,
                    method: 'GET',
                    data: {
                        petId: petId // Thay thế bằng ID của pet tương ứng
                    },
                    success: function(response) {
                        // Xử lý phản hồi từ server
                        if (response.success) {
                            // Cập nhật dữ liệu mới trực tiếp trên trang chi tiết bài viết
                            $('#likeCountPet').text(response.total_like);
                            console.log('thích hoặc bỏ thích thành công. ');
                            // if(document.getElementById('likeCountPet')){
                            //     $('#likeCountPet').text(response.total_like);
                            // }

                            // cập nhật giao diện cho nút like
                            console.log(response.isLiked);
                            if (response.isLiked) {
                                $('.like-pet').css({
                                    'font-weight': 'bold',
                                    'background': '#fa6342',
                                    'color': '',
                                    'border': ''
                                });
                            } else {
                                $('.like-pet').css({
                                'font-weight': '',
                                'background': '',
                                'color': 'black',
                                'border': '1px solid #fa6342'
                            });
                            }
                        } else {
                            // toastr.error('Like failed');
                            console.log('lỗi mẹ nó rồi.');
                        }
                    },
                    error: function(xhr, status, error) {
                        // Xử lý lỗi nếu có
                        // toastr.error('Something went wrong');
                    }
                });
            });
        });

    </script>

    {{-- xử lí cập nhật profile --}}
    <script>
        // Xử lý sự kiện nhấn nút submit form update profile 
        $(document).ready(function() {
            $('#update-profile-form').submit(function(e) {
                e.preventDefault();

                var formData = new FormData();
                formData.append('name', $('.name').val());
                formData.append('email', $('.email').val());
                formData.append('phone', $('.phone').val());
                // formData.append('avatar', $('.avatar')[0].files[0]);

                if ($('.avatar')[0].files.length > 0) {
                    formData.append('avatar', $('.avatar')[0].files[0]);
                }
                var userId = $(this).data('user-id');

                console.log(formData);
                $.ajax({
                    url: '/account',
                    method: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        // Xử lý phản hồi từ server
                        console.log(response.user);
                        var user = response.user;
                        if (response.success) {
                            var newAvatarSrc = pare_url_file(user.avatar || "");
                            console.log('cap nhat thanh cong');
                            $('#name-user').text('');
                            $('#email-user').text('');
                            $('#phone-user').text('');
                            // cập nhật ảnh đại diện nếu có
                            $('.avt').attr('src', newAvatarSrc);
                            $.toast({
                                    text: 'Cập nhật thành công.',
                                    heading: 'Thành công',
                                    showHideTransition: 'slide',
                                    icon: 'success',
                                    loader: true,
                                    loaderBg: '#9EC600',
                                    position: 'bottom-left',
                                    hideAfter: 5000
                                    });
                        } else {
                            console.log('cap nhat that bai');
                            $.toast({
                                    text: 'Cập nhật thất bại.',
                                    heading: 'Lỗi',
                                    showHideTransition: 'slide',
                                    icon: 'error',
                                    loader: true,
                                    loaderBg: '#9EC600',
                                    position: 'bottom-left',
                                    hideAfter: 5000
                                    });
                        }
                    },
                    error: function(xhr, status, error) {
                        // Xử lý lỗi nếu có
                        console.log('cap nhat that bai');
                        // toastr.error('Something went wrong');
                        var response = JSON.parse(xhr.responseText);
                        if (response.hasOwnProperty('errors')) {
                            var errors = response.errors;
                            // Hiển thị các thông báo lỗi
                            $('#name-user').text(errors.name);
                            console.log(errors.name);
                            $('#email-user').text(errors.email);
                            console.log(errors.email);
                            $('#phone-user').text(errors.phone);
                            console.log(errors.phone);
                        }
                    }
                });
            });
        });
    </script>

    {{-- xu li them, cap nhat pet --}}
    <script>
        $(document).ready(function() {
            $('#form-add').submit(function(e){

                e.preventDefault();

                var formData = new FormData();
                formData.append('name', $('#pet-name').val());
                formData.append('description', $('#pet-description').val());
                formData.append('category_id', $('#pet-category_id').val());
                formData.append('custom_category', $('#pet-custom_category').val());
                formData.append('sex', $('#pet-sex').val());
                formData.append('age', $('#pet-age').val());
                // formData.append('avatar', $('#pet-avatar')[0].files[0]);

                if ($('#pet-avatar')[0].files.length > 0) {
                    formData.append('avatar', $('#pet-avatar')[0].files[0]);
                }
                $.ajax({
                    url: '/account/pet',
                    method: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        // toastr.success(response.message)
                        $('#modal-add').modal('hide');
                        console.log(response.pet);
                        var pet = response.pet;
                        if(response.success){
                            var avatarUrl = pare_url_file(pet.avatar || "");

                            var html = '<div class="col-lg-3 col-md-6 col-sm-6">' +
                            '<div class="friend-box">' +
                            '<div class="frnd-meta">' +
                            '<a href="/pet/' + pet.id +'">' +
                            '<img style="margin-top: 0; margin-top: 0;' +
                            'width: 200px;' +
                            'height: 200px;' +
                            'margin-top: 20px;' +
                            'border-radius: 50%;' +
                            'object-fit: cover;" src="'+ avatarUrl +' " alt="">' +
                            '</a>' +
                            '<ul class="frnd-info" style="margin-bottom: 0">' +
                            '<li><span>Name:</span> <a style="color: #fa6243" href="/pet/' + pet.id +'">'+ pet.name +'</a></li>' +
                            '<li><span>Tuổi:</span> '+ pet.age +'</li>' +
                            '<li><span>Loại:</span> '+ pet.category.name + '</li>' +
                            '</ul>' +
                            '<p style="display:flex;justify-content: space-between;">' +
                            '<a href="/account/pet/update/ '+ pet.id +' " title="">Sửa</a>' +
                            '<a onclick="return confirm(\'Bạn có chắc chắn muốn xóa?\')" href="/account/pet/update/ '+ pet.id +' " title="">Xoá</a>' +
                            '</p>' +
                            '</div>' +
                            '</div>' +
                            '</div>';

                            $('#pet-list').prepend(html);
                            $.toast({
                                    text: 'Tạo pet thành công.',
                                    heading: 'Thành công',
                                    showHideTransition: 'slide',
                                    icon: 'success',
                                    loader: true,
                                    loaderBg: '#9EC600',
                                    position: 'bottom-left',
                                    hideAfter: 5000
                                    });
                            
                            // xóa giá trị input cũ
                            // $('#pet-name').text('');
                            // $('#pet-description').text('');
                            // $('#pet-category_id').text('');
                            // $('#pet-custom_category').text('');
                            // $('#pet-sex').text('');
                            // $('#pet-age').text('');
                            // $('#pet-avatar').text('');
                            $('#pet-name').val('');
                            $('#pet-description').val('');
                            $('#pet-category_id').val(null);
                            $('#pet-custom_category').val('');
                            $('#pet-sex').val(null);
                            $('#pet-age').val('');
                            // Nếu bạn muốn xóa giá trị của input file, bạn có thể đặt giá trị của nó thành null
                            $('#pet-avatar').val(null);
                        } else {
                            console.log('tạo pet thất bại.');
                            $.toast({
                                    text: 'Tạo pet thất bại.',
                                    heading: 'Lỗi',
                                    showHideTransition: 'slide',
                                    icon: 'error',
                                    loader: true,
                                    loaderBg: '#9EC600',
                                    position: 'bottom-left',
                                    hideAfter: 5000
                                    });
                        }
                        
                        
                    },
                    error: function (xhr, status, error) {
                        //xử lý lỗi tại đây
                        console.log('tạo pet không thành công.');
                        // toastr.error('Something went wrong');
                        var response = JSON.parse(xhr.responseText);
                        if (response.hasOwnProperty('errors')) {
                            console.log("có vào đây chưa");
                            var errors = response.errors;
                            console.log(errors);
                            // Hiển thị các thông báo lỗi
                            $('.name-err').text(errors.name);
                            $('.category_id-err').text(errors.category_id);
                            $('.custom_category-err').text(errors.custom_category);

                            // xóa các thông báo lỗi
                            if(!errors.name){
                                $('.name-err').text('');
                            }
                            if(!errors.category_id){
                                $('.category_id-err').text('');
                            }
                            if(!errors.custom_category) {
                                $('.custom_category-err').text('');
                            }
                        }
                    }
                });
                return false;
            });
        });
    </script>

     {{--notification  --}}
    <script>
        $(document).ready(function() {
            var currentPage = 1;
            // Biến lưu trữ trạng thái cuộn
            var isFetchingNotifications = false;

            function loadNotifications() {
                $.ajax({
                    url: '/notifications/load', // Đường dẫn tới API hoặc endpoint xử lý yêu cầu
                    type: 'GET',
                    // dataType: 'json',,
                    success: function(response) {
                        console.log(response);
                        // Xử lý dữ liệu thông báo và hiển thị trong giao diện
                        renderNotifications(response);

                        currentPage++;
                    },
                    error: function(xhr, status, error) {
                        // Xử lý lỗi (nếu có)
                        console.error(error);
                    }
                });
            }

            function loadMoreNotifications() {
                $.ajax({
                    url: '/notifications/load-more', // Đường dẫn tới API hoặc endpoint xử lý yêu cầu
                    type: 'GET',
                    // dataType: 'json',
                    data: {
                    page: currentPage // Trang tiếp theo cần tải
                    },
                    beforeSend: function() {
                        // Đánh dấu đang tải dữ liệu
                        isFetchingNotifications = true;
                        // Hiển thị loader hoặc thông báo đang tải
                        $('#notification-loader').show();
                    },
                    success: function(response) {
                        // Xử lý dữ liệu thông báo và hiển thị trong giao diện
                        renderNotifications(response);
                        console.log("load more: ", response)
                        // Tăng số trang tiếp theo
                        currentPage++;

                        // Đánh dấu kết thúc tải dữ liệu
                        isFetchingNotifications = false;
                        // Ẩn loader hoặc thông báo đang tải
                        $('#notification-loader').hide();
                    },
                    error: function(xhr, status, error) {
                        // Xử lý lỗi (nếu có)
                        console.error(error);

                        // Đánh dấu kết thúc tải dữ liệu
                        isFetchingNotifications = false;
                        // Ẩn loader hoặc thông báo đang tải
                        $('#notification-loader').hide();
                    }
                });
            }

            // render khi click
            function renderNotifications(notifications) {
                // Xử lý dữ liệu thông báo và hiển thị trong giao diện
                // Ví dụ: dùng vòng lặp để tạo các phần tử thông báo và thêm vào giao diện
                for (var i = 0; i < notifications.length; i++) {
                    var notification = notifications[i];
                    var createdAtString = notification.created_at; // "2023-07-23T13:57:32.000000Z"
                    var createdAtDate = new Date(createdAtString);
                    var localCreatedAt = createdAtDate.toLocaleString('en-US', { timeZone: 'Asia/Ho_Chi_Minh' });

                    var html = `<div class="notification-item"><span>
                        ${localCreatedAt} :
                    <a style="color: #fa6243" href="/profile/${notification.user_id_nguon}">${notification.sender.name}</a>`;
                    // html += '<span>';
                    if (notification.type === 1 || notification.type === 4) {
                        html += ` đã thích `;
                    } else if (notification.type === 2) {
                        html += `\u00A0đã bình luận về `;
                    } else if (notification.type === 3) {
                        html += ` đã theo dõi `;
                    }

                    if (notification.type === 1 || notification.type === 2) {
                        html += `<a style="color: #fa6243" href="/article/${notification.article_id}"> bài viết của bạn </a>`;
                    } else if (notification.type === 3) {
                        html += ` bạn `;
                    } else if (notification.type === 4) {
                        html += `<a style="color: #fa6243" href="/pet/${notification.pet_id}"> pet của bạn </a>`;
                    }
                    html += '</span>';

                    html += `</div>`;

                   
                    $('#notification-container').append(html);
                }
            }

            // append prepend
            $('.notification-icon').on('click', function() {
                $('#notification-count').text('0');
                // Hiển thị giao diện thông báo
                $('#notification-container').toggle();

                // Kiểm tra nếu giao diện thông báo đã được hiển thị
                if ($('#notification-container').is(':visible')) {
                    // Bấm vào mở thông báo là số thông báo trở về 0 sau 300ms (0.3 giây)
                    setTimeout(function() {
                        $('#notification-count').text('0');
                        // Gọi AJAX để lấy 12 thông báo đầu tiên.
                        loadNotifications();
                        }, 300);
                }else {
                    // $('#notification-container').empty();
                    currentPage = 1;

                    // xóa kết quả load ra trước đó.
                    var notification_container = document.getElementById("notification-container");
                    notification_container.innerHTML = "";
                }
            });

            // Sự kiện cuộn giao diện
            $('#notification-container').scroll(function() {
                // Kiểm tra nếu đang tải dữ liệu hoặc đã cuộn đến cuối
                if (isFetchingNotifications || $(this).scrollTop() + $(this).innerHeight() < $(this)[0].scrollHeight) {
                    return;
                }
                console.log("vào đây chưa má");
                // Gửi yêu cầu AJAX để tải thêm dữ liệu thông báo
                loadMoreNotifications();
            });
        });
    </script>

    {{-- hien modal bai viet chi tiet --}}
    <script>
        $(document).ready(function() {
            console.log("da vao bai viet chi tiet");
            $(".article-list").on('click', '.view-detail-btn', function(e) {
                e.preventDefault();
                console.log("ủa alo");
                var articleId = $(this).data("id");
                console.log("id bai viet: ", articleId);
                // Gửi yêu cầu AJAX để lấy dữ liệu chi tiết bài viết
                $.ajax({
                    url: '/api/article/' + articleId,
                    method: 'GET',
                    success: function(response) {
                        console.log(response);
                        var article = response.article;
                        var comments = response.comments;
                        var avatarUrl = pare_url_file(article?.user?.avatar || "");
                        var videoUrl = pare_url_file(article.video || "");
                        var imageUrl = pare_url_file(article.avatar || "");

                        // var localCreatedAt = new Date(comments.created_at).toLocaleString('en-US', { timeZone: 'Asia/Ho_Chi_Minh' });
                        // Truyền dữ liệu vào modal và hiển thị modal
                        var articleDetailsElement = $('#showArticleDetail');
                        
                        articleDetailsElement.html(`
                            <div class="row" id="page-contents">
                                <div class="offset-lg-1 col-lg-10">
                                <div class="typography">
                                    <div style="width: 120%;left: 50%;transform: translateX(-50%);" class="central-meta">
                                    <span class="create-post">${article.name}
                                        <a style="font-size: 15px" href="#"><span>Có </span><span id="likeCount">${article.total_like}</span> <span>yêu thích</span></a>
                                        <a style="font-size: 15px;color: #212121" href="${response.current_page}"> Quay lại / </a>
                                    </span>
                                    ${article.pet_id !== 0 ? `
                                        <div style="color: #fa6243; margin-bottom: 10px">
                                            <a href="/pet/${article.pet_id}">Đến thăm Pet nào.</a>
                                        </div>
                                    ` : ''}

                                    <div style="margin-bottom: 10px;">
                                        <a data-article-id="${article.id}" class="like-article a_like like_in" style="${response.checkLike ? 'font-weight: bold;background: #fa6342' : 'color:black; border: 1px solid #fa6342'}" href="#">Like</a>
                                        <a class="a_like" style="background: blue" href="https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(window.location.href)}" target="_blank" rel="noopener">
                                        Chia sẻ Facebook
                                        </a>
                                    </div>
                                    ${article.video ? `
                                        <video class="video" id="${article.id}" data-id="${article.id}" width="100%" height="240" controls>
                                        <source src="${videoUrl}" type="video/mp4">
                                        </video>
                                    ` : ''}
                                    ${article.avatar ? `
                                        <a style="margin-bottom: 10px;display: block">
                                        <img src="${imageUrl}" style="width: 100%;height: auto" alt="">
                                        </a>
                                    ` : ''}
                                    ${article.description ? article.description : ''}
                                    ${article.content ? article.content : ''}
                                    </div>
                                </div>
                                <div style="width: 120%;left: 50%;transform: translateX(-50%);" class="central-meta item" style="display: inline-block; width: 70%; margin-left: 12%">
                                    <div class="user-post">
                                    <div class="friend-info">
                                        <div class="coment-area" style="display: block;">
                                        <ul id="div_comment" class="we-comet">
                                            <div id="commentList">
                                            ${comments.map(item => `
                                                <li>
                                                <div class="comet-avatar">
                                                    <img style="width: 35px;height: 35px;border-radius: 50%;" src="${pare_url_file(item?.user?.avatar || "") ?? ''}" alt="">
                                                </div>
                                                <div class="we-comment">
                                                    <h5> <a href="/profile/${item.user_id}" title="">${item.user.name ?? ''}</a></h5>
                                                    <br>
                                                    <p>${new Date(item.created_at).toLocaleString('en-US', { timeZone: 'Asia/Ho_Chi_Minh' })} : ${item.content}</p>
                                                </div>
                                                </li>
                                            `).join('')}
                                            </div>
                                            <li class="post-comment">
                                            <div class="post-box">
                                                <form class="comment-form" data-article-id="${article.id}" method="post">
                                                @csrf
                                                <textarea id="content" name="comment" placeholder="Post your comment"></textarea>
                                                <small id="emailHelp" class="form-text text-danger"></small>
                                                <input type="hidden" name="article" value="${article.id}">
                                                <button id="commentBtn" type="submit">Gửi bình luận</button>
                                                </form>
                                            </div>
                                            </li>
                                        </ul>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                                </div>
                            </div>
                        `);
    
    
                        $("#modal-show-article").modal("show");

                        // Gắn sự kiện lắng nghe khi modal được đóng
                        $('#modal-show-article').on('hidden.bs.modal', function () {
                            articleDetailsElement.empty();
                        });

                    },
                    error: function(xhr, status, error) {
                        console.log("Lỗi :", error);
                    }
                });
            });
    
        });
    </script>

{{-- xu li play video --}}
    <script>
        // $(document).ready(function() {
        //     var currentVideo = null;

        //     $('.video').on('play', function() {
        //         console.log("da play video");
        //         var videoID = $(this).data("id");
        //         console.log("video id: ", videoID);
        //         if (currentVideo && currentVideo !== this) {
        //             currentVideo.pause();
        //         }
        //         currentVideo = this;
        //     });



        // });
        $(document).ready(function() {
            var currentVideo = null;
            var videoID = 0;

            // Áp dụng sự kiện play cho các video có sẵn
            $('.video').on('play', function() {
                console.log("Đã play video");
                videoID = $(this).data("id");
                console.log("Video ID: ", videoID);
                if (currentVideo && currentVideo !== this) {
                    currentVideo.pause();
                }
                currentVideo = this;
            });

            // =======================
            // khi bật modal thì video tắt
            // $(".article-list").on('click', '.view-detail-btn', function(e) {
            //     e.preventDefault();
            //     console.log("bật modal");
            //     $('.video').off('play');
            //     if(currentVideo){
            //         currentVideo.pause();
            //     }
                
            //     // currentVideo = null;
            // });

            
            $('#modal-show-article').on('shown.bs.modal', function () {
                if(currentVideo){
                    currentVideo.pause();
                    currentVideo = null;
                }
            });
            // ==============================

            // Sự kiện scroll kiểm tra xem video có hiển thị trên màn hình hay không
            $(window).on('scroll', function() {
                pauseVideosOutsideViewport();
            });

            // Sử dụng MutationObserver để theo dõi sự thay đổi trong DOM
            var observer = new MutationObserver(function(mutationsList) {
                for (var mutation of mutationsList) {
                    if (mutation.type === 'childList') {
                        console.log("có sự thay đổi trong DOM");
                        applyVideoEvents();
                        pauseVideosOutsideViewport();
                    }
                }
            });

            // Theo dõi thay đổi trong phần tử có class 'article-list'
            if(document.querySelector('.article-list')) {
                observer.observe(document.querySelector('.article-list'), { childList: true, subtree: true });
            }
            // observer.observe(document.querySelector('.add-article'), { childList: true, subtree: true });
            var addArticleElement = document.querySelector('.add-article');
            if (addArticleElement) {
                observer.observe(addArticleElement, { childList: true, subtree: true });
            }

            // Áp dụng lại sự kiện play cho tất cả các video
            function applyVideoEvents() {
                $('.video').off('play');
                $('.video').on('play', function() {
                    console.log("Đã play video");
                    videoID = $(this).data("id");
                    console.log("Video ID: ", videoID);
                    if (currentVideo && currentVideo !== this) {
                        currentVideo.pause();
                    }
                    currentVideo = this;
                });
            }
            

            function pauseVideosOutsideViewport() {
                var video = document.getElementById(videoID);
                if(video){
                    var rect = video.getBoundingClientRect();
                    var isVisible = rect.top >= 0 && rect.bottom <= window.innerHeight;
                
                    if (!isVisible && video === currentVideo) {
                        currentVideo.pause();
                        currentVideo = null;
                    }
                }
                
            }

            // $('#loadMoreBtn').click(function() {
            //     console.log("Đã click load more");
            //     applyVideoEvents();
            //     pauseVideosOutsideViewport();
            // });

        });

    </script>
</body>
</html>
