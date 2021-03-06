<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use App\Rules\BelongsToCityRule;
use App\Rules\UnitRule;

class PostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $today = Carbon::now();
        $start = Carbon::parse(request()->start_date);
        $end   = Carbon::parse(request()->end_date);
        $diff  = $start->diffInDays($end);
        switch (request()->method()) {
            case 'PATCH':
            case 'PUT':
                $rules = [
                    'title'            => 'required|max:100|unique:posts,title,'.$this->post,
                    'purpose'          => 'required|in:sale,rent',
                    'price'            => 'required|numeric',
                    'area'             => 'required|numeric',
                    'description'      => 'required|min:40',
                    'district_id'      => ['required','exists:districts,id', new BelongsToCityRule('city_id')],
                    'unit'             => ['required','in:m2,total_area,month,year', new UnitRule('purpose')],
                    'city_id'          => 'required|exists:cities,id',
                    'type_id'          => 'exists:post_types,id',
                    'address'          => 'required|string',
                    'latitude'         => 'required',
                    'longitude'        => 'required',
                    // 'fImage'           => 'image|mimes:jpg,jpeg,bmp,png|max:2048',
                    'property_type_id' => 'required|exists:property_types,id',
                    'floor'            => 'required|numeric',
                    'bed_room'         => 'required|numeric',
                    'bath'             => 'required|numeric',
                    'balcony'          => 'required|numeric',
                    'toilet'           => 'required|numeric',
                    'start_date'       => 'required|date|date_format:Y-m-d|before:end_date',
                    'end_date'         => 'required|date|date_format:Y-m-d|after:'.$start->addDays($diff - 1),
                ];
                break;
            default:
                $rules = [
                    'title'            => 'required|max:100|unique:posts,title',
                    'purpose'          => 'required|in:sale,rent',
                    'price'            => 'required|numeric',
                    'area'             => 'required|numeric',
                    'description'      => 'required|min:40',
                    'city_id'          => 'required|exists:cities,id',
                    'district_id'      => ['required','exists:districts,id', new BelongsToCityRule('city_id')],
                    'type_id'          => 'required|exists:post_types,id',
                    'address'          => 'required|string',
                    'latitude'         => 'required',
                    'longitude'        => 'required',
                    'unit'             => ['required','in:m2,total_area,month,year', new UnitRule('purpose')],
                    // 'fImage'           => 'required|mimes:jpg,jpeg,bmp,png|max:2048',
                    'fImageDetails.*'  => 'mimes:jpg,jpeg,bmp,png|max:2048',
                    'property_type_id' => 'required|exists:property_types,id',
                    'floor'            => 'required|numeric',
                    'bed_room'         => 'required|numeric',
                    'bath'             => 'required|numeric',
                    'balcony'          => 'required|numeric',
                    'toilet'           => 'required|numeric',
                    'start_date'       => 'required|date|date_format:Y-m-d|after:'.$today.'|before:end_date',
                    'end_date'         => 'required|date|date_format:Y-m-d|after:'.$start->addDays($diff - 1),
                ];
                break;
        }
        return $rules;
    }
}
