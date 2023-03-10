<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class GaleriaRequest extends FormRequest
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
            
            'titulo' => 'required|string|min:3|max:40|regex:/^([a-zA-ZñÑáéíóúÁÉÍÓ-])+((\s*)+([a-zA-ZñÑáéíóúÁÉÍÓÚ-]*)*)+$/',
            'descripcion' => 'required|string|max:250',
            'categoria' => 'required|string|max:250',
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
           
            'titulo' => 'required|string|min:3|max:40|regex:/^([a-zA-ZñÑáéíóúÁÉÍÓ-])+((\s*)+([a-zA-ZñÑáéíóúÁÉÍÓÚ-]*)*)+$/',
            'descripcion' => 'required|string|max:250',
            'categoria' => 'required|string|max:250',
            'imagen' => 'required|',
        ];
    }

    public function messages(){
        return [
           
            'titulo.regex' => 'Solo letras en el titulo',
            'titulo.*' => 'Nombre requiere mínimo 3 caracteres y máximo 20',
            'categoria.*' => 'Seleccione una categoria',
            'descripcion.*' => 'Se requiere una breve descripción',
            'imagen.*' => 'Se requiere una imagen',
        ];
    }
}