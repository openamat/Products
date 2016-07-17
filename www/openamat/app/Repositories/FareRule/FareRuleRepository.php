<?php

namespace App\Repositories\FareRule;

use App\Repositories\FareRule\FareRule;
use Illuminate\Support\Facades\Schema;

class FareRuleRepository
{
    public function __construct(FareRule $farerule)
    {
        $this->model = $farerule;
    }

    /**
     * Returns all fareRules
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
     * Search FareRule
     *
     * @param string $input
     *
     * @return FareRule
     */
    public function search($input, $paginate)
    {
        $query = $this->model->orderBy('created_at', 'desc');

        $columns = Schema::getColumnListing('farerules');

        foreach ($columns as $attribute) {
            $query->orWhere($attribute, 'LIKE', '%'.$input.'%');
        };

        return $query->paginate($paginate);
    }

    /**
     * Stores FareRule into database
     *
     * @param array $input
     *
     * @return FareRule
     */
    public function create($input)
    {
        return $this->model->create($input);
    }

    /**
     * Find FareRule by given id
     *
     * @param int $id
     *
     * @return \Illuminate\Support\Collection|null|static|FareRule
     */
    public function find($id)
    {
        return $this->model->find($id);
    }

    /**
     * Destroy FareRule
     *
     * @param int $id
     *
     * @return \Illuminate\Support\Collection|null|static|FareRule
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
     * Updates FareRule in the database
     *
     * @param int $id
     * @param array $inputs
     *
     * @return FareRule
     */
    public function update($id, $inputs)
    {
        $farerule = $this->model->find($id);
        $farerule->fill($inputs);
        $farerule->save();

        return $farerule;
    }
}
