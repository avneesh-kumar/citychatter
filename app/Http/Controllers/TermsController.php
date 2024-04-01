<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Roilift\Admin\Interfaces\ConfigRepositoryInterface;

class TermsController extends Controller
{
    public function __construct(protected ConfigRepositoryInterface $configRepository)
    {
        
    }

    public function index()
    {
        $terms = $this->configRepository->getConfigValueByKey('terms');
        return view('other.terms', compact('terms'));
    }
}
