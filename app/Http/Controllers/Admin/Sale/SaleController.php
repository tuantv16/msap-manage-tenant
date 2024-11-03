<?php

namespace App\Http\Controllers\Admin\Sale;

use App\Http\Controllers\Controller;
use App\Services\UserService\UserService;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    public function __construct(protected UserService $userService)
    {
    }

    public function index(){
        $sales = $this->userService->getListSales();
        return view('admin.sales.index', compact('sales'));
    }



}
