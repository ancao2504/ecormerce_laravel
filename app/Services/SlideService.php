<?php

namespace App\Services;

use App\Services\Interfaces\SlideServiceInterface;
use App\Repositories\Interfaces\SlideRepositoryInterface as SlideRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;

/**
 * Class SlideService
 * @package App\Services
 */
class SlideService extends BaseService implements SlideServiceInterface
{
    protected $slideRepository;
    public function __construct(SlideRepository $slideRepository)
    {
        $this->slideRepository = $slideRepository;
    }

    private function paginateSelect()
    {
        return [
            'id',
            'name',
            'keyword',
            'item',
            'publish',
        ];
    }

    public function paginate($request)
    {
        $condition['keyword'] = addcslashes($request->input('keyword'), '\\%_');
        $condition['publish'] = $request->integer('publish');
        $perpage = $request->integer('perpage');
        $slides = $this->slideRepository->pagination(
            $this->paginateSelect(),
            $condition,
            $perpage,
            ['path' => 'slide/index']
        );
        return $slides;
    }

    private function handleItem($request, $languageId)
    {
        $slide = $request->input('slide');
        $temp = [];
        foreach ($slide['image'] as $key => $value) {
            $temp[$languageId][] = [
                'image' => $value,
                'name' => $slide['name'][$key],
                'description' => $slide['description'][$key],
                'url' => $slide['url'][$key],
                'alt' => $slide['alt'][$key],
                'window' => isset($slide['window'][$key]) ? $slide['window'][$key] : '',
            ];
        }
        return $temp;
    }

    public function create(Request $request, $languageId)
    {
        DB::beginTransaction();
        try {
            $payload = $request->only(['_token', 'name', 'keyword', 'setting', 'short_code']);
            $payload['item'] = $this->handleItem($request, $languageId);
            $slide = $this->slideRepository->create($payload);
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            // Log::error($e->getMessage());
            echo $e->getMessage();
            die();
            return false;
        }
    }

    public function convertSlideArray(array $slide = [])
    {
        $temp = [];
        $fields = ['name', 'image', 'description', 'url', 'alt', 'window'];
        foreach ($slide as $key => $value) {
            foreach ($fields as $field) {
                $temp[$field][] = $value[$field];
            }
        }

        return $temp;
    }

    public function update($id, Request $request, $languageId)
    {
        DB::beginTransaction();
        try {
            $slide = $this->slideRepository->findById($id);
            $slideItem = $slide->item[$languageId];
            unset($slideItem[$languageId]);
            $payload = $request->only(['_token', 'name', 'keyword', 'setting', 'short_code']);
            $payload['item'] = $this->handleItem($request, $languageId) + $slideItem;
            $slide = $this->slideRepository->update($id, $payload);
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            // Log::error($e->getMessage());
            echo $e->getMessage();
            die();
            return false;
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $slide = $this->slideRepository->forceDelete($id);
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            // Log::error($e->getMessage());
            echo $e->getMessage();
            die();
            return false;
        }
    }
}
