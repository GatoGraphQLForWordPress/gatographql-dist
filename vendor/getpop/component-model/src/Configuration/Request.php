<?php

declare (strict_types=1);
namespace PoP\ComponentModel\Configuration;

use PoP\ComponentModel\Constants\Params;
use PoP\Root\App;
/** @internal */
class Request
{
    /**
     * @return string[]
     */
    public static function getActions() : array
    {
        /**
         * Watch out! Other plugins can implement the same URL param name!
         * Hence, make sure it's an array, to avoid bugs from conflicts.
         *
         * @see https://github.com/GatoGraphQL/GatoGraphQL/issues/2985
         */
        $actions = App::getRequest()->request->all()[Params::ACTIONS] ?? App::getRequest()->query->all()[Params::ACTIONS] ?? [];
        if (!\is_array($actions)) {
            return [$actions];
        }
        return $actions;
    }
    public static function getActionPath() : ?string
    {
        return \PoP\ComponentModel\Configuration\RequestHelpers::getStringOrNullRequestParamValue(App::request(Params::ACTION_PATH) ?? App::query(Params::ACTION_PATH));
    }
    /**
     * Indicates the version constraint for all fields/directives in the query
     */
    public static function getVersionConstraint() : ?string
    {
        return \PoP\ComponentModel\Configuration\RequestHelpers::getStringOrNullRequestParamValue(App::request(Params::VERSION_CONSTRAINT) ?? App::query(Params::VERSION_CONSTRAINT));
    }
    /**
     * Indicates the version constraints for specific fields in the schema
     *
     * @return string[]|null
     */
    public static function getVersionConstraintsForFields() : ?array
    {
        return \PoP\ComponentModel\Configuration\RequestHelpers::getArrayOrNullRequestParamValue(App::request(Params::VERSION_CONSTRAINT_FOR_FIELDS) ?? App::query(Params::VERSION_CONSTRAINT_FOR_FIELDS));
    }
    /**
     * Indicates the version constraints for specific directives in the schema
     *
     * @return string[]|null
     */
    public static function getVersionConstraintsForDirectives() : ?array
    {
        return \PoP\ComponentModel\Configuration\RequestHelpers::getArrayOrNullRequestParamValue(App::request(Params::VERSION_CONSTRAINT_FOR_DIRECTIVES) ?? App::query(Params::VERSION_CONSTRAINT_FOR_DIRECTIVES));
    }
    /**
     * @return string[]
     */
    public static function getExtraRoutes() : array
    {
        $extraRoutes = App::getRequest()->request->all()[Params::EXTRA_ROUTES] ?? App::getRequest()->query->all()[Params::EXTRA_ROUTES] ?? [];
        if (!\is_array($extraRoutes)) {
            return [$extraRoutes];
        }
        return $extraRoutes;
    }
    public static function getComponentFilter() : ?string
    {
        return \PoP\ComponentModel\Configuration\RequestHelpers::getStringOrNullRequestParamValue(App::request(Params::COMPONENTFILTER) ?? App::query(Params::COMPONENTFILTER));
    }
    /**
     * @return string[]
     */
    public static function getComponentPaths() : array
    {
        $componentPaths = App::getRequest()->request->all()[Params::COMPONENTPATHS] ?? App::getRequest()->query->all()[Params::COMPONENTPATHS] ?? [];
        if (!\is_array($componentPaths)) {
            return [$componentPaths];
        }
        return $componentPaths;
    }
}
