<?php

namespace App\Repositories\Route;

use App\Repositories\Route\Route;
use Illuminate\Support\Facades\Schema;

class RouteRepository
{
    public function __construct(Route $route)
    {
        $this->model = $route;
    }

    /**
     * Returns all routes
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
     * Search Route
     *
     * @param string $input
     *
     * @return Route
     */
    public function search($input, $paginate)
    {
        $query = $this->model->orderBy('created_at', 'desc');

        $columns = Schema::getColumnListing('routes');

        foreach ($columns as $attribute) {
            $query->orWhere($attribute, 'LIKE', '%'.$input.'%');
        };

        return $query->paginate($paginate);
    }

    /**
     * Stores Route into database
     *
     * @param array $input
     *
     * @return Route
     */
    public function create($input)
    {
        return $this->model->create($input);
    }

    /**
     * Find Route by given id
     *
     * @param int $id
     *
     * @return \Illuminate\Support\Collection|null|static|Route
     */
    public function find($id)
    {
        return $this->model->find($id);
    }

    /**
     * Destroy Route
     *
     * @param int $id
     *
     * @return \Illuminate\Support\Collection|null|static|Route
     */
    public function destroy($id)
    {
        return $this->model->find($id)->delete();
    }

    /**
     * Truncate all Fares
     *
     *
     * @return \Illuminate\Support\Collection|null|static|Fare
     */
    public function truncate()
    {
        return $this->model->truncate();
    }

    /**
     * Updates Route in the database
     *
     * @param int $id
     * @param array $inputs
     *
     * @return Route
     */
    public function update($id, $inputs)
    {
        $route = $this->model->find($id);
        $route->fill($inputs);
        $route->save();

        return $route;
    }
}
