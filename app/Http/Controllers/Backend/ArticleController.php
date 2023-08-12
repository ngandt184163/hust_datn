<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use App\Models\Pet;
use App\Models\Menu;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductWholesalePrice;
use App\Models\Province;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use App\Http\Requests\ArticleRequest;
use App\Http\Requests\ArticleUpdateRequest;

class ArticleController extends Controller
{
    public function index(Request $request)
    {
        $articles = Article::with('menu:id,name');

        if ($name = $request->n)
            $articles->where('name', 'like', '%' . $name . '%');

        if ($s = $request->status)
            $articles->where('status', $s);

        $articles = $articles
            ->orderByDesc('id')
            ->paginate(20);


        $viewData = [
            'articles'  => $articles,
            'query'  => $request->query()
        ];

        return view('backend.article.index', $viewData);
    }

    public function create()
    {
        $menus = Menu::all();
        $pets = Pet::where('user_id', Auth::user()->id)->get();
        return view('backend.article.create', compact('menus','pets'));
    }

    public function store(ArticleRequest $request)
    {
        try {
            $data = $request->except('_token', 'avatar', 'wholesale');
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

            $article = Article::create($data);


        } catch ( \Exception $exception ) {
            Log::error("ERROR => ArticleController@store => " . $exception->getMessage());
            return redirect()->route('get_admin.article.create');
        }
        return redirect()->route('get_admin.article.index');
    }

    public function edit($id)
    {
        $article = Article::findOrFail($id);
        $menus = Menu::all();
        $pets = Pet::where('user_id', Auth::user()->id)->get();

        $viewData = [
            'article' => $article,
            'menus'   => $menus,
            'pets'    => $pets 
        ];

        return view('backend.article.update', $viewData);
    }

    public function update(ArticleUpdateRequest $request, $id)
    {
        try {
            $data = $request->except('_token', 'avatar', 'wholesale');
            $data['slug'] = Str::slug($request->name);
            $data['updated_at'] = Carbon::now();

            if ($request->avatar) {
                $file = upload_image('avatar');
                if (isset($file['code']) && $file['code'] == 1) $data['avatar'] = $file['name'];
            }

            // if ($request->video) {
            //     // dd("có vào đây k");
            //     $file = upload_file('video', '', ['mp4']);
            //     // dd($file);
            //     if (isset($file['code']) && $file['code'] == 1) {
            //         $data['video'] = $file['name'];
            //         $data['is_video'] = 1;
            //     }
            // }

            //kiểm tra xem bài đăng có thuộc về pet nào hay không
            if (empty($request->pet_id)) {
                $data['pet_id'] = 0;
            }

            Article::find($id)->update($data);

        } catch ( \Exception $exception ) {
            Log::error("ERROR => ArticleController@store => " . $exception->getMessage());
            toastr()->error('Xử lý thất bại', 'Thông báo');
            return redirect()->route('get_admin.article.update', $id);
        }

        toastr()->success('Xử lý thành công', 'Thông báo');
        return redirect()->route('get_admin.article.index');
    }

    public function delete(Request $request, $id)
    {
        try {
            $article = Article::findOrFail($id);
            if ($article) $article->delete();

        } catch ( \Exception $exception ) {
            Log::error("ERROR => ArticleController@delete => " . $exception->getMessage());
        }
        return redirect()->route('get_admin.article.index');
    }
}
