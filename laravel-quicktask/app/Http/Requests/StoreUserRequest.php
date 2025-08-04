<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'first_name' => 'nullable|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'nullable|string|max:20',
            // 'date_of_birth' => 'nullable|date|before:today',
            // 'gender' => 'nullable|in:male,female,other',
            'address' => 'nullable|string|max:500',
            'password' => 'required|string|min:8|confirmed',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
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
            'password.required' => 'Mật khẩu là bắt buộc.',
            'password.min' => 'Mật khẩu phải có ít nhất 8 ký tự.',
            'password.confirmed' => 'Xác nhận mật khẩu không khớp.',
            'avatar.image' => 'Avatar phải là file hình ảnh.',
            'avatar.mimes' => 'Avatar phải có định dạng: jpeg, png, jpg, gif.',
            'avatar.max' => 'Kích thước avatar không được vượt quá 2MB.',
            'roles.array' => 'Quyền phải là một mảng.',
            'roles.*.exists' => 'Quyền được chọn không tồn tại.'
        ];
    }
}
