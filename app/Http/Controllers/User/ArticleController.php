<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Menu;
use App\Models\Pet;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use App\Http\Requests\ArticleRequest;
use App\Http\Requests\ArticleUpdateRequest;
use App\Models\Comment;
use Illuminate\Support\Facades\Session;
use App\Models\ArticleAction;

class ArticleController extends Controller
{
    public function index(Request $request)
    {
        $articles = Article::with('menu:id,name')
            ->where('user_id', Auth::user()->id)
            ->where('type', 1)
            ->orderByDesc('id')
            ->take(10)
            ->get();

        if ($name = $request->n)
            $articles->where('name', 'like', '%' . $name . '%');

        if ($s = $request->status)
            $articles->where('status', $s);

        // $articles = $articles
        //     ->orderByDesc('id')
        //     ->paginate(20);


        $viewData = [
            'articles' => $articles,
            'query'    => $request->query()
        ];

        return view('frontend.article.index', $viewData);
    }

    public function create()
    {
        $menus = Menu::all();
        $pets = Pet::where('user_id', Auth::user()->id)->get();

        return view('frontend.article.create', compact('menus','pets'));
    }

    public function store(ArticleRequest $request)
    {
        // dd($request);
        try {
            $data = $request->except('_token', 'avatar', 'video');
            $data['slug'] = Str::slug($request->name);
            $data['created_at'] = Carbon::now();

            if ($request->avatar) {
                $file = upload_image('avatar');
                if (isset($file['code']) && $file['code'] == 1) $data['avatar'] = $file['name'];
            }


            if ($request->video) {
                // dd("có vào đây k");
                $file = upload_file('video', '', ['mp4']);
                // dd($file);
                if (isset($file['code']) && $file['code'] == 1) {
                    $data['video'] = $file['name'];
                    $data['is_video'] = 1;
                }
            }

            $data['user_id'] = Auth::user()->id;

            //kiểm tra xem bài đăng có thuộc về pet nào hay không
            if (empty($request->pet_id)) {
                $data['pet_id'] = 0;
            }

            // dd($data);
            $article = Article::create($data);
        } catch ( \Exception $exception ) {
            Log::error("ERROR => ArticleController@store => " . $exception->getMessage());
            return redirect()->route('get_user.article.create');
        }
        return redirect()->route('get_user.article.index');
    }

    public function edit($id)
    {
        $article = Article::findOrFail($id);
        $oldAvatar = $article->avatar;
        $oldVideo = $article->video;
        $menus = Menu::all();
        $pets = Pet::where('user_id', Auth::user()->id)->get();

        $viewData = [
            'article' => $article,
            'menus'   => $menus,
            'pets'    => $pets,
            'oldAvatar' => $oldAvatar,
            'oldVideo' => $oldVideo
        ];

        return view('frontend.article.update', $viewData);
    }

    public function update(ArticleUpdateRequest $request, $id)
    {
        try {
            $data = $request->except('_token', 'avatar', 'video');
            $data['slug'] = Str::slug($request->name);
            $data['updated_at'] = Carbon::now();

            if ($request->avatar) {
                $file = upload_image('avatar');
                if (isset($file['code']) && $file['code'] == 1) $data['avatar'] = $file['name'];
            }

            if ($request->video) {
                $file = upload_file('video', '', ['mp4']);
                if (isset($file['code']) && $file['code'] == 1) {
                    $data['video'] = $file['name'];
                    $data['is_video'] = 1;
                }
            }

            //kiểm tra xem bài đăng có thuộc về pet nào hay không
            if (empty($request->pet_id)) {
                $data['pet_id'] = 0;
            }
            
            Article::find($id)->update($data);
            session(['hasReloaded' => true]);

        } catch ( \Exception $exception ) {
            Log::error("ERROR => ArticleController@store => " . $exception->getMessage());
            toastr()->error('Xử lý thất bại', 'Thông báo');
            return redirect()->route('get_user.article.update', $id);
        }

        toastr()->success('Xử lý thành công', 'Thông báo');
        return redirect()->route('get_user.article.index');
    }

    public function delete(Request $request, $id)
    {
        try {
            $article = Article::findOrFail($id);
            if ($article) $article->delete();

        } catch ( \Exception $exception ) {
            Log::error("ERROR => ArticleController@delete => " . $exception->getMessage());
        }
        return redirect()->route('get_user.article.index');
    }

    public function showDetailUseAjax($id) 
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

        $viewData = [
            'article'      => $article,
            'checkLike'    => $checkLike ?? null,
            'comments'     => $comments,
            'current_page' => $current_page
        ];


        return response()->json($viewData);
        // ['success' => true,
        // 'article' => $article,
        // 'checkLike' => $checkLike ?? null,
        // '$comments' => $comments,
        // '$current_page' => $current_page]
    }
}
