<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Validators\UserValidator;
use Illuminate\Database\Eloquent\Model;

/**
 * Class UserRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
abstract class BaseRepositoryEloquent extends BaseRepository
{
    protected const PAGINATION_LIMIT = 3; // default

    /**
     * Paginate the results with a default limit
     *
     * @param null|int $limit
     * @param array $columns
     * @param string $method
     * @return mixed
     */
    public function paginate($limit = null, $columns = ['*'], $method = 'paginate')
    {
        $limit = is_null($limit) ? self::PAGINATION_LIMIT : $limit;
        return parent::paginate($limit, $columns, $method);
    }
}