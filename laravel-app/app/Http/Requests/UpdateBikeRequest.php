<?php

namespace App\Http\Requests;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use App\Rules\TextUpper;
use Illuminate\Validation\Rule;

class UpdateBikeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // return $this->user()->can('update', $this->bike);
        return true;
    }

    protected function failedAuthorization()
    {
        throw new AuthorizationException('Unable to edit a bike if its not yours');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'brand' => ['required','string','max:255'],
            'model' => ['required','string','max:255'],
            'color' => ['nullable','hex_color'],
            'kms' => ['required','integer','min:0'],
            'price' => ['required','numeric','min:0'],
            'registered' => 'required_with:bike_plate',
            'bike_plate' => ['required_if:registered,1',
                            'nullable',
                            'regex:/^\d{4}[B-Z]{3}$/i',
                            new TextUpper,
                            Rule::unique('bikes')->ignore($this->bike),
                        ],
            'image' => ['nullable','image','max:5120'],
            'description' => ['nullable', 'string'],
            'buy_date' => ['nullable', 'date'],
            'horsepower' => ['nullable', 'integer', 'min:1'],
        ];
    }

    public function messages():array
    {
        return [
            'bike_plate.required_if' => 'Bike plate is required if Bike is registered',
            'bike_plate.unique' => 'Bike Plate must be unique',
            'color.regex' => 'Bike color must follow HEX format (ex. #FFFFFF for white)',
            'image.max' => 'Bike image can not exceed 8MB',
        ];
    }
}
