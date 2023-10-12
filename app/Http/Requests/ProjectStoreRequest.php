<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProjectStoreRequest extends FormRequest
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
            "title" => "required|string|max:255",
            "description" => "required|string",
            "thumbnail" => "required|image|max:10240",
            "link" => "required|string|max:255",
            "date" => "required|date",
            //exists: si assicura che l'id passato esista nella tabella types nella colonna id
            "type_id" => "required|exists:types,id",
            "technologies" => "required",
        ];
    }
    public function messages()
    {
        return [
            "title.required" => "Il campo del titolo è obbligatorio.",
            "title.max" => "Lunghezza massima superata.",
            "description.required" => "Il campo della descrizione è obbligatorio.",
            "thumbnail.required" => "Il campo della miniatura è obbligatoria.",
            "thumbnail.max" => "Dimensioni del file eccessive",
            "link.required" => "Il campo del link è obbligatorio.",
            "link.max" => "Lunghezza massima superata.",
            "date.required" => "Il campo della data è obbligatorio.",
            "type_id.exists" => "Il campo della tipologia è obbligatorio.",
            "technologies.required" => "Scegli almeno un linguaggio",
        ];
    }
}
