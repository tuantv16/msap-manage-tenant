<?php

namespace App\Http\Controllers\Admin\PaymentMethod;

use App\Http\Controllers\Controller;
use App\Services\PaymentMethodService\PaymentMethodService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class PaymentMethodController extends Controller {

    protected $paymentMethodService;
    
    public function __construct(PaymentMethodService $paymentMethodService) {
        $this->paymentMethodService = $paymentMethodService;
    }

    /**
     * Show list payment methods
     * 
     * @return View
     */
    public function index() {
        $paymentMethods = $this->paymentMethodService->getAll();
        return view('payment_methods.index', compact('paymentMethods'));
    }

    /**
     * Show the form for creating a new payment method
     * 
     * @return View
     */
    public function create() {
        return view('payment_methods.create');
    }

    /**
     * create new permission
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request) {
        try {
            $this->paymentMethodService->create($request);
            return redirect()->route('payment_methods.index')->with('success', 'Payment Method created successfully!');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            return redirect()->back()->withErrors(provider: ['error' => 'Payment Method not created']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id) {
        
    }

    /**
     * Show the form for editing the specified payment method.
     * 
     * @param $id 
     * @return View
     */
    public function edit($id) {
        $paymentMethod = $this->paymentMethodService->getById($id);
        return view('payment_methods.edit', compact('paymentMethod'));
    }

    /**
     * Update the specified resource in storage.
     * 
     * @param Request $request
     * @param $id
     * @return RedirectResponse
     */
    public function update(Request $request, $id) {
        try {
            $this->paymentMethodService->update($request,$id);
            return redirect()->route('payment_methods.index')->with('success', 'Payment Method updated successfully!');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            return redirect()->back()->withErrors(provider: ['error' => 'Payment Method not updated']);
        }
    }

    /**
     * Remove the specified payment method from storage.
     * 
     * @param $id 
     * @return RedirectResponse
     */
    public function destroy($id) {
        try {
            $this->paymentMethodService->delete($id);
            return redirect()->route('payment_methods.index')->with('success', 'Payment Method deleted successfully!');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $exception) {
            Log::error('Delete Payment Method error: ' . $exception->getMessage());
            return redirect()->route('payment_methods.index')->with('error', 'Payment Method  not deleted');
        }
    }
}
