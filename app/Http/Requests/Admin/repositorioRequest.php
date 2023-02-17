<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class repositorioRequest extends FormRequest
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
            'autor' => 'required|string|min:3|max:255|regex:/^([a-zA-ZñÑáéíóúÁÉÍÓÚ-])+((\s*)+([a-zA-ZñÑáéíóúÁÉÍÓÚ-]*)*)+$/',
            'titulo' => 'required|string|max:50',
			'descripcion' => 'required|string|min:3|max:255|regex:/^([a-zA-ZñÑáéíóúÁÉÍÓÚ-])+((\s*)+([a-zA-ZñÑáéíóúÁÉÍÓÚ-]*)*)+$/',
			'fecha' => 'required|date|after:2000-01-01',
            'TipodeArchivo' => 'required|string|max:50',
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
            'autor' => 'required|string|min:3|max:255|regex:/^([a-zA-ZñÑáéíóúÁÉÍÓÚ-])+((\s*)+([a-zA-ZñÑáéíóúÁÉÍÓÚ-]*)*)+$/',
            'titulo' => 'required|string|max:50',
			'descripcion' => 'required|string|min:3|max:255|regex:/^([a-zA-ZñÑáéíóúÁÉÍÓÚ-])+((\s*)+([a-zA-ZñÑáéíóúÁÉÍÓÚ-]*)*)+$/',
			'fecha' => 'required|date|after:2000-01-01',
            'TipodeArchivo' => 'required|string|max:50',
        ];
    }

    public function messages(){
        return [
            'autor.*' => "Se requiere un autor",
            'titulo.*' => "Se requiere un titulo",
			'descripcion.min' => "Mínimo 3 caracteres",
			'descripcion.max' => "Máximo 255 caracteres",
			'descripcion.*' => 'Breve descripción del documento',
			'fecha.*' => 'Seleccione fecha del documento',
            'TipodeArchivo.*' => 'Seleccione tipo del documento',
        ];
    }
}