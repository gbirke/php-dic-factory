# Factories and dependency injection containers in PHP

This repo contains examples on how to use dependency injection containers (DIC) inside a central factory that exposes one public method as the entry point of an application. The goals are:

* Instantiate each service only once
* Be as type-safe as possible
* Be as DRY as possible

Why use a factory instead of directly using a DIC? Because we want to have a  PHP class with a clear, stable, type-safe public interface.

## Different implementations

From my point of view, the implementations are an evolution in the tradeoffs around the goals and the length of the factory code.

### [`SharedObjectFactory`](Factories/SharedObjectFactory.php)
This is a factory that does not use a DIC and uses internal storage instead.

- *Advantages:*
    - Makes it very clear which objects are shared
    - No dependencies
    - Type violations are shown in the IDE
- *Disadvantage:*
    - Lots of repetition

### [`PimpleContainerFactory`](Factories/PimpleContainerFactory.php)
Here, the `getSharedObject` method from the `SharedObjectFactory` is replaced by instantiating each service in a [Pimple DI](https://pimple.symfony.com/) container.

- *Advantages:*
    - Factory methods are easy to read
    - Type violations are shown in the IDE
- *Disadvantages:*
    - Each service needs an additional creation function for Pimple
    - Introduction of string IDs could create subtle errors when you have typos. This could be mitigated by using `::class` names like in the SharedObjectFactory.

### [`PimpleWrapperFactory`](Factories/PimpleWrapperFactory.php)
This factory uses Pimple like in the examples of the Pimple documentation, where the Pimple creation functions use the container to get their dependencies instead of using the factory methods.

- *Advantages:*
    - Less private methods in the factory
    - No `$this` in creation functions, making them pure functions
    - Factory methods are easy to read
- *Disadvantages:*
    - Type violations will only be discovered at runtime
    - Introduction of string IDs could create subtle errors when you have typos.

### [`PhpDiFactory`](Factories/PhpDiFactory.php)
This factory uses the [PHP-DI](http://php-di.org/) library instead of Pimple, taking advantage of its "autowiring" capacities, where only configurable classes need a creation function.

- *Advantages:*
    - Fewer creation functions needed
    - No `$this` in creation functions, making them pure functions
    - Type hinting in the IDE for the `get` method of the container.
    - Factory methods are easy to read
- *Disadvantages:*
    - Type violations will only be discovered at runtime
