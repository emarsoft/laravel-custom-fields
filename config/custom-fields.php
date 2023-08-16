<?php

return [
    'form-name' => 'custom_fields',

    'tables' => [
        'fields' => 'custom_fields',
        'field-values' => 'custom_field_values',
    ],

    'models' => [
        'custom-field' => \Emarsoft\LaravelCustomFields\Models\CustomField::class,
        'custom-field-value' => \Emarsoft\LaravelCustomFields\Models\CustomFieldValue::class,
    ],

    /*
    | -------------------------------------------------------------------
    | Field Types
    | -------------------------------------------------------------------
    |
    | The list of all custom field types. You can register
    | your own custom field types here. Make sure to also
    | register the corresponding response type below.
    */
    'fields' => [
        'checkbox' => \Emarsoft\LaravelCustomFields\FieldTypes\CheckboxFieldType::class,
        'number' => \Emarsoft\LaravelCustomFields\FieldTypes\NumberFieldType::class,
        'radio' => \Emarsoft\LaravelCustomFields\FieldTypes\RadioFieldType::class,
        'select' => \Emarsoft\LaravelCustomFields\FieldTypes\SelectFieldType::class,
        'textarea' => \Emarsoft\LaravelCustomFields\FieldTypes\TextareaFieldType::class,
        'text' => \Emarsoft\LaravelCustomFields\FieldTypes\TextFieldType::class,
    ],

    /*
    | -------------------------------------------------------------------
    | Response Types
    | -------------------------------------------------------------------
    |
    | The list of all custom field response types. You can register
    | your own custom field responses here. Make sure to also
    | register the corresponding field type above.
    */
    'responses' => [
        'checkbox' => \Emarsoft\LaravelCustomFields\ResponseTypes\CheckboxResponseType::class,
        'number' => \Emarsoft\LaravelCustomFields\ResponseTypes\NumberResponseType::class,
        'radio' => \Emarsoft\LaravelCustomFields\ResponseTypes\RadioResponseType::class,
        'select' => \Emarsoft\LaravelCustomFields\ResponseTypes\SelectResponseType::class,
        'textarea' => \Emarsoft\LaravelCustomFields\ResponseTypes\TextareaResponseType::class,
        'text' => \Emarsoft\LaravelCustomFields\ResponseTypes\TextResponseType::class,
    ],

    /*
    | -------------------------------------------------------------------
    | Value Fields
    | -------------------------------------------------------------------
    |
    | The list of all value columns that can hold a response value on the
    | custom_field_responses table.
    */
    'value-fields' => [
        'value_int',
        'value_str',
        'value_text',
        'value_json',
    ],

];
