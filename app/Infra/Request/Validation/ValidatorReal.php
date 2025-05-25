<?php

namespace App\Infra\Request\Validation;

use App\Infra\Request\Validation\Exceptions\InvalidArrayDataException;
use App\Infra\Request\Validation\Exceptions\InvalidRequestDataException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\MessageBag;

class ValidatorReal
{
    public function validateRequest(Request $request, array $rules): void
    {
        $validate = Validator::make($request->all(), $rules, $this->rulesMessages());
        $validate->setAttributeNames($this->attributeNames());
        if ($validate->fails()) {
            throw new InvalidRequestDataException($this->formatErrors($validate->errors()));
        }
    }

    public function validateArrayData(array $array, array $rules): void
    {
        $validate = Validator::make($array, $rules, $this->rulesMessages());
        $validate->setAttributeNames($this->attributeNames());
        if ($validate->fails()) {
            throw new InvalidArrayDataException($this->formatErrors($validate->errors()));
        }
    }

    protected function rulesMessages(): array
    {
        return [
            'required' => 'O :attribute é obrigatório!',
            'unique' => 'O :attribute já existe!',
            'max' => 'O :attribute não pode ser maior que :max caracteres!',
            'min' => 'O :attribute não pode ser menor que :min caracteres!',
            'int' => 'O :attribute deve ser do tipo int!',
            'integer' => 'O :attribute deve ser do tipo inteiro!',
            'string' => 'O :attribute deve ser do tipo string!',
            'decimal' => 'O :attribute deve ser do tipo decimal com o mínimo de 0 casa e máximos de 2 casas!',
            'exists' => 'O :attribute não existe!',
            'email' => 'O :attribute deve ser um email válido!',
            'boolean' => 'O :attribute deve ser um valor válido!',
            'date_format' => 'A :attribute deve ser uma data no formato Y-m-d!',
            'date' => 'A :attribute deve ser uma data no formato Y-m-d!',
            'before_or_equal' => 'O :attribute deve ser uma data anterior ou igual ao dia atual!',
            'after_or_equal' => 'O :attribute deve ser uma data posterior ou igual ao dia atual!',
            'numeric' => 'O :attribute deve ser um valor numérico!',
            'required_if' => 'O :attribute é obrigatório quando :other for igual a :value!',
            'array' => 'O :attribute deve ser um array!',
            'in' => 'O :attribute deve ser um dos seguintes: :values',
            'mimes' => 'O :attribute deve ser um dos seguintes: :values',
            'uploaded' => 'O :attribute não foi enviado!',
            'json' => 'O :attribute deve ser um json valido!',
            'required_unless' => 'O :attribute é obrigatório quando :other for diferente de :values!',
        ];
    }

    protected function attributeNames(): array
    {
        return [
            'userId' => 'Usuário',
        ];
    }

    protected function formatErrors(MessageBag $errors): string
    {
        $translatedErrors = [];
        $attributes = $this->attributeNames();

        foreach ($errors->toArray() as $field => $messages) {
            $translatedKey = $attributes[$field] ?? ucfirst(str_replace('_', ' ', $field));
            $translatedErrors[$translatedKey] = $messages;
        }

        return json_encode($translatedErrors, JSON_UNESCAPED_UNICODE);
    }
}
