<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;

use App\Http\Services\OrderService;
use App\Http\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
//use Symfony\Component\HttpFoundation\Response;

class HomeController extends Controller
{
    private UserService $userService;
    private OrderService $orderService;
    public function __construct()
    {
        $this->userService = new UserService();
        $this->orderService = new OrderService();
    }

    public function index()
    {
        try {
            $user = $this->userService->userHeader();
            $orders = $this->orderService->getAllOrdersPagination();
            return view('pages.home', [
                'user' => $user,
                'orders' => $orders,
            ]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function search(Request $request)
    {
        try {
            $search = $request->input('search');
            $user = $this->userService->userHeader();
            if ($search != '') {
                $orders = $this->orderService->fetAllOrdersPaginationBySearch($search);
            } else {
                $orders = $this->orderService->getAllOrdersPagination();
            }


            return view('pages.home', [
                'user' => $user,
                'orders' => $orders,
                'search' => $search,
            ]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
