<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Roilift\Admin\Interfaces\ConfigRepositoryInterface;

class LicenseController extends Controller
{
    public function __construct(protected ConfigRepositoryInterface $configRepository)
    {
        
    }

    public function index()
    {
        $license = $this->configRepository->getConfigValueByKey('license');
        return view('other.license', compact('license'));
    }
}
