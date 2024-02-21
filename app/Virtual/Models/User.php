<?php

namespace App\Virtual;
/**
 * @OA\Schema(
 *     title="User",
 *     description="User model",
 *     @OA\Xml(
 *         name="User"
 *     )
 * )
 */
class User
{
    /**
     * @OA\Property(
     *     title="ID",
     *     description="ID of the user",
     *     format="int64",
     *     example=1
     * )
     *
     * @var integer
     */
    public $id;

    /**
     * @OA\Property(
     *     title="Avatar",
     *     description="URL to the user's avatar",
     *     format="uri",
     *     example="https://example.com/avatar.jpg"
     * )
     *
     * @var string
     */
    public $avatar;

    /**
     * @OA\Property(
     *     title="Address",
     *     description="User's address",
     *     example="123 Main Street, City, Country"
     * )
     *
     * @var string
     */
    public $address;

    /**
     * @OA\Property(
     *     title="Age",
     *     description="User's age",
     *     format="int32",
     *     example=25
     * )
     *
     * @var integer
     */
    public $age;

    /**
     * @OA\Property(
     *     title="Phone",
     *     description="User's phone number",
     *     example="+1234567890"
     * )
     *
     * @var string
     */
    public $phone;

    /**
     * @OA\Property(
     *     title="Gender",
     *     description="User's gender",
     *     example="male"
     * )
     *
     * @var string
     */
    public $gender;

    /**
     * @OA\Property(
     *     title="Name",
     *     description="User's full name",
     *     example="John Doe"
     * )
     *
     * @var string
     */
    public $name;

    /**
     * @OA\Property(
     *     title="Username",
     *     description="User's username",
     *     example="johndoe"
     * )
     *
     * @var string
     */
    public $username;

    /**
     * @OA\Property(
     *     title="Email",
     *     description="User's email address",
     *     format="email",
     *     example="user@example.com"
     * )
     *
     * @var string
     */
    public $email;

    /**
     * @OA\Property(
     *     title="Email Verified At",
     *     description="Date and time when the user's email was verified",
     *     format="datetime",
     *     example="2022-01-01T12:00:00Z"
     * )
     *
     * @var string
     */
    public $email_verified_at;

//    /**
//     * @OA\Property(
//     *     title="Password",
//     *     description="User's password (hashed)",
//     *     example="********"
//     * )
//     *
//     * @var string
//     */
//    public $password;

    /**
     * @OA\Property(
     *     title="Roles",
     *     description="Role User",
     *     example="admin"
     * )
     *
     * @var string
     */
    public $roles;

    /**
     * @OA\Property(
     *     title="Remember Token",
     *     description="Remember token for the user",
     *     example="random_token"
     * )
     *
     * @var string
     */
    public $remember_token;

    /**
     * @OA\Property(
     *     title="Created At",
     *     description="Date and time when the user was created",
     *     format="datetime",
     *     example="2022-01-01T12:00:00Z"
     * )
     *
     * @var string
     */
    public $created_at;

    /**
     * @OA\Property(
     *     title="Updated At",
     *     description="Date and time when the user was last updated",
     *     format="datetime",
     *     example="2022-01-01T12:00:00Z"
     * )
     *
     * @var string
     */
    public $updated_at;
}
