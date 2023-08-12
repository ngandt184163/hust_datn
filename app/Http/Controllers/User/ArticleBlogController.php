<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Menu;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use App\Http\Requests\ArticleBlogRequest;

class ArticleBlogController extends Controller
{
    public function index(Request $request)
    {
        $articles = Article::with('menu:id,name')
            ->where([
                'user_id' => Auth::user()->id,
                'type' => 2
            ])
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
            'articles'  => $articles,
            'query'  => $request->query()
        ];

        return view('frontend.article_blog.index', $viewData);
    }

    public function create()
    {
        $menus = Menu::all();
        return view('frontend.article_blog.create', compact('menus'));
    }

    public function store(ArticleBlogRequest $request)
    {
        // dd("alo");
        try {
            
            $data = $request->except('_token', 'avatar', 'video');
            $data['slug'] = Str::slug($request->name);
            $data['created_at'] = Carbon::now();
            $data['type'] = 2;

            if ($request->avatar) {
                $file = upload_image('avatar');
                if (isset($file['code']) && $file['code'] == 1) $data['avatar'] = $file['name'];
            }



            if ($request->video) {
                // $file = upload_image('video',['mp4']);
                $file = upload_file('video', '', ['mp4']);
                if (isset($file['code']) && $file['code'] == 1) {
                    $data['video'] = $file['name'];
                    $data['is_video'] = 1;
                }
            }

            $data['user_id'] = Auth::user()->id;

            $article = Article::create($data);


        } catch ( \Exception $exception ) {
            Log::error("ERROR => ArticleController@store => " . $exception->getMessage());
            // return redirect()->route('get_user.article.create');
            return redirect()->route('get_user.article_blog.index');
        }
        return redirect()->route('get_user.article_blog.index');
    }

    public function edit($id)
    {
        $article = Article::findOrFail($id);
        $menus = Menu::all();

        $viewData = [
            'article' => $article,
            'menus'   => $menus
        ];

        return view('frontend.article_blog.update', $viewData);
    }

    public function update(ArticleBlogRequest $request, $id)
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
                $file = upload_file('video','', ['mp4']);
                if (isset($file['code']) && $file['code'] == 1) {
                    $data['video'] = $file['name'];
                    $data['is_video'] = 1;
                }
            }

            Article::find($id)->update($data);
            session(['hasReloaded' => true]);

        } catch ( \Exception $exception ) {
            Log::error("ERROR => ArticleController@store => " . $exception->getMessage());
            toastr()->error('Xử lý thất bại', 'Thông báo');
            return redirect()->route('get_user.article_blog.update', $id);
        }

        toastr()->success('Xử lý thành công', 'Thông báo');
        return redirect()->route('get_user.article_blog.index');
    }

    public function delete(Request $request, $id)
    {
        try {
            $article = Article::findOrFail($id);
            if ($article) $article->delete();

        } catch ( \Exception $exception ) {
            Log::error("ERROR => ArticleController@delete => " . $exception->getMessage());
        }
        return redirect()->route('get_user.article_blog.index');
    }
}
