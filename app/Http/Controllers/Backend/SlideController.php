<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Services\Interfaces\SlideServiceInterface as SlideService;
use App\Repositories\Interfaces\SlideRepositoryInterface as SlideRepository;
use App\Http\Requests\StoreSlideRequest;
use App\Http\Requests\UpdateSlideRequest;
use Illuminate\Http\Request;

class SlideController extends Controller
{
    protected $slideService;
    protected $slideRepository;

    public function __construct(SlideService $slideService, SlideRepository $slideRepository)
    {
        $this->slideService = $slideService;
        $this->slideRepository = $slideRepository;
    }

    public function index(Request $request)
    {
        $this->authorize('modules', 'slide.index');
        $slides = $this->slideService->paginate($request);

        $config = [
            'js' => [
                'backend/js/plugins/switchery/switchery.js',
                'backend/library/switchery.js',
                'backend/library/changeStatus.js',
                'backend/library/selectAll.js',
            ],
            'css' => [
                'backend/css/plugins/switchery/switchery.css'
            ],
            'model' => 'Slide',
        ];
        $config['seo'] = __('message.slide');

        $template = 'backend.slide.slide.index';
        return view("backend.dashboard.layout", compact('template', 'config', 'slides'));
    }

    public function create()
    {
        $this->authorize('modules', 'slide.create');

        $config = $this->configData();

        $config['seo'] = __('message.slide');
        $config['method'] = 'create';

        $template = 'backend.slide.slide.store';
        return view('backend.dashboard.layout', compact('template', 'config'));
    }

    public function store(StoreSlideRequest $request)
    {
        if ($this->slideService->create($request)) {
            return redirect()->route('slide.index')->with("success", "Đã thêm người dùng");
        }
        return redirect()->route("slide.create")->with("error", "Đã xảy ra lỗi khi thêm người dùng");
    }

    public function edit($id)
    {
        $this->authorize('modules', 'slide.update');

        $slide = $this->slideRepository->findById($id);
        $config = $this->configData();
        $config['seo'] = __('message.slide');
        $config['method'] = 'edit';
        $template = 'backend.slide.slide.store';
        return view('backend.dashboard.layout', compact('template', 'config', 'provinces', 'slide'));
    }

    public function update($id, UpdateSlideRequest $request)
    {
        if ($this->slideService->update($id, $request)) {
            return redirect()->route('slide.index')->with('success', 'Cập nhật thông tin thành công.');
        }
        return redirect()->route('slide.edit', $id)->with('error', 'Đã xảy ra lỗi khi cập nhật. Vui lòng thử lại sau.');
    }

    public function delete($id)
    {
        $this->authorize('modules', 'slide.destroy');

        $config['seo'] = __('message.slide');
        $slide = $this->slideRepository->findById($id);
        $template = 'backend.slide.slide.delete';
        return view("backend.dashboard.layout", compact('template', 'slide', 'config'));
    }

    public function destroy($id)
    {
        if ($this->slideService->destroy($id)) {
            return redirect()->route('slide.index')->with('success', 'Đã xoá người dùng');
        }
        return redirect()->route('slide.index')->with('error', 'Đã xảy ra lỗi khi xoá người dùng');
    }

    private function configData()
    {
        return [
            'css' => [
                'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css',
            ],
            'js' => [
                'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js',
                'backend/library/select2.js',
                'backend/library/finder.js',
                'backend/plugins/ckfinder_2/ckfinder.js',
                'backend/library/slide.js',
            ]
        ];
    }
}
