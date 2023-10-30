<?php

namespace App\Services\Amo\Models;

use Illuminate\Support\Arr;

class Lead
{
    private int $id;

    private string $name;

    private int|float $price;

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

    public function getPrice(): float|int
    {
        return $this->price;
    }

    public function setPrice(float|int $price): static
    {
        $this->price = $price;

        return $this;
    }

    public function toArray(): array
    {
        $data = [];

        if (isset($this->name)) {
            Arr::set($data, 'name', $this->name);
        }

        if (isset($this->price)) {
            Arr::set($data, 'sale', $this->price);
        }

        return $data;
    }

    private function setup(array $data): void
    {
        $this->id = Arr::get($data, 'id');
        $this->name = Arr::get($data, 'name');
        $this->price = Arr::get($data, 'sale');
    }
}
