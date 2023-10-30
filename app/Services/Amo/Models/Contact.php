<?php

namespace App\Services\Amo\Models;

use Illuminate\Support\Arr;

class Contact
{
    private int $id;

    private string $name;

    private array $customFields;

    public function __construct(array $data = null)
    {
        if (! is_null($data)) {
            $this->setup($data);
        }
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getCustomFields(): array
    {
        return $this->customFields;
    }

    public function setCustomFields(array $customFields): static
    {
        $this->customFields = $customFields;

        return $this;
    }

    public function hasCustomField(int $id): bool
    {
        $fields = array_filter($this->customFields, fn (array $field) => $field['id'] === $id);

        return ! empty($fields);
    }

    public function getCustomFieldValues(int $id): array
    {
        $fields = array_filter($this->customFields, fn (array $field) => $field['id'] === $id);
        $field = array_shift($fields);

        if (empty($field)) {
            return [];
        }

        return array_map(fn (array $f) => $f['value'], $field['values']);
    }

    public function toArray(): array
    {
        $data = [];

        if (isset($this->name)) {
            Arr::set($data, 'name', $this->name);
        }

        if (isset($this->customFields)) {
            Arr::set($data, 'custom_fields', $this->customFields);
        }

        return $data;
    }

    private function setup(array $data): void
    {
        $this->id = Arr::get($data, 'id');
        $this->name = Arr::get($data, 'name');
        $this->customFields = Arr::get($data, 'custom_fields');
    }
}
