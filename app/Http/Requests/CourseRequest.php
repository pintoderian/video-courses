<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CourseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; // Aquí puedes validar si el usuario tiene permisos si lo deseas
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $courseId = $this->route('course') ? $this->route('course')->id : null;

        return [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'age_group' => 'required|in:5-8,9-13,14-16,16+',
            'category_id' => 'required|exists:categories,id',
            'slug' => [
                'required',
                'string',
                'max:255',
                Rule::unique('courses')->ignore($courseId), // Asegura que el slug sea único
            ],
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'title' => 'Título',
            'description' => 'Descripción',
            'age_group' => 'Rango de Edad',
            'category_id' => 'Categoría',
            'slug' => 'Slug',
            'image' => 'Imagen',
        ];
    }
}
