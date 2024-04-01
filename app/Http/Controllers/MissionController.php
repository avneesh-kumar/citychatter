<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Roilift\Admin\Interfaces\ConfigRepositoryInterface;

class MissionController extends Controller
{
    public function __construct(protected ConfigRepositoryInterface $configRepository)
    {
        
    }

    public function index()
    {
        $mission = $this->configRepository->getConfigValueByKey('mission');
        return view('other.mission', compact('mission'));
    }
}
