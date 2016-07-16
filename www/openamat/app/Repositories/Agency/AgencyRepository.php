<?php

namespace App\Repositories\Agency;

use App\Repositories\Agency\Agency;
use Illuminate\Support\Facades\Schema;

class AgencyRepository
{
    public function __construct(Agency $agency)
    {
        $this->model = $agency;
    }

    /**
     * Returns all agencies
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
     * Search Agency
     *
     * @param string $input
     *
     * @return Agency
     */
    public function search($input, $paginate)
    {
        $query = $this->model->orderBy('created_at', 'desc');

        $columns = Schema::getColumnListing('agencies');

        foreach ($columns as $attribute) {
            $query->orWhere($attribute, 'LIKE', '%'.$input.'%');
        };

        return $query->paginate($paginate);
    }

    /**
     * Stores Agency into database
     *
     * @param array $input
     *
     * @return Agency
     */
    public function create($input)
    {
        return $this->model->create($input);
    }

    /**
     * Find Agency by given id
     *
     * @param int $id
     *
     * @return \Illuminate\Support\Collection|null|static|Agency
     */
    public function find($id)
    {
        return $this->model->find($id);
    }

    /**
     * Destroy Agency
     *
     * @param int $id
     *
     * @return \Illuminate\Support\Collection|null|static|Agency
     */
    public function destroy($id)
    {
        return $this->model->find($id)->delete();
    }

    /**
     * Updates Agency in the database
     *
     * @param int $id
     * @param array $inputs
     *
     * @return Agency
     */
    public function update($id, $inputs)
    {
        $agency = $this->model->find($id);
        $agency->fill($inputs);
        $agency->save();

        return $agency;
    }
}
