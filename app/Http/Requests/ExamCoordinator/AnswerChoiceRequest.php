<?php

namespace App\Http\Requests\ExamCoordinator;

use Illuminate\Foundation\Http\FormRequest;

class AnswerChoiceRequest extends FormRequest
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
            'option_text' => 'required|string',
            'is_correct' => 'required|boolean',
            'question_id' => 'required|integer',
        ];
    }
}
