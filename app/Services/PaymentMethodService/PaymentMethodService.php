<?php

namespace App\Services\PaymentMethodService;

use App\Repositories\PaymentMethodRepository\PaymentMethodRepositoryInterface;
use App\Services\BaseService;
use App\Models\PaymentMethod;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

class PaymentMethodService extends BaseService {

    protected $paymentMethodRepository;

    public function __construct(PaymentMethodRepositoryInterface $paymentMethodRepository) {
        $this->paymentMethodRepository = $paymentMethodRepository;
    }

    /**
     * get list method
     *
     * @return Collection
     */
    public function getAll() {
        return $this->paymentMethodRepository->all();
    }

    /**
     * get payment method by id
     *
     * @param $id
     * @return PaymentMethod
     */
    public function getById($id) {
        return $this->paymentMethodRepository->find($id);
    }

    /**
     * create new permission function
     *
     * @param $request
     * @return void
     */
    public function create($request) {
        $request['status'] = PaymentMethod::STATUS_ACTIVE;
        $request['created_id'] = Auth::user()->id;
        $request['infor'] = array_combine($request['key'],$request['value']);
        $request['infor'] = array_filter($request['infor']);
        $input = $request->only((new PaymentMethod())->getFillable());
        return $this->paymentMethodRepository->create($input);
    }

    /**
     * update permission function
     *
     * @param $request
     * @param $id
     * @return void
     */
    public function update($request, $id) {
        $request['update_id'] = Auth::user()->id;
        $request['infor'] = array_combine($request['key'],$request['value']);
        $request['infor'] = array_filter($request['infor']);
        $input = $request->only((new PaymentMethod())->getFillable());
        return $this->paymentMethodRepository->update($input, $id);
    }

    /**
     * update permission function
     *
     * @param $id
     * @return boolean
     */
    public function delete($id) {
        return $this->paymentMethodRepository->delete($id);
    }

    public function paginate($relation = [], $columns = ['*'], $perPage = 10) {
        // TODO: Implement paginate() method.
    }
}
