<?php

namespace Emarsoft\LaravelCustomFields\Models;

use Emarsoft\LaravelCustomFields\Collections\CustomFieldCollection;
use Emarsoft\LaravelCustomFields\FieldTypes\FieldType;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Support\Facades\App;

class CustomField extends Model
{
    protected $table = 'custom_fields';

    protected $fillable = ['model_id', 'model_type', 'title', 'description', 'type', 'options', 'default_value', 'required', 'sort_order', 'status'];

    public function model(): MorphTo
    {
        return $this->morphTo();
    }

    public function responses(): HasMany
    {
        return $this->hasMany(CustomFieldValue::class, 'field_id');
    }

    public function validationRules(): Attribute
    {
        return new Attribute(
            get: fn($value, $attributes) => $this->field_type->validationRules($attributes),
        );
    }

    public function validationAttributes(): Attribute
    {
        return new Attribute(
            get: fn($value, $attributes) => $this->field_type->validationAttributes(),
        );
    }

    public function validationMessages(): Attribute
    {
        return new Attribute(
            get: fn($value, $attributes) => $this->field_type->validationMessages(),
        );
    }

    public function fieldType(): Attribute
    {
        return Attribute::get(
            fn($value, array $attributes) => App::makeWith(FieldType::class, [
                'type' => $attributes['type'],
                'field' => $this,
            ]),
        );
    }

    public function newCollection(array $models = []): CustomFieldCollection
    {
        return new CustomFieldCollection($models);
    }
}
