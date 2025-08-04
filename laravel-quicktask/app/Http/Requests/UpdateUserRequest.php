<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
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
    public function rules()
    {
        return [
            'first_name' => 'nullable|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users')->ignore($this->user)
            ],
            'phone' => 'nullable|string|max:20',
            // 'date_of_birth' => 'nullable|date|before:today',
            // 'gender' => 'nullable|in:male,female,other',
            'address' => 'nullable|string|max:500',
            'roles' => 'nullable|array',
            'roles.*' => 'exists:roles,id'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Tên là bắt buộc.',
            'name.max' => 'Tên không được vượt quá 255 ký tự.',
            'email.required' => 'Email là bắt buộc.',
            'email.email' => 'Email không đúng định dạng.',
            'email.unique' => 'Email này đã được sử dụng.',
            'phone.max' => 'Số điện thoại không được vượt quá 20 ký tự.',
            'date_of_birth.date' => 'Ngày sinh phải là ngày hợp lệ.',
            'date_of_birth.before' => 'Ngày sinh phải trước ngày hôm nay.',
            'gender.in' => 'Giới tính phải là nam, nữ hoặc khác.',
            'address.max' => 'Địa chỉ không được vượt quá 500 ký tự.',
            'roles.array' => 'Quyền phải là một mảng.',
            'roles.*.exists' => 'Quyền được chọn không tồn tại.'
        ];
    }
}
