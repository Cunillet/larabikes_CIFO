<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Models\Circuit;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreCircuitRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()?->can('create', Circuit::class) ?? false;
    }

    protected function failedAuthorization()
    {
        throw new AuthorizationException('Unable to create a circuit if not admin');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:256', Rule::unique('circuits')],
            'country_id' => ['required', 'string', 'size:2', 'exists:countries,id'],
            'location' => ['nullable', 'string', 'max:512'],
            'length' => ['required', 'numeric', 'min:0', 'max:999.999'],
            'turns' => ['nullable', 'integer', 'min:0', 'max:65535'],
            'capacity' => ['nullable', 'integer', 'min:0'],
            'image' => ['nullable', 'image', 'max:5120'],
            'description' => ['nullable', 'string'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.unique' => 'A circuit with this name already exists',
            'image.max' => 'Circuit image can not exceed 5MB',
        ];
    }
}
