<?php

namespace App\Http\Controllers;

use Roilift\Admin\Interfaces\PostRepositoryInterface;
use Roilift\Admin\Interfaces\PostReportRepositoryInterface;

class PostReportController extends Controller
{
    public function __construct(
        protected PostReportRepositoryInterface $postReportRepository,
        protected PostRepositoryInterface $postRepository
    )
    {
    }

    public function report()
    {
        if(request('reason') == '') {
            return response()->json([
                'success' => false,
                'message' => 'Reason is required'
            ]);
        }

        $data = [
            'reason' => request('reason'),
            'description' => request('description'),
            'post_id' => request('post_id'),
            'reported_by' => auth()->user()->id
        ];

        $this->postReportRepository->create($data);
        $this->postRepository->update(['status' => false], request('post_id'));

        return response()->json([
            'success' => true,
            'message' => 'Post reported successfully'
        ]);
    }
}
