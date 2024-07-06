<?php

namespace App\Filament\Resources\HeroResource\Pages;

use App\Filament\Resources\HeroResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use App\Models\Hero;

class CreateHero extends CreateRecord
{
    protected static string $resource = HeroResource::class;

    //add redirect
    public function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    //customize record creation
    protected function handleRecordCreation(array $data): Hero
    {
        $hero =  static::getModel()::create($data);
        // update other hero records to inactive if new hero is active
        if ($hero->is_active) {
            Hero::where('id', '!=', $hero->id)->update(['is_active' => 0]);
        }
        return $hero;
    }
}
