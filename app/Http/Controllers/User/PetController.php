<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Pet;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\PetRequest;

class PetController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $pets = Pet::with('category:id,name', 'user:id,name')
            ->where('user_id', $user->id)
            ->orderByDesc('id')
            ->get();

        if ($name = $request->n)
            $pets->where('name', 'like', '%' . $name . '%');

        if ($s = $request->status)
            $pets->where('status', $s);

        // $pets = $pets
        //     ->orderByDesc('id')
        //     ->paginate(20);

        $categories = Category::all();
        $viewData = [
            'pets'  => $pets,
            'query' => $request->query(),
            'user' => $user,
            'categories' => $categories
        ];

        return view('frontend.pet.index', $viewData);
    }

    public function create()
    {
        $categories = Category::all();
        return view('frontend.pet.create', compact('categories'));
    }

    public function store(PetRequest $request)
    {
        try {
            $data               = $request->except('_token', 'avatar');
            $data['slug']       = Str::slug($request->name);
            $data['created_at'] = Carbon::now();

            if ($request->avatar) {
                $file = upload_image('avatar');
                if (isset($file['code']) && $file['code'] == 1) $data['avatar'] = $file['name'];
            }

            $data['user_id'] = Auth::user()->id;

            // kiểm tra input danh mục
            if (!empty($request->category_id)) {
                // Trường 'category_id' có dữ liệu được gửi lên
                // Thực hiện xử lý tương ứng ở đây
                // dd('có vào đây không');
            } else {
                if(!empty($request->custom_category)){
                    // thêm dữ liệu vào bảng category
                    $categoryId = DB::table('categories')->insertGetId([
                        'name' => $request->input('custom_category'),
                        'description' => $request->input('custom_category'),
                        'slug' => Str::slug($request->name),
                        'created_at' => Carbon::now(),
                        // Gán các giá trị cho các trường khác (nếu có)
                    ]);
                    $data['category_id'] = $categoryId;
                }
            }
            // dd($errors);
            $pet = Pet::create($data);

        } catch (\Exception $exception) {
            Log::error("ERROR => PetController@store => " . $exception->getMessage());
            return redirect()->route('get_user.pet.create');
        }
        return redirect()->route('get_user.pet.index');
    }

    public function storeAjax(PetRequest $request)
    {
        try {
            // Kiểm tra dữ liệu từ request bằng PetRequest
            $validatedData = $request->validated();
            $data               = $request->except('_token', 'avatar');
            $data['slug']       = Str::slug($request->name);
            $data['created_at'] = Carbon::now();

            if ($request->avatar) {
                $file = upload_image('avatar');
                if (isset($file['code']) && $file['code'] == 1) $data['avatar'] = $file['name'];
            }

            $data['user_id'] = Auth::user()->id;

            // kiểm tra input danh mục
            if (!empty($request->category_id)) {
                // Trường 'category_id' có dữ liệu được gửi lên
                // Thực hiện xử lý tương ứng ở đây
                // dd('có vào đây không');
            } else {
                if(!empty($request->custom_category)){
                    // thêm dữ liệu vào bảng category
                    $categoryId = DB::table('categories')->insertGetId([
                        'name' => $request->input('custom_category'),
                        'description' => $request->input('custom_category'),
                        'slug' => Str::slug($request->name),
                        'created_at' => Carbon::now(),
                        // Gán các giá trị cho các trường khác (nếu có)
                    ]);
                    $data['category_id'] = $categoryId;
                }
            }
            // dd($errors);
            $new_pet = Pet::create($data);
            $pet = Pet::with('category:id,name', 'user:id,name')
            ->find($new_pet->id);

        } catch (\Exception $exception) {
            Log::error("ERROR => PetController@store => " . $exception->getMessage());
            return redirect()->route('get_user.pet.create');
        }
        // return redirect()->route('get_user.pet.index');
        return response()->json(['success' => true, 'pet' => $pet]);
    }

    public function edit($id)
    {
        $pet        = Pet::findOrFail($id);
        $categories = Category::all();

        $viewData = [
            'pet'        => $pet,
            'categories' => $categories
        ];

        return view('frontend.pet.update', $viewData);
    }

    public function update(PetRequest $request, $id)
    {
        try {
            $data               = $request->except('_token', 'avatar');
            $data['slug']       = Str::slug($request->name);
            $data['updated_at'] = Carbon::now();

            if ($request->avatar) {
                $file = upload_image('avatar');
                if (isset($file['code']) && $file['code'] == 1) $data['avatar'] = $file['name'];
            }

            Pet::find($id)->update($data);

        } catch (\Exception $exception) {
            Log::error("ERROR => PetController@store => " . $exception->getMessage());
            toastr()->error('Xử lý thất bại', 'Thông báo');
            return redirect()->route('get_user.pet.update', $id);
        }

        toastr()->success('Xử lý thành công', 'Thông báo');
        return redirect()->route('get_user.pet.index');
    }

    public function delete(Request $request, $id)
    {
        try {
            $pet = Pet::findOrFail($id);
            if ($pet) $pet->delete();

        } catch (\Exception $exception) {
            Log::error("ERROR => PetController@delete => " . $exception->getMessage());
        }
        return redirect()->route('get_user.pet.index');
    }
}
