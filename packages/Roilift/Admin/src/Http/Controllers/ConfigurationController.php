<?php

namespace Roilift\Admin\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Roilift\Admin\Interfaces\ConfigRepositoryInterface;

class ConfigurationController extends Controller
{
    public function __construct(protected ConfigRepositoryInterface $configRepository)
    {
        $this->configRepository = $configRepository;
    }

    public function index(Request $request)
    {
        view()->share('title', 'General Configuration');
        $backUrl = request()->headers->get('referer');
        $configs = $this->configRepository->getConfigsByGroup('general');
        $configData = [];

        foreach ($configs as $config) {
            $configData[$config->key] = $config->value;
        }

        return view('admin::setting.config', compact('configData', 'backUrl'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $data = $request->all();
        unset($data['_token']);
        foreach ($data as $key => $value) {
            $configData = [
                'key' => $key,
                'value' => $value,
                'group' => 'general'
            ];

            $config = $this->configRepository->getConfigByKey($key);
            if ($config) {
                $this->configRepository->update($configData, $config->id);
            } else {
                $config = $this->configRepository->create($configData);                
            }
        }

        return redirect()->back()->with('success', 'Configuration updated successfully');
    }
}