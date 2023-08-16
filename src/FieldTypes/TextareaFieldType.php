<?php

namespace Emarsoft\LaravelCustomFields\FieldTypes;

class TextareaFieldType extends FieldType
{
    public function validationRules(array $attributes): array
    {
        return [
            $this->validationPrefix . $this->field->id => [
                $this->requiredRule($attributes['required']),
                'string',
            ],
        ];
    }
}
