<?php

namespace Emarsoft\LaravelCustomFields\FieldTypes;

use Illuminate\Validation\Rule;

class RadioFieldType extends FieldType
{
    public function validationRules(array $attributes): array
    {
        return [
            $this->validationPrefix . $this->field->id => [
                $this->requiredRule($attributes['required']),
                'string',
                'max:255',
                Rule::in($this->field->options),
            ],
        ];
    }
}
