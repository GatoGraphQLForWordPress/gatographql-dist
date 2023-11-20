<?php

declare (strict_types=1);
namespace PoPCMSSchema\Users\TypeAPIs;

/**
 * Methods to interact with the Type, to be implemented by the underlying CMS
 * @internal
 */
interface UserTypeAPIInterface
{
    /**
     * Indicates if the passed object is of type User
     */
    public function isInstanceOfUserType(object $object) : bool;
    /**
     * @param string|int $userID
     */
    public function getUserByID($userID) : ?object;
    public function getUserByEmail(string $email) : ?object;
    public function getUserByLogin(string $login) : ?object;
    /**
     * @return array<string|int>|object[]
     * @param array<string,mixed> $query
     * @param array<string,mixed> $options
     */
    public function getUsers(array $query, array $options = []) : array;
    /**
     * @param array<string,mixed> $query
     * @param array<string,mixed> $options
     */
    public function getUserCount(array $query, array $options = []) : int;
    /**
     * @param string|int|object $userObjectOrID
     */
    public function getUserDisplayName($userObjectOrID) : ?string;
    /**
     * @param string|int|object $userObjectOrID
     */
    public function getUserEmail($userObjectOrID) : ?string;
    /**
     * @param string|int|object $userObjectOrID
     */
    public function getUserFirstname($userObjectOrID) : ?string;
    /**
     * @param string|int|object $userObjectOrID
     */
    public function getUserLastname($userObjectOrID) : ?string;
    /**
     * @param string|int|object $userObjectOrID
     */
    public function getUserLogin($userObjectOrID) : ?string;
    /**
     * @param string|int|object $userObjectOrID
     */
    public function getUserDescription($userObjectOrID) : ?string;
    /**
     * @param string|int|object $userObjectOrID
     */
    public function getUserURL($userObjectOrID) : ?string;
    /**
     * @param string|int|object $userObjectOrID
     */
    public function getUserURLPath($userObjectOrID) : ?string;
    /**
     * @param string|int|object $userObjectOrID
     */
    public function getUserWebsiteURL($userObjectOrID) : ?string;
    /**
     * @param string|int|object $userObjectOrID
     */
    public function getUserSlug($userObjectOrID) : ?string;
    /**
     * @return string|int
     */
    public function getUserID(object $user);
}
