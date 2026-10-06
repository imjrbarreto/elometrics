<?php

namespace App\Http\Requests;

use App\Enums\WorkspaceRole;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class StoreWorkspaceMemberRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()?->can('manageMembers', $this->route('workspace')) ?? false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'username' => ['required', 'string', 'exists:users,username'],
            'role' => ['required', Rule::enum(WorkspaceRole::class)],
        ];
    }
}
