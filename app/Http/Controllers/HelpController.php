<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Roilift\Admin\Interfaces\ConfigRepositoryInterface;

class HelpController extends Controller
{
    public function __construct(protected ConfigRepositoryInterface $configRepository)
    {
        
    }

    public function index()
    {
        $help = $this->configRepository->getConfigValueByKey('help');
        return view('other.help', compact('help'));
    }
}
