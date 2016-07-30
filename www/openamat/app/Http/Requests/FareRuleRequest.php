<?php

namespace App\Http\Requests;

use Auth;
use App\Http\Requests\Request;
use App\Repositories\FareRule\FareRule;

class FareRuleRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if (Auth::user()) {
            return true;
        }

        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return FareRule::$rules;
    }
}