<?php

namespace Emarsoft\LaravelCustomFields\Models;

use Emarsoft\LaravelCustomFields\ResponseTypes\ResponseType;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Support\Facades\App;

class CustomFieldValue extends Model
{
    protected $table = 'custom_field_values';

    protected $fillable = ['field_id', 'model_type', 'value_str', 'value_text', 'value_int', 'value_json'];

    public function model(): MorphTo
    {
        return $this->morphTo();
    }

    public function field(): BelongsTo
    {
        return $this->belongsTo(CustomField::class, 'field_id');
    }

    public function scopeHasValue(Builder $query, mixed $value): Builder
    {
        return $query->where(function (Builder $query) use ($value) {
            array_map(
                fn(string $field) => $query->orWhere($field, $value),
                config('custom-fields.value-fields'),
            );
        });
    }

    public function formatValue(mixed $value): mixed
    {
        return $this->response_type->formatValue($value);
    }

    public function getValueAttribute(): mixed
    {
        return $this->response_type->getValue();
    }

    public function setValueAttribute(mixed $value): void
    {
        $this->response_type->setValue($value);
    }

    public function getValueFriendlyAttribute(): mixed
    {
        return $this->response_type->getValueFriendly();
    }

    public function responseType(): Attribute
    {
        return Attribute::get(
            fn(mixed $value, array $attributes) => App::makeWith(ResponseType::class, [
                'type' => $this->field->type,
                'response' => $this,
            ]),
        );
    }
}
