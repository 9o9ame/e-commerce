<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.dashboard.index');
    }
    public function alternate()
    {
        return view('admin.dashboard.index2');
    }
    public function emailBox()
    {
        return view('admin.application.app-emailbox');
    }
    public function chatBox()
    {
        return view('admin.application.app-chat-box');
    }
    public function fileManager()
    {
        return view('admin.application.app-file-manager');
    }
    public function appContactList()
    {
        return view('admin.application.app-contact-list');
    }
    public function appToDo()
    {
        return view('admin.application.app-to-do');
    }
    public function appInvoice()
    {
        return view('admin.application.app-invoice');
    }
    public function appFullcalender()
    {
        return view('admin.application.app-fullcalender');
    }
    public function widgets()
    {
        return view('admin.widgets.widgets');
    }
    public function ecommerceProducts()
    {
        return view('admin.ecommerce.ecommerce-products');
    }
    public function ecommerceProductsDetails()
    {
        return view('admin.ecommerce.ecommerce-products-details');
    }
    public function ecommerceAddNewProducts()
    {
        return view('admin.ecommerce.ecommerce-add-new-products');
    }
    public function ecommerceOrders()
    {
        return view('admin.ecommerce.ecommerce-orders');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
