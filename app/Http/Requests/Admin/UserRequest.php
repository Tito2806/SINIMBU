<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if ($this->isMethod('post')) {
            return $this->createRules();
        } elseif ($this->isMethod('put')) {
            return $this->updateRules();
        }
    }

    /**
     * Define validation rules to store method for resource creation
     *
     * @return array
     */
    public function createRules(): array
    {
        return [
            'rol' => 'required|',
            'name' => 'required|string|max:191',
            'email' => 'required|string|email|max:191|',
            'password' => 'required|min:8|max:20|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]/',
            'imagen' => 'required|',
        ];
    }

    /**
     * Define validation rules to update method for resource update
     *
     * @return array
     */
    public function updateRules(): array
    {
        return [
            'rol' => 'sometimes|',
            'name' => 'sometimes|string|max:191',
            'email' => 'sometimes|string|email|max:191' . $this->get('id'),
            'password' => 'required|min:8|max:20|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]/',
            'imagen' => 'required|',
        ];
    }
    public function messages(){
        return [
            'name.mun' => 'Minimo de 3 caracteres',
            'name.max' => 'Máximo de 100 caracteres',
            'name.*' => 'Se requiere un nombre',
            'email.*' => 'Se require un correo',
            'password.required' => 'Se require una contraseña',
            'password.min' => 'Minimo 8 caracteres',
            'password.max' => 'Máximo 20 caracteres',
            'password.regex' => 'Agrega mayúsculas, minúsculas y números',
            'rol.*' => 'Seleccione un tipo de rol',
            'imagen.*' => 'Imagen se requiere',
        ];
    }
}