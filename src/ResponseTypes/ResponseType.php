<?php

namespace Emarsoft\LaravelCustomFields\ResponseTypes;

use Emarsoft\LaravelCustomFields\Models\CustomFieldValue;

abstract class ResponseType
{
    const VALUE_FIELD = 'value_str';

    public function __construct(protected CustomFieldValue $response)
    {
        //
    }

    public function formatValue(mixed $value): mixed
    {
        return $value;
    }

    public function getValue(): mixed
    {
        return $this->formatValue($this->response->getAttribute($this::VALUE_FIELD));
    }

    public function getValueFriendly(): mixed
    {
        return $this->response->value;
    }

    public function setValue(mixed $value): void
    {
        $this->clearValues();
        $this->response->{$this::VALUE_FIELD} = $this->formatValue($value);
    }

    protected function clearValues(): void
    {
        $attributes = $this->response->getAttributes();

        foreach (config('custom-fields.value-fields') as $valueField) {
            $attributes[$valueField] = null;
        }

        unset($attributes['value']);

        $this->response->setRawAttributes($attributes);
    }
}
