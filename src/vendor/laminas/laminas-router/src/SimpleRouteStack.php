<?php

declare(strict_types=1);

namespace Laminas\Router;

use Laminas\ServiceManager\ServiceManager;
use Laminas\Stdlib\ArrayUtils;
use Laminas\Stdlib\RequestInterface as Request;
use Traversable;

use function array_merge;
use function is_array;
use function sprintf;

/**
 * Simple route stack implementation.
 *
 * @template TRoute of RouteInterface
 * @template-implements RouteStackInterface<TRoute>
 */
class SimpleRouteStack implements RouteStackInterface
{
    /**
     * Stack containing all routes.
     *
     * @var PriorityList<string, TRoute>
     */
    protected $routes;

    /**
     * Route plugin manager
     *
     * @var RoutePluginManager<TRoute>
     */
    protected $routePluginManager;

    /**
     * Default parameters.
     *
     * @var array
     */
    protected $defaultParams = [];

    /**
     * @param RoutePluginManager<TRoute>|null $routePluginManager
     */
    public function __construct(?RoutePluginManager $routePluginManager = null)
    {
        /** @var PriorityList<string, TRoute> $this->routes */
        $this->routes = new PriorityList();
        /** @var RoutePluginManager<TRoute> $this->routePluginManager */
        $this->routePluginManager = $routePluginManager ?? new RoutePluginManager(new ServiceManager());

        $this->init();
    }

    /**
     * factory(): defined by RouteInterface interface.
     *
     * @see    \Laminas\Router\RouteInterface::factory()
     *
     * @param  iterable $options
     * @return SimpleRouteStack
     * @throws Exception\InvalidArgumentException
     */
    public static function factory($options = [])
    {
        if ($options instanceof Traversable) {
            $options = ArrayUtils::iteratorToArray($options);
        } elseif (! is_array($options)) {
            throw new Exception\InvalidArgumentException(sprintf(
                '%s expects an array or Traversable set of options',
                __METHOD__
            ));
        }

        $routePluginManager = null;
        if (isset($options['route_plugins'])) {
            $routePluginManager = $options['route_plugins'];
        }

        $instance = new static($routePluginManager);

        if (isset($options['routes'])) {
            $instance->addRoutes($options['routes']);
        }

        if (isset($options['default_params'])) {
            $instance->setDefaultParams($options['default_params']);
        }

        return $instance;
    }

    /**
     * Init method for extending classes.
     *
     * @return void
     */
    protected function init()
    {
    }

    /**
     * @param RoutePluginManager<TRoute> $routePlugins
     * @return $this
     */
    public function setRoutePluginManager(RoutePluginManager $routePlugins)
    {
        $this->routePluginManager = $routePlugins;
        return $this;
    }

    /**
     * Get the route plugin manager.
     *
     * @return RoutePluginManager<TRoute>
     */
    public function getRoutePluginManager()
    {
        return $this->routePluginManager;
    }

    /** @inheritDoc */
    public function addRoutes($routes)
    {
        if (! is_array($routes) && ! $routes instanceof Traversable) {
            throw new Exception\InvalidArgumentException('addRoutes expects an array or Traversable set of routes');
        }

        foreach ($routes as $name => $route) {
            $this->addRoute($name, $route);
        }

        return $this;
    }

    /** @inheritDoc */
    public function addRoute($name, $route, $priority = null)
    {
        if (! $route instanceof RouteInterface) {
            $route = $this->routeFromArray($route);
        }

        if ($priority === null && isset($route->priority)) {
            $priority = $route->priority;
        }

        $this->routes->insert($name, $route, $priority);

        return $this;
    }

    /** @inheritDoc */
    public function removeRoute($name)
    {
        $this->routes->remove($name);
        return $this;
    }

    /** @inheritDoc */
    public function setRoutes($routes)
    {
        $this->routes->clear();
        $this->addRoutes($routes);
        return $this;
    }

    /**
     * Get the added routes
     *
     * @return Traversable list of all routes
     */
    public function getRoutes()
    {
        return $this->routes;
    }

    /**
     * Check if a route with a specific name exists
     *
     * @param  string $name
     * @return bool true if route exists
     */
    public function hasRoute($name)
    {
        return $this->routes->get($name) !== null;
    }

    /**
     * Get a route by name
     *
     * @param string $name
     * @return TRoute|null the route
     */
    public function getRoute($name)
    {
        return $this->routes->get($name);
    }

    /**
     * Set a default parameters.
     *
     * @param  array $params
     * @return SimpleRouteStack
     */
    public function setDefaultParams(array $params)
    {
        $this->defaultParams = $params;
        return $this;
    }

    /**
     * Set a default parameter.
     *
     * @param  string $name
     * @param  mixed  $value
     * @return SimpleRouteStack
     */
    public function setDefaultParam($name, $value)
    {
        $this->defaultParams[$name] = $value;
        return $this;
    }

    /**
     * Create a route from array specifications.
     *
     * @param  iterable $specs
     * @return TRoute
     * @throws Exception\InvalidArgumentException
     */
    protected function routeFromArray($specs)
    {
        if ($specs instanceof Traversable) {
            $specs = ArrayUtils::iteratorToArray($specs);
        }

        if (! is_array($specs)) {
            throw new Exception\InvalidArgumentException('Route definition must be an array or Traversable object');
        }

        if (! isset($specs['type'])) {
            throw new Exception\InvalidArgumentException('Missing "type" option');
        }

        if (! isset($specs['options'])) {
            $specs['options'] = [];
        }

        $route = $this->getRoutePluginManager()->get($specs['type'], $specs['options']);

        if (isset($specs['priority'])) {
            $route->priority = $specs['priority'];
        }

        return $route;
    }

    /**
     * match(): defined by RouteInterface interface.
     *
     * @see    \Laminas\Router\RouteInterface::match()
     *
     * @return RouteMatch|null
     */
    public function match(Request $request)
    {
        foreach ($this->routes as $name => $route) {
            if (($match = $route->match($request)) instanceof RouteMatch) {
                $match->setMatchedRouteName($name);

                foreach ($this->defaultParams as $paramName => $value) {
                    if ($match->getParam($paramName) === null) {
                        $match->setParam($paramName, $value);
                    }
                }

                return $match;
            }
        }

        return null;
    }

    /**
     * assemble(): defined by RouteInterface interface.
     *
     * @see    \Laminas\Router\RouteInterface::assemble()
     *
     * @param  array $params
     * @param  array $options
     * @return mixed
     * @throws Exception\InvalidArgumentException
     * @throws Exception\RuntimeException
     */
    public function assemble(array $params = [], array $options = [])
    {
        if (! isset($options['name'])) {
            throw new Exception\InvalidArgumentException('Missing "name" option');
        }

        $route = $this->routes->get($options['name']);

        if (! $route) {
            throw new Exception\RuntimeException(sprintf('Route with name "%s" not found', $options['name']));
        }

        unset($options['name']);

        return $route->assemble(array_merge($this->defaultParams, $params), $options);
    }
}