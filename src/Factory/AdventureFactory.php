<?php

namespace App\Factory;

use App\Entity\Adventure;
use App\Repository\AdventureRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<Adventure>
 *
 * @method        Adventure|Proxy create(array|callable $attributes = [])
 * @method static Adventure|Proxy createOne(array $attributes = [])
 * @method static Adventure|Proxy find(object|array|mixed $criteria)
 * @method static Adventure|Proxy findOrCreate(array $attributes)
 * @method static Adventure|Proxy first(string $sortedField = 'id')
 * @method static Adventure|Proxy last(string $sortedField = 'id')
 * @method static Adventure|Proxy random(array $attributes = [])
 * @method static Adventure|Proxy randomOrCreate(array $attributes = [])
 * @method static AdventureRepository|RepositoryProxy repository()
 * @method static Adventure[]|Proxy[] all()
 * @method static Adventure[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static Adventure[]|Proxy[] createSequence(iterable|callable $sequence)
 * @method static Adventure[]|Proxy[] findBy(array $attributes)
 * @method static Adventure[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static Adventure[]|Proxy[] randomSet(int $number, array $attributes = [])
 *
 * @phpstan-method        Proxy<Adventure> create(array|callable $attributes = [])
 * @phpstan-method static Proxy<Adventure> createOne(array $attributes = [])
 * @phpstan-method static Proxy<Adventure> find(object|array|mixed $criteria)
 * @phpstan-method static Proxy<Adventure> findOrCreate(array $attributes)
 * @phpstan-method static Proxy<Adventure> first(string $sortedField = 'id')
 * @phpstan-method static Proxy<Adventure> last(string $sortedField = 'id')
 * @phpstan-method static Proxy<Adventure> random(array $attributes = [])
 * @phpstan-method static Proxy<Adventure> randomOrCreate(array $attributes = [])
 * @phpstan-method static RepositoryProxy<Adventure> repository()
 * @phpstan-method static list<Proxy<Adventure>> all()
 * @phpstan-method static list<Proxy<Adventure>> createMany(int $number, array|callable $attributes = [])
 * @phpstan-method static list<Proxy<Adventure>> createSequence(iterable|callable $sequence)
 * @phpstan-method static list<Proxy<Adventure>> findBy(array $attributes)
 * @phpstan-method static list<Proxy<Adventure>> randomRange(int $min, int $max, array $attributes = [])
 * @phpstan-method static list<Proxy<Adventure>> randomSet(int $number, array $attributes = [])
 */
final class AdventureFactory extends ModelFactory
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
            'adventureSheet' => AdventureSheetFactory::new(),
            'book' => BookFactory::new(),
            'chapter' => ChapterFactory::new(),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(Adventure $adventure): void {})
        ;
    }

    protected static function getClass(): string
    {
        return Adventure::class;
    }
}
