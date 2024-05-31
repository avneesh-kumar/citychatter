<?php

namespace Roilift\Admin\Http\Controllers;

use App\Http\Controllers\Controller;
use Roilift\Admin\Interfaces\AdvertisementRepositoryInterface;

class AdvertisementController extends Controller
{
    public function __construct(
        protected AdvertisementRepositoryInterface $advertisementRepository
    )
    {
    }

    public function index()
    {
        view()->share('title', 'Advertisements');
        $advertisements = $this->advertisementRepository->paginate(20 , ['*'], 'page', null, [], [['field' => 'id', 'dir' => 'desc'], ['field' => 'sort_order', 'dir' => 'asc']]);
        return view('admin::advertisement.index', compact('advertisements'));
    }

    public function create()
    {
        view()->share('title', 'Create Advertisement');
        $backUrl = request()->headers->get('referer');
        return view('admin::advertisement.create', compact('backUrl'));
    }

    public function edit($id)
    {
        view()->share('title', 'Edit Advertisement');
        $advertisement = $this->advertisementRepository->find($id);
        $backUrl = request()->headers->get('referer');
        return view('admin::advertisement.create', compact('advertisement', 'backUrl'));
    }

    public function store()
    {
        if(request('id')) {
            $data = request()->validate([
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            ]);
        } else {
            $data = request()->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            ]);
        }

        $data = request()->validate([
            'url' => 'required',
            'sort_order' => 'nullable',
            'status' => 'required',
        ]);

        $data['created_by'] = auth()->guard('admin')->user()->id;
        $data['sort_order'] = $data['sort_order'] ?? 0;

        if(request('id')) {
            $advertisement = $this->advertisementRepository->find(request('id'));
            if(request()->hasFile('image')) {
                $data['image'] = $this->uploadImage(request()->file('image'), $advertisement);
            }

            $this->advertisementRepository->update($data, request('id'));

        } else {
            $advertisement = $this->advertisementRepository->create($data);
            if(request()->hasFile('image')) {
                $data['image'] = $this->uploadImage(request()->file('image'), $advertisement);
            }
            $this->advertisementRepository->update($data, $advertisement->id);
        }

        return redirect()->route('admin.advertisement')->with('success', 'Advertisement created successfully');
    }

    public function destroy()
    {
        $data = request()->validate([
            'id' => 'required',
        ]);

        $this->advertisementRepository->destroy($data['id']);
        return redirect()->route('admin.advertisement')->with('success', 'Advertisement deleted successfully');
    }

    private function uploadImage($image, $advertisement)
    {
        $path = 'images/advertisements/' . $advertisement->id . '/';
        $public_path = public_path($path);
        
        if(!file_exists($public_path)) {
            mkdir($public_path, 0777, true);
        }
        
        $imageName = time() . '.' . $image->extension();
        $image->move($public_path, $imageName);

        return $path . $imageName;
    }
}
