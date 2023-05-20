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
 *
 * @phpstan-method        Proxy<AdventureSheet> create(array|callable $attributes = [])
 * @phpstan-method static Proxy<AdventureSheet> createOne(array $attributes = [])
 * @phpstan-method static Proxy<AdventureSheet> find(object|array|mixed $criteria)
 * @phpstan-method static Proxy<AdventureSheet> findOrCreate(array $attributes)
 * @phpstan-method static Proxy<AdventureSheet> first(string $sortedField = 'id')
 * @phpstan-method static Proxy<AdventureSheet> last(string $sortedField = 'id')
 * @phpstan-method static Proxy<AdventureSheet> random(array $attributes = [])
 * @phpstan-method static Proxy<AdventureSheet> randomOrCreate(array $attributes = [])
 * @phpstan-method static RepositoryProxy<AdventureSheet> repository()
 * @phpstan-method static list<Proxy<AdventureSheet>> all()
 * @phpstan-method static list<Proxy<AdventureSheet>> createMany(int $number, array|callable $attributes = [])
 * @phpstan-method static list<Proxy<AdventureSheet>> createSequence(iterable|callable $sequence)
 * @phpstan-method static list<Proxy<AdventureSheet>> findBy(array $attributes)
 * @phpstan-method static list<Proxy<AdventureSheet>> randomRange(int $min, int $max, array $attributes = [])
 * @phpstan-method static list<Proxy<AdventureSheet>> randomSet(int $number, array $attributes = [])
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
            'skill' => self::faker()->numberBetween(1,12),
            'stamina' => self::faker()->numberBetween(2, 24),
            'initialLuck' => self::faker()->numberBetween(1, 12),
            'initialSkill' => self::faker()->numberBetween(1,12),
            'initialStamina' => self::faker()->numberBetween(2, 24),
            'inventory' => ['épée', 'talisman']
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
