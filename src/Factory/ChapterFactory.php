<?php

namespace App\Factory;

use App\Entity\Chapter;
use App\Repository\ChapterRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<Chapter>
 *
 * @method        Chapter|Proxy create(array|callable $attributes = [])
 * @method static Chapter|Proxy createOne(array $attributes = [])
 * @method static Chapter|Proxy find(object|array|mixed $criteria)
 * @method static Chapter|Proxy findOrCreate(array $attributes)
 * @method static Chapter|Proxy first(string $sortedField = 'id')
 * @method static Chapter|Proxy last(string $sortedField = 'id')
 * @method static Chapter|Proxy random(array $attributes = [])
 * @method static Chapter|Proxy randomOrCreate(array $attributes = [])
 * @method static ChapterRepository|RepositoryProxy repository()
 * @method static Chapter[]|Proxy[] all()
 * @method static Chapter[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static Chapter[]|Proxy[] createSequence(iterable|callable $sequence)
 * @method static Chapter[]|Proxy[] findBy(array $attributes)
 * @method static Chapter[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static Chapter[]|Proxy[] randomSet(int $number, array $attributes = [])
 *
 * @phpstan-method        Proxy<Chapter> create(array|callable $attributes = [])
 * @phpstan-method static Proxy<Chapter> createOne(array $attributes = [])
 * @phpstan-method static Proxy<Chapter> find(object|array|mixed $criteria)
 * @phpstan-method static Proxy<Chapter> findOrCreate(array $attributes)
 * @phpstan-method static Proxy<Chapter> first(string $sortedField = 'id')
 * @phpstan-method static Proxy<Chapter> last(string $sortedField = 'id')
 * @phpstan-method static Proxy<Chapter> random(array $attributes = [])
 * @phpstan-method static Proxy<Chapter> randomOrCreate(array $attributes = [])
 * @phpstan-method static RepositoryProxy<Chapter> repository()
 * @phpstan-method static list<Proxy<Chapter>> all()
 * @phpstan-method static list<Proxy<Chapter>> createMany(int $number, array|callable $attributes = [])
 * @phpstan-method static list<Proxy<Chapter>> createSequence(iterable|callable $sequence)
 * @phpstan-method static list<Proxy<Chapter>> findBy(array $attributes)
 * @phpstan-method static list<Proxy<Chapter>> randomRange(int $min, int $max, array $attributes = [])
 * @phpstan-method static list<Proxy<Chapter>> randomSet(int $number, array $attributes = [])
 */
final class ChapterFactory extends ModelFactory
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
            'content' => self::faker()->text(),
            'number' => self::faker()->randomNumber(),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(Chapter $chapter): void {})
        ;
    }

    protected static function getClass(): string
    {
        return Chapter::class;
    }
}
