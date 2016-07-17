<?php

namespace App\Repositories\Stop;

use App\Repositories\Stop\Stop;
use Illuminate\Support\Facades\Schema;

class StopRepository
{
    public function __construct(Stop $stop)
    {
        $this->model = $stop;
    }

    /**
     * Returns all stops
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
     * Search Stop
     *
     * @param string $input
     *
     * @return Stop
     */
    public function search($input, $paginate)
    {
        $query = $this->model->orderBy('created_at', 'desc');

        $columns = Schema::getColumnListing('stops');

        foreach ($columns as $attribute) {
            $query->orWhere($attribute, 'LIKE', '%'.$input.'%');
        };

        return $query->paginate($paginate);
    }

    /**
     * Stores Stop into database
     *
     * @param array $input
     *
     * @return Stop
     */
    public function create($input)
    {
        return $this->model->create($input);
    }

    /**
     * Find Stop by given id
     *
     * @param int $id
     *
     * @return \Illuminate\Support\Collection|null|static|Stop
     */
    public function find($id)
    {
        return $this->model->find($id);
    }

    /**
     * Destroy Stop
     *
     * @param int $id
     *
     * @return \Illuminate\Support\Collection|null|static|Stop
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
     * Updates Stop in the database
     *
     * @param int $id
     * @param array $inputs
     *
     * @return Stop
     */
    public function update($id, $inputs)
    {
        $stop = $this->model->find($id);
        $stop->fill($inputs);
        $stop->save();

        return $stop;
    }
}
