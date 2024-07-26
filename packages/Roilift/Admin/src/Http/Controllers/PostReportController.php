<?php

namespace Roilift\Admin\Http\Controllers;

use Illuminate\Routing\Controller;
use Roilift\Admin\Interfaces\PostReportRepositoryInterface;

class PostReportController extends Controller
{
    public function __construct(
        protected PostReportRepositoryInterface $postReportRepository,
    )
    {
    }

    public function index()
    {
        view()->share('title', 'Reported Post');
        $search = [];
        
        $reportedPosts = $this->postReportRepository->paginate(20, ['*'], 'page', null, [], [['field' => 'id', 'dir' => 'desc']], $search);
        return view('admin::post.report.index', compact('reportedPosts'));
    }

}