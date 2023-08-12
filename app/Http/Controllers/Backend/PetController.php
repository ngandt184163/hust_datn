<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Pet;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use App\Http\Requests\PetRequest;

class PetController extends Controller
{
    public function index(Request $request)
    {
        $pets = Pet::with('category:id,name', 'user:id,name');

        if ($name = $request->n)
            $pets->where('name', 'like', '%' . $name . '%');

        if ($s = $request->status)
            $pets->where('status', $s);

        $pets = $pets
            ->orderByDesc('id')
            ->paginate(20);

        $viewData = [
            'pets'  => $pets,
            'query' => $request->query(),
        ];

        return view('backend.pet.index', $viewData);
    }

    public function create()
    {
        $categories = Category::all();
        return view('backend.pet.create', compact('categories'));
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

            $pet = Pet::create($data);

        } catch (\Exception $exception) {
            Log::error("ERROR => PetController@store => " . $exception->getMessage());
            return redirect()->route('get_admin.pet.create');
        }
        return redirect()->route('get_admin.pet.index');
    }

    public function edit($id)
    {
        $pet        = Pet::findOrFail($id);
        $categories = Category::all();

        $viewData = [
            'pet'        => $pet,
            'categories' => $categories
        ];

        return view('backend.pet.update', $viewData);
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
            return redirect()->route('get_admin.pet.update', $id);
        }

        toastr()->success('Xử lý thành công', 'Thông báo');
        return redirect()->route('get_admin.pet.index');
    }

    public function delete(Request $request, $id)
    {
        try {
            $pet = Pet::findOrFail($id);
            if ($pet) $pet->delete();

        } catch (\Exception $exception) {
            Log::error("ERROR => PetController@delete => " . $exception->getMessage());
        }
        return redirect()->route('get_admin.pet.index');
    }
}
