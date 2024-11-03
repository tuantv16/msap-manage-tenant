<?php

namespace App\Repositories\PaymentMethodRepository;

use App\Models\PaymentMethod;
use App\Repositories\BaseRepositoryEloquent;

/**
 * Class AreaRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class PaymentMethodRepository extends BaseRepositoryEloquent implements PaymentMethodRepositoryInterface {
    
    /**
     * @return string
    */
    public function model() {
        return PaymentMethod::class;
    }
}
