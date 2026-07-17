<?php

namespace App\Http\Requests;

use App\Models\Bike;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class DeleteBikeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $bike = Bike::find($this->bike);
        return $this->user()?->can('delete', $bike) ?? false;
    }

    protected function failedAuthorization()
    {
        throw new AuthorizationException('Unable to Delete a bike if its not yours');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            //
        ];
    }
}
