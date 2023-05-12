<?php

namespace App\Factory;

use App\Entity\AdventureSheet;
use App\Repository\AdventureSheetRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<AdventureSheet>
 *
 * @method        AdventureSheet|Proxy create(array|callable $attributes = [])
 * @method static AdventureSheet|Proxy createOne(array $attributes = [])
 * @method static AdventureSheet|Proxy find(object|array|mixed $criteria)
 * @method static AdventureSheet|Proxy findOrCreate(array $attributes)
 * @method static AdventureSheet|Proxy first(string $sortedField = 'id')
 * @method static AdventureSheet|Proxy last(string $sortedField = 'id')
 * @method static AdventureSheet|Proxy random(array $attributes = [])
 * @method static AdventureSheet|Proxy randomOrCreate(array $attributes = [])
 * @method static AdventureSheetRepository|RepositoryProxy repository()
 * @method static AdventureSheet[]|Proxy[] all()
 * @method static AdventureSheet[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static AdventureSheet[]|Proxy[] createSequence(iterable|callable $sequence)
 * @method static AdventureSheet[]|Proxy[] findBy(array $attributes)
 * @method static AdventureSheet[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static AdventureSheet[]|Proxy[] randomSet(int $number, array $attributes = [])
 */
final class AdventureSheetFactory extends ModelFactory
{
    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#factories-as-services
     *
     * @todo inject services if required
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories
     *
     * @todo add your default values here
     */
    protected function getDefaults(): array
    {
        return [
            'luck' => self::faker()->numberBetween(1, 12),
            'skill' => self::faker()->randomNumber(1,12),
            'stamina' => self::faker()->randomNumber(2, 24),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(AdventureSheet $adventureSheet): void {})
        ;
    }

    protected static function getClass(): string
    {
        return AdventureSheet::class;
    }
}
