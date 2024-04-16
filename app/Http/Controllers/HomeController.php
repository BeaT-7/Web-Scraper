<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Repositories\PostsRepository;

class HomeController extends Controller
{
    protected $repository;

    public function __construct(PostsRepository $repository)
    {
        $this->repository = $repository;
    }

    public function show()
    {
        $scrapedData = $this->repository->getDataToView();
        return Inertia::render('HomePage', ['scrapedData' => $scrapedData]);
    }

    public function deleteRow(Request $request) {
        $id = $request->input('id');
        $this->repository->postDelete($id);
    }

}
