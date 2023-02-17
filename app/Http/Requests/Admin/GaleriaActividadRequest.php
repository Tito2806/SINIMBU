<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;


class GaleriaActividadRequest extends FormRequest
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
            'categoriaImg' => 'required|string|max:250',
            'fecha' => 'required|',
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
            'categoriaImg' => 'required|string|max:250',
            'fecha' => 'required|after:today',
            'imagen' => 'required|',
        ];
    }

    public function messages(){
        return [
           
            'titulo.regex' => 'Solo letras en el titulo',
            'titulo.*' => 'Titulo requiere mínimo 3 caracteres y máximo 20',
            'fecha.*' => 'Seleccione una fecha',
            'fecha.after' => '1 fecha después de hoy',
            'descripcion.*' => 'Se requiere una breve descripción',
            'categoriaImg.*' => 'Categoria se requiere',
            'imagen.*' => 'Imagen se requiere',
        ];
    }
}