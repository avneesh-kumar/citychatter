<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Roilift\Admin\Interfaces\ConfigRepositoryInterface;

class AboutController extends Controller
{
    public function __construct(protected ConfigRepositoryInterface $configRepository)
    {
        
    }
    public function index()
    {
        $aboutus = $this->configRepository->getConfigValueByKey('aboutus');
        return view('other.about', compact('aboutus'));
    }
}
