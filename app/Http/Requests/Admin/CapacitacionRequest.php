<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CapacitacionRequest extends FormRequest
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
            
            'nombre' => 'required|string|min:3|max:40|regex:/^([a-zA-ZñÑáéíóúÁÉÍÓ-])+((\s*)+([a-zA-ZñÑáéíóúÁÉÍÓÚ-]*)*)+$/',
            'modalidad' => 'required|string|min:3|max:40|regex:/^([a-zA-ZñÑáéíóúÁÉÍÓ-])+((\s*)+([a-zA-ZñÑáéíóúÁÉÍÓÚ-]*)*)+$/',
            'tema' => 'required|string|min:3|max:40|regex:/^([a-zA-ZñÑáéíóúÁÉÍÓ-])+((\s*)+([a-zA-ZñÑáéíóúÁÉÍÓÚ-]*)*)+$/',
            'horario' => 'required|after:today',
            'hora' => 'required|',
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
           
            'nombre' => 'required|string|min:3|max:40|regex:/^([a-zA-ZñÑáéíóúÁÉÍÓ-])+((\s*)+([a-zA-ZñÑáéíóúÁÉÍÓÚ-]*)*)+$/',
            'modalidad' => 'required|string|min:3|max:40|regex:/^([a-zA-ZñÑáéíóúÁÉÍÓ-])+((\s*)+([a-zA-ZñÑáéíóúÁÉÍÓÚ-]*)*)+$/',
            'tema' => 'required|string|min:3|max:40|regex:/^([a-zA-ZñÑáéíóúÁÉÍÓ-])+((\s*)+([a-zA-ZñÑáéíóúÁÉÍÓÚ-]*)*)+$/',
            'horario' => 'required|after:today',
            'hora' => 'required|',
        ];
    }

    public function messages(){
        return [
           
            'nombre.regex' => 'Solo letras en el nombre',
            'nombre.*' => 'Nombre requiere mínimo 3 caracteres y máximo 20',
            'modalidad.*' => 'Seleccione una modalidad',
            'tema.*' => 'Seleccione un tema',
            'horario.*' => 'Seleccione una fecha',
            'horario.after' => '1 fecha después de hoy',
            'hora.*' => 'Seleccione una hora',
        ];
    }
}