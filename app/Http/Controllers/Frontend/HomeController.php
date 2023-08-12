<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\ArticleAction;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Pet;
use App\Models\Notification;
use App\Models\PetAction;
use App\Models\Product;
use App\Models\Slide;
use App\Models\Story;
use App\Models\StoryAction;
use App\Models\User;
use App\Models\UserFollow;
use App\Http\Requests\CommentsdRequest;
use App\Events\UserHasNotificationEvent;
use App\Events\UserUnNotificationEvent;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $userId = Auth::user()->id ?? 0;
        // $current_page = Session::get('previous_page', '/home');
        $subPath = $request->segment(1); // lấy segment đầu tiên của URL trong yêu cầu HTTP 
        session(['previous_page' => $subPath]); // lưu vào session 
        if($subPath === 'kham-pha'){
            session(['previous_page' => '/kham-pha']);
        }else {
            session(['previous_page' => '/']);
        }

        $oneWeekAgo = Carbon::now()->subWeek(); // Tạo thời điểm 1 tuần trước
        $articles_hot = DB::table('articles')
            ->orderByDesc('total_like')
            ->where('created_at', '>=', $oneWeekAgo)
            ->where('type', 1)
            ->limit(10)
            ->get();


        $pets = Pet::with('category:id,name', 'user:id,name')
            ->orderByDesc('total_like')
            ->limit(10)
            ->get();

        if($userId !== 0 && $subPath === 'kham-pha'){
            $articles = Article::with('user:id,name,avatar')
            ->where('type', 1)
            ->orderByDesc('id')
            ->take(10)
            ->get();
        } 
        if($userId !== 0 && $subPath !== 'kham-pha') {
            $articles = Article::with('user:id,name,avatar')
            ->where('type', 1) //->where('is_video', -1)
            ->where(function ($query) use ($userId) {
                $query->where('user_id', $userId)
                    ->orWhereIn('user_id', function ($subquery) use ($userId) {
                        $subquery->select('user_follow_id')
                            ->from('user_follows')
                            ->where('user_id', $userId);
                    });
            })
            ->orderByDesc('id')
            ->take(10)
            ->get();
        }
        

        if($userId === 0){
            $articles = Article::with('user:id,name,avatar')
            ->where('type', 1)
            ->orderByDesc('id')
            ->take(3)
            ->get();
        }


        if ($userId) {
            $user = User::find($userId);

            $userFollow = UserFollow::with('userFollow:id,name,avatar')->where([
                'user_follow_id' => $userId
            ])->get();
        }

        // Lấy số lượng thông báo mới từ cơ sở dữ liệu
        $newNotificationsCount = Notification::where('user_id_dich', $userId)->where('status', 0)->count();

        Session::put('newNotificationsCount', $newNotificationsCount);

        $viewData = [
            'pets'       => $pets,
            'articles'   => $articles,
            'articles_hot' => $articles_hot,
            'subPath'   => $subPath,
            'user'       => $user ?? null,
            'userFollow' => $userFollow ?? null,
            // 'newNotificationsCount' => $newNotificationsCount
        ];

        return view('frontend.home.index', $viewData);
    }

    public function map(Request $request)
    {
        return view('frontend.home.map_index');
    }

    public function blog(Request $request)
    {
        session(['previous_page' => '/blog']);
        // $articles = Article::with('user:id,name,avatar')
        //     ->where('type', 2)
        //     ->orderByDesc('id')
        //     ->take(5)
        //     ->get();

        // if ($request->k)
        //     $articles->where('name', 'like', '%' . $request->k . '%');

        if ($request->has('k')) {
            $articles = Article::with('user:id,name,avatar')
                ->where('type', 2)
                ->where('name', 'like', '%' . $request->k . '%') // tìm kiếm trong cột name, 
                ->orderByDesc('id')
                ->take(10)
                ->get();
        } else {
            $articles = Article::with('user:id,name,avatar')
                ->where('type', 2)
                ->orderByDesc('id')
                ->take(10)
                ->get();
        }
        

        $viewData = [
            'articles' => $articles
        ];

        return view('frontend.blog.index', $viewData);
    }

    public function blogCSKN(Request $request) {
        session(['previous_page' => '/blog']);

        if ($request->has('k')) {
            $articles = Article::with('user:id,name,avatar')
                ->where('type', 2)
                ->where('menu_id', 1)
                ->where('name', 'like', '%' . $request->k . '%')
                ->orderByDesc('id')
                ->take(10)
                ->get();
        } else {
            $articles = Article::with('user:id,name,avatar')
                ->where('type', 2)
                ->where('menu_id', 1)
                ->orderByDesc('id')
                ->take(10)
                ->get();
        }
        

        $viewData = [
            'articles' => $articles
        ];

        return view('frontend.blog.index', $viewData);
    }


    public function blogHD(Request $request) {
        session(['previous_page' => '/blog']);

        if ($request->has('k')) {
            $articles = Article::with('user:id,name,avatar')
                ->where('type', 2)
                ->where('menu_id', 2)
                ->where('name', 'like', '%' . $request->k . '%')
                ->orderByDesc('id')
                ->take(10)
                ->get();
        } else {
            $articles = Article::with('user:id,name,avatar')
                ->where('type', 2)
                ->where('menu_id', 2)
                ->orderByDesc('id')
                ->take(10)
                ->get();
        }
        

        $viewData = [
            'articles' => $articles
        ];

        return view('frontend.blog.index', $viewData);
    }

    public function blogCN(Request $request) {
        session(['previous_page' => '/blog']);

        if ($request->has('k')) {
            $articles = Article::with('user:id,name,avatar')
                ->where('type', 2)
                ->where('menu_id', 3)
                ->where('name', 'like', '%' . $request->k . '%')
                ->orderByDesc('id')
                ->take(10)
                ->get();
        } else {
            $articles = Article::with('user:id,name,avatar')
                ->where('type', 2)
                ->where('menu_id', 3)
                ->orderByDesc('id')
                ->take(10)
                ->get();
        }
        

        $viewData = [
            'articles' => $articles
        ];

        return view('frontend.blog.index', $viewData);
    }


    public function blogDetail($id)
    {
        $current_page = Session::get('previous_page', '/');
        $articleDetail = Article::with('user:id,name,avatar')->find($id);
        $comments = Comment::with('user:id,name,avatar')
        ->where('article_id', $id)
        ->get();

        $userId = Auth::user()->id ?? 0;
        if ($userId) {
            $checkLike = ArticleAction::where([
                'user_id'    => $userId,
                'article_id' => $id,
                'is_like'    => 1
            ])->first();

        } else{
            $checkLike = '';
        }

        $viewData = [
            'articleDetail' => $articleDetail,
            'comments' => $comments,
            'checkLike' => $checkLike,
            'current_page' => $current_page
        ];

        return view('frontend.blog.detail', $viewData);
    }

    public function search(Request $request)
    {
        $k = $request->k;

        $users = User::where('name', 'like', '%' . $k . '%')->get();
        $pets = Pet::where('name', 'like', '%' . $k . '%')->get();

        $viewData = [
            'users' => $users,
            'pets'  => $pets
        ];

        return view('frontend.home.search', $viewData);

    }

    public function showStoryDetail($id)
    {
        $story = Story::find($id);
        $userId = Auth::user()->id ?? 0;
        if (!$userId) return redirect()->route('get.login');

        $checkLike = StoryAction::where([
            'user_id'  => $userId,
            'story_id' => $id,
            'is_like'  => 1
        ])->first();

        $checkDislike = StoryAction::where([
            'user_id'  => $userId,
            'story_id' => $id,
            'is_like'  => -1
        ])->first();

        $viewData = [
            'story'        => $story,
            'checkDislike' => $checkDislike,
            'checkLike'    => $checkLike
        ];

        return view('frontend.home.story_detail', $viewData);
    }

    public function likeStory($id)
    {
        $userId = Auth::user()->id ?? 0;
        if (!$userId) return redirect()->route('get.login');

        $check = StoryAction::where([
            'user_id'  => $userId,
            'story_id' => $id,
            'is_like'  => 1
        ])->first();

        if ($check) return redirect()->back();

        StoryAction::create([
            'user_id'    => $userId,
            'story_id'   => $id,
            'is_like'    => 1,
            'created_at' => Carbon::now()
        ]);

        DB::table('stories')->where('id', $id)->increment('total_like');
        return redirect()->back();
    }

    public function dislikeStory($id)
    {
        $userId = Auth::user()->id ?? 0;
        if (!$userId) return redirect()->route('get.login');


        $check = StoryAction::where([
            'user_id'  => $userId,
            'story_id' => $id,
            'is_like'  => -1
        ])->first();

        if ($check) return redirect()->back();

        StoryAction::create([
            'user_id'    => $userId,
            'story_id'   => $id,
            'is_like'    => -1,
            'created_at' => Carbon::now()
        ]);

        DB::table('stories')->where('id', $id)->increment('total_dislike');
        return redirect()->back();
    }

    public function video()
    {
        $current_page = Session::get('previous_page', '/');
        $articles = Article::where('is_video',1)
            ->orderByDesc('id')
            ->paginate(20);

        $viewData = [
            'articles'     => $articles,
            'current_page' => $current_page
        ];

        return view('frontend.video.index', $viewData);

    }

    public function video_2(Request $request)
    {
        $userId = Auth::user()->id ?? 0;
        session(['previous_page' => '/video']);

        $oneWeekAgo = Carbon::now()->subWeek(); // Tạo thời điểm 1 tuần trước
        $articles_hot = DB::table('articles')
            ->orderByDesc('total_like')
            ->where('created_at', '>=', $oneWeekAgo)
            ->limit(10)
            ->get();

        $pets = Pet::with('category:id,name', 'user:id,name')
            ->orderByDesc('total_like')
            ->limit(10)
            ->get();

        if($userId === 0) {
            $articles = Article::where('is_video',1)
            ->orderByDesc('id')
            ->take(3)
            ->get();
        }else{
            $articles = Article::where('is_video',1)->where('type',1)
            ->orderByDesc('id')
            ->take(10)
            ->get();
        }

        $subPath = $request->segment(1);

        // $userId = Auth::user()->id ?? 0;

        if ($userId) {
            $user = User::find($userId);

            $userFollow = UserFollow::with('userFollow:id,name,avatar')->where([
                'user_follow_id' => $userId
            ])->get();
        }

        $viewData = [
            'pets'       => $pets,
            'articles'   => $articles,
            'articles_hot' => $articles_hot,
            // 'articlesNotAuth' => $articlesNotAuth,
            'subPath'   => $subPath,
            'user'       => $user ?? null,
            'userFollow' => $userFollow ?? null
        ];

        return view('frontend.home.index', $viewData);

    }

    public function showPetDetail($id)
    {
        $pet = Pet::with('category:id,name', 'user:id,name')
            ->where('id', $id)->first();

        $userId = Auth::user()->id ?? 0;
        if ($userId) {
            $checkLike = PetAction::where([
                'user_id' => $userId,
                'pet_id'  => $id,
                'is_like' => 1
            ])->first();

            $checkDislike = PetAction::where([
                'user_id' => $userId,
                'pet_id'  => $id,
                'is_like' => -1
            ])->first();
        }

        $articles = Article::where('pet_id', $id)
            ->orderByDesc('id')
            ->take(10)
            ->get();


        $viewData = [
            'checkDislike' => $checkDislike ?? null,
            'checkLike'    => $checkLike ?? null,
            'pet'          => $pet,
            'articles'     => $articles
        ];

        return view('frontend.home.pet_detail', $viewData);
    }

    public function likePet($id)
    {
        $check_noti = 0;
        $userId = Auth::user()->id ?? 0;
        if (!$userId) return redirect()->route('get.login');

        $check = PetAction::where([
            'user_id' => $userId,
            'pet_id'  => $id,
            // 'is_like' => 1
        ])->first();

        // if ($check) return redirect()->back();

        if($check) {
            if($check->is_like === 1) {
                DB::table('pets')->where('id', $id)->decrement('total_like', 1);
                DB::table('pets_action')->where('user_id', $userId)->where('pet_id', $id)->update(['is_like' => -1]);
                $isLiked = false;

                // xoa thông báo
                $notification = Notification::where('user_id_nguon', $userId)
                    ->where('pet_id', $id)
                    ->first();

                if($notification){
                    if($notification->status == 0){
                        $pet_tmp = Pet::findOrFail($id);
                        $user = $pet_tmp->user;
                        event(new UserUnNotificationEvent($user->id));
                    }
                    $notification->delete();
                }
            }else {
                DB::table('pets')->where('id', $id)->increment('total_like', 1);
                DB::table('pets_action')->where('user_id', $userId)->where('pet_id', $id)->update(['is_like' => 1]);
                $isLiked = true;

                 // lưu thông báo vào bảng.
                $pet_tmp = Pet::findOrFail($id);
                $user = $pet_tmp->user;
                if($userId !== $user->id) {
                    Notification::create([
                        'user_id_nguon'    => $userId,
                        'pet_id' => $id,
                        'user_id_dich'    => $user->id,
                        'type' => 4,
                        'status' => 0,
                        'created_at' => Carbon::now()
                    ]);
                    $check_noti=1;
                }
            }
        } else{
            // lưu thông báo vào bảng.
            $pet_tmp = Pet::findOrFail($id);
            $user = $pet_tmp->user;
            if($userId !== $user->id) {
                Notification::create([
                    'user_id_nguon'    => $userId,
                    'pet_id' => $id,
                    'user_id_dich'    => $user->id,
                    'type' => 4,
                    'status' => 0,
                    'created_at' => Carbon::now()
                ]);
                $check_noti=1;
            }

            PetAction::create([
                'user_id'    => $userId,
                'pet_id'     => $id,
                'is_like'    => 1,
                'created_at' => Carbon::now()
            ]);
    
            DB::table('pets')->where('id', $id)->increment('total_like');
            $isLiked = true;
            
        }

        if($check_noti ===1){
            event(new UserHasNotificationEvent($user->id));
        }

        // lay so luot like hien co cua bai viet
        $pet = DB::table('pets')->find($id);
        // return redirect()->back();
        return response()->json(['success' => true,
                                'message' => 'like successful',
                                'total_like' => $pet->total_like,
                                'isLiked' => $isLiked]);
    }

    public function dislikePet($id)
    {
        $userId = Auth::user()->id ?? 0;
        if (!$userId) return redirect()->route('get.login');


        $check = PetAction::where([
            'user_id' => $userId,
            'pet_id'  => $id,
            'is_like' => -1
        ])->first();

        if ($check) return redirect()->back();

        PetAction::create([
            'user_id'    => $userId,
            'pet_id'     => $id,
            'is_like'    => -1,
            'created_at' => Carbon::now()
        ]);

        DB::table('pets')->where('id', $id)->increment('total_dislike');
        return redirect()->back();
    }

    public function showArticleDetail($id)
    {
        $current_page = Session::get('previous_page', '/');
        $article = Article::find($id);
        $comments = Comment::with('user:id,name,avatar')
            ->where('article_id', $id)
            ->get();

        $userId = Auth::user()->id ?? 0;
        if ($userId) {
            $checkLike = ArticleAction::where([
                'user_id'    => $userId,
                'article_id' => $id,
                'is_like'    => 1
            ])->first();

        }

        // $subPath = $subPath;
        $viewData = [
            'article'      => $article,
            'checkLike'    => $checkLike ?? null,
            'checkDislike' => $checkDislike ?? null,
            'comments'     => $comments,
            'current_page' => $current_page
            // 'subPath'      => $subPath
        ];


        return view('frontend.home.article_detail', $viewData);
    }

    public function commentArticle(CommentsdRequest $request, $id)
    {
        // Kiểm tra dữ liệu từ request bằng CommentsRequest
        $validatedData = $request->validated();
        $userId = Auth::user()->id ?? 0;
        if (!$userId) return redirect()->route('get.login');

        $comment = $request->comment;

        $data = [
            'article_id' => $id,
            'content'    => $comment,
            'user_id'    => $userId,
            'created_at' => Carbon::now()
        ];

        // Comment::create($data);
        $comment = Comment::create($data);
        $commentId = $comment->id;

        // sau khi comment thành công thì lưu thông báo
        $article_tmp = Article::findOrFail($id);
        $user = $article_tmp->user;
        if($userId !== $user->id) {
            Notification::create([
                'user_id_nguon'    => $userId,
                'article_id' => $id,
                'user_id_dich'    => $user->id,
                'type' => 2,
                'status' => 0,
                'created_at' => Carbon::now()
            ]);

            event(new UserHasNotificationEvent($user->id));
        }

        DB::table('articles')->where('id', $id)->increment('total_comment', 1);
        // lấy ra comment mới đăng
        $comments = Comment::with('user:id,name,avatar')
            ->where('id', $commentId)
            ->first();

        // return redirect()->back();
        return response()->json(['success' => true, 'comments' => $comments]);

    }

    public function likeArticle(Request $request, $id)
    {
        $check_noti = 0;
        $userId = Auth::user()->id ?? 0;
        if (!$userId) return redirect()->route('get.login');

        $articleId = $request->articleId;

        // kiem tra xem nguoi dung da tung like bai viet nay hay chua.
        $check = ArticleAction::where([
            'user_id'    => $userId,
            'article_id' => $id,
            // 'is_like'    => 1
        ])->first();

        // if ($check) return redirect()->back();
        if($check) {
            if($check->is_like === 1) {
                DB::table('articles')->where('id', $id)->decrement('total_like', 1);
                DB::table('article_action')->where('user_id', $userId)->where('article_id', $id)->update(['is_like' => -1]);
                $isLiked = false;
                
                //xóa khỏi thông báo.
                $notification = Notification::where('user_id_nguon', $userId)
                    ->where('article_id', $id)
                    ->where('type', 1)
                    ->first();
                // trước khi xóa khỏi thông báo, kiểm tra xem thông báo đã được đọc chưa
                // nếu chưa thì gọi pusher để giảm số lượng thông báo ngoài màn hình 
                
                    if($notification){
                        if($notification->status == 0){
                            $article_tmp = Article::findOrFail($id);
                            $user = $article_tmp->user;
                            event(new UserUnNotificationEvent($user->id));
                        }
                        $notification->delete();
                    }
                
            }else {
                DB::table('articles')->where('id', $id)->increment('total_like', 1);
                DB::table('article_action')->where('user_id', $userId)->where('article_id', $id)->update(['is_like' => 1]);
                $isLiked = true;
                // lưu thông báo vào bảng.
                $article_tmp = Article::findOrFail($id);
                $user = $article_tmp->user;
                if($userId !== $user->id) { // nếu người tương tác khác với mình thì mới lưu thông báo.
                    Notification::create([
                        'user_id_nguon'    => $userId,
                        'article_id' => $id,
                        'user_id_dich'    => $user->id,
                        'type' => 1,
                        'status' => 0,
                        'created_at' => Carbon::now()
                    ]);
                    $check_noti = 1;
                }
                
            }
            
        }else {
            // lưu thông báo vào bảng.
            $article_tmp = Article::findOrFail($id);
            $user = $article_tmp->user;
            if($userId !== $user->id) {
                Notification::create([
                    'user_id_nguon'    => $userId,
                    'article_id' => $id,
                    'user_id_dich'    => $user->id,
                    'type' => 1,
                    'status' => 0,
                    'created_at' => Carbon::now()
                ]);
                $check_noti = 1;
            }

            ArticleAction::create([
                'user_id'    => $userId,
                'article_id' => $id,
                'is_like'    => 1,
                'created_at' => Carbon::now()
            ]);
    
            DB::table('articles')->where('id', $id)->increment('total_like');
            $isLiked = true;
        }

        if($check_noti === 1) {
    
            event(new UserHasNotificationEvent($user->id));
            
        }

        // lay so luot like hien co cua bai viet
        $article = DB::table('articles')->find($id);


        // return response()->json($article->total_like);
        return response()->json(['success' => true,
                                'message' => 'like successful',
                                'total_like' => $article->total_like,
                                'isLiked' => $isLiked]);
    }

    public function dislikeArticle($id)
    {
        $userId = Auth::user()->id ?? 0;
        if (!$userId) return redirect()->route('get.login');


        $check = ArticleAction::where([
            'user_id'    => $userId,
            'article_id' => $id,
            'is_like'    => -1
        ])->first();

        if ($check) return redirect()->back();

        ArticleAction::create([
            'user_id'    => $userId,
            'article_id' => $id,
            'is_like'    => -1,
            'created_at' => Carbon::now()
        ]);

        DB::table('articles')->where('id', $id)->increment('total_dislike');
        return redirect()->back();
    }

    public function profile(Request $request, $id)
    {
        $userId = Auth::user()->id ?? 0;
        if ($userId) {
            $check = UserFollow::where([
                'user_id'        => $userId,
                'user_follow_id' => $id
            ])->first();
        }

        $pets = Pet::where('user_id', $id)
                    ->orderBy('id', 'desc')
                    ->take(10)
                    ->get();

        $articles = Article::where('user_id', $id)
                        ->orderBy('id', 'desc')
                        ->take(10)
                        ->get();

        $checkLike = UserFollow::where([
            'user_id'        => $userId,
            'user_follow_id' => $id
        ])->first();               

        $user = User::find($id);
        
        $viewData = [
            'user'  => $user,
            'check' => $check ?? null,
            'pets'   => $pets, 
            'articles' => $articles,
            'checkLike' => $checkLike
        ];
        return view('frontend.home.profile', $viewData);
    }
    
    // hàm load thêm dữ liệu bài viết

    public function loadMoreArticles(Request $request)
    {
        $userId = Auth::user()->id ?? 0;
        // $current_page = Session::get('previous_page', '/'); // lấy giá trị trang con
        $pathComponents = $request->input('pathComponents');

        $skip = $request->page * $request->perPage;
        $take = $request->perPage;
 

        // xử lí xem load thêm bài viết ở trang nào, chỉ truy vấn dữ liệu khi người dùng đã đăng nhập


        if($userId !== 0) {
            if(empty($pathComponents)){
                // load bài viết cho trang chủ.
                $articles = Article::with('user:id,name,avatar')
                ->where('type', 1)
                // ->where('is_video', -1)
                ->where(function ($query) use ($userId) {
                    $query->where('user_id', $userId)
                        ->orWhereIn('user_id', function ($subquery) use ($userId) {
                            $subquery->select('user_follow_id')
                                ->from('user_follows')
                                ->where('user_id', $userId);
                        });
                })
                ->orderByDesc('id')
                ->skip($skip) // Tính chỉ mục bắt đầu lấy (số trang * số bài viết mỗi trang)
                ->take($take) // Số bài viết lấy cho mỗi trang
                ->get();
            }
            else if($pathComponents[0] === 'video'){
                $articles = Article::with('user:id,name,avatar')
                ->where('is_video',1)
                ->where('type',1)
                ->orderByDesc('id')
                ->skip($skip) // Tính chỉ mục bắt đầu lấy (số trang * số bài viết mỗi trang)
                ->take($take) // Số bài viết lấy cho mỗi trang
                ->get();
            } else if($pathComponents[0] === 'kham-pha') {
                $articles = Article::with('user:id,name,avatar')
                    ->where('type', 1)
                    ->orderByDesc('id')
                    ->skip($skip) // Tính chỉ mục bắt đầu lấy (số trang * số bài viết mỗi trang)
                    ->take($take) // Số bài viết lấy cho mỗi trang
                    ->get();
            } else if($pathComponents[0] === 'profile'){
                $profileId = $pathComponents[1];
                $articles = Article::where('user_id', $profileId)
                        // ->where('type', 1)
                        ->orderBy('id', 'desc')
                        ->skip($skip)
                        ->take($take)
                        ->get(); 
            } else if($pathComponents[0] === 'account' && $pathComponents[1] === 'article'){
                $articles = Article::with('menu:id,name')
                ->where('user_id', Auth::user()->id)
                ->where('type', 1)
                ->orderBy('id', 'desc')
                ->skip($skip)
                ->take($take)
                ->get(); 
            } else if($pathComponents[0] === 'account' && $pathComponents[1] === 'article-blog'){
                $articles = Article::with('menu:id,name')
                ->where([
                    'user_id' => Auth::user()->id,
                    'type' => 2
                ])
                ->orderBy('id', 'desc')
                ->skip($skip)
                ->take($take)
                ->get();
            } else if($pathComponents[0] === 'pet'){
                $articles = Article::with('user:id,name')
                ->where('pet_id', $pathComponents[1])
                ->orderByDesc('id')
                ->skip($skip)
                ->take($take)
                ->get();
            } else if($pathComponents[0] === 'blog' && count($pathComponents) === 1){
                $articles = Article::with('user:id,name,avatar')
                ->where('type', 2)
                ->orderByDesc('id')
                ->skip($skip)
                ->take($take)
                ->get();
            }
            else if($pathComponents[0] === 'blog' && $pathComponents[1] === 'chia-se-kinh-nghiem'){
                $articles = Article::with('user:id,name,avatar')
                ->where('type', 2)
                ->where('menu_id', 1)
                ->orderByDesc('id')
                ->skip($skip)
                ->take($take)
                ->get();
            } else if($pathComponents[0] === 'blog' && $pathComponents[1] === 'hoi-dap'){
                $articles = Article::with('user:id,name,avatar')
                ->where('type', 2)
                ->where('menu_id', 2)
                ->orderByDesc('id')
                ->skip($skip)
                ->take($take)
                ->get();
            }else if($pathComponents[0] === 'blog' && $pathComponents[1] === 'cho-nhan'){
                $articles = Article::with('user:id,name,avatar')
                ->where('type', 2)
                ->where('menu_id', 3)
                ->orderByDesc('id')
                ->skip($skip)
                ->take($take)
                ->get();
            }
        }

        return response()->json($articles);
    }

}

