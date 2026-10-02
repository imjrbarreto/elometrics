<?php

namespace App\Http\Requests;

use App\Enums\SessionStatus;
use App\Enums\TrainingSessionCategory;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreTrainingSessionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'summary' => ['nullable', 'string', 'max:255'],
            'status' => ['required', Rule::enum(SessionStatus::class)],
            'category' => ['nullable', Rule::enum(TrainingSessionCategory::class)],
            'resource_url' => ['nullable', 'url:https', 'max:2048'],
        ];
    }
}
