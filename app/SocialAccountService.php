<?php

namespace App;

use Laravel\Socialite\Contracts\User as ProviderUser;

class SocialAccountService
{
    public function createOrGetUser(ProviderUser $providerUser)
    {
        $account = SocialAccount::whereProvider('facebook')
            ->whereProviderUserId($providerUser->getId())
            ->first();

        if ($account) {
            return $account->user;
        } else {

            $account = new SocialAccount([
                'provider_user_id' => $providerUser->getId(),
                'provider' => 'facebook'
            ]);

            // $user = User::whereEmail($providerUser->getEmail())->first();
            $user = User::whereUsername($providerUser->getId())->first();

            if (!$user) {

                // $user = User::create([
                //     'email' => $providerUser->getEmail(),
                //     'username' => $providerUser->getId(),
                //     'first_name' => $providerUser->getName(),
                //     'image' => $providerUser->getAvatar()
                // ]);
                $user = new User();
                $user->username = $providerUser->getId();
                $user->email = $providerUser->getEmail();
                $user->first_name = $providerUser->getName();
                $user->image = $providerUser->getAvatar();
                $user->actived = 1; //is active
                // $user->level = 2; //member
                $user->save();
                //add role member default, id 3
                \App\UserRole::insert(['user_id' => $user->id, 'role_id' => 3]);
                //
            }

            $account->user()->associate($user);
            $account->save();

            return $user;

        }

    }
}