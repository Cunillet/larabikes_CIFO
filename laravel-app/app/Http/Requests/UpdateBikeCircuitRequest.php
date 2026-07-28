<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Http\FormRequest;

class UpdateBikeCircuitRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $bike = $this->route('bike');
        return $this->user()?->can('update', $bike) ?? false;
    }

    protected function failedAuthorization()
    {
        throw new AuthorizationException('Unable to manage circuit times if you cannot manage the bike');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'lap_time' => ['required', 'date_format:H:i:s.u'],
            'record_date' => ['nullable', 'date'],
        ];
    }

    public function messages(): array
    {
        return [
            'lap_time.date_format' => 'Lap time must be in format HH:MM:SS',
        ];
    }
}
