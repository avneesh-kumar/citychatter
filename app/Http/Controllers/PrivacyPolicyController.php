<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Roilift\Admin\Interfaces\ConfigRepositoryInterface;

class PrivacyPolicyController extends Controller
{
    public function __construct(protected ConfigRepositoryInterface $configRepository)
    {
        
    }
    public function index()
    {
        $privacyPolicy = $this->configRepository->getConfigValueByKey('privacypolicy');
        return view('other.privacy-policy', compact('privacyPolicy'));
    }
}
