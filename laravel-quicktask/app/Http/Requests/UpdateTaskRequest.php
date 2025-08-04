<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTaskRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'status' => 'required|in:pending,in_progress,completed',
            'priority' => 'required|in:low,medium,high',
            'due_date' => 'nullable|date',
            'user_id' => 'required|exists:users,id'
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Tiêu đề nhiệm vụ là bắt buộc.',
            'title.max' => 'Tiêu đề không được vượt quá 255 ký tự.',
            'description.max' => 'Mô tả không được vượt quá 1000 ký tự.',
            'status.required' => 'Trạng thái là bắt buộc.',
            'status.in' => 'Trạng thái phải là: chờ xử lý, đang thực hiện hoặc hoàn thành.',
            'priority.required' => 'Mức độ ưu tiên là bắt buộc.',
            'priority.in' => 'Mức độ ưu tiên phải là: thấp, trung bình hoặc cao.',
            'due_date.date' => 'Hạn hoàn thành phải là ngày hợp lệ.',
            'user_id.required' => 'Vui lòng chọn người được giao nhiệm vụ.',
            'user_id.exists' => 'Người dùng được chọn không tồn tại.'
        ];
    }
}
