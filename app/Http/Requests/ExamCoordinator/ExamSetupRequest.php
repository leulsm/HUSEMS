<?php

namespace App\Http\Requests\ExamCoordinator;

use Illuminate\Foundation\Http\FormRequest;

class ExamSetupRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            //
            // 'exam_coordinator_id' => 'required|exists:users,id',
            'exam_title' => 'required|string',
            'exam_type' => 'required|string',
            'duration_time' => 'required|date_format:H:i',
            'status' => 'nullable|boolean',
            'total_mark' => 'required|integer',
            'pass_mark' => 'required|integer',
        ];
    }
}
