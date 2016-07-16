<?php

namespace App\Repositories\Service;

use App\Repositories\Service\Service;
use Illuminate\Support\Facades\Schema;

class ServiceRepository
{
    public function __construct(Service $service)
    {
        $this->model = $service;
    }

    /**
     * Returns all services
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function all()
    {
        return $this->model->orderBy('created_at', 'desc')->get();
    }

    /**
     * Returns all paginated $MODEL_NAME_PLURAL$
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function paginated($paginate)
    {
        return $this->model->orderBy('created_at', 'desc')->paginate($paginate);
    }

    /**
     * Search Service
     *
     * @param string $input
     *
     * @return Service
     */
    public function search($input, $paginate)
    {
        $query = $this->model->orderBy('created_at', 'desc');

        $columns = Schema::getColumnListing('services');

        foreach ($columns as $attribute) {
            $query->orWhere($attribute, 'LIKE', '%'.$input.'%');
        };

        return $query->paginate($paginate);
    }

    /**
     * Stores Service into database
     *
     * @param array $input
     *
     * @return Service
     */
    public function create($input)
    {
        return $this->model->create($input);
    }

    /**
     * Find Service by given id
     *
     * @param int $id
     *
     * @return \Illuminate\Support\Collection|null|static|Service
     */
    public function find($id)
    {
        return $this->model->find($id);
    }

    /**
     * Destroy Service
     *
     * @param int $id
     *
     * @return \Illuminate\Support\Collection|null|static|Service
     */
    public function destroy($id)
    {
        return $this->model->find($id)->delete();
    }

    /**
     * Updates Service in the database
     *
     * @param int $id
     * @param array $inputs
     *
     * @return Service
     */
    public function update($id, $inputs)
    {
        $service = $this->model->find($id);
        $service->fill($inputs);
        $service->save();

        return $service;
    }
}
