<?php

namespace App\Repositories\auth;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\User;

/**
 * Class UserRepository
 *
 * @package App\Repositories\adminservice
 */
class UserRepository
{
    /**
     * Create User
     *
     * @param array $attributes
     */
    public function create(array $attributes)
    {
        try {
            DB::beginTransaction();

            /** @var User $user */
            $user = User::create([
                'name' => $attributes['name'],
                'email' => $attributes['email'],
                'password' => Hash::make($attributes['password']),
            ]);

            DB::commit();
            return $user;
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error($e);
            throw $e;
        }
    }

}
