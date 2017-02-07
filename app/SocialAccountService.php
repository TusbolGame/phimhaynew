<?php

namespace App;

use Laravel\Socialite\Contracts\User as ProviderUser;

use App\FilmUserDiff;
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

            $user = User::whereEmail($providerUser->getEmail())->first();

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
                $user->level = 2; //member
                $user->save();
                //create film user diff
                $film_user_diff = new FilmUserDiff();
                $film_user_diff->id = $user->id;
                $film_user_diff->save();
            }

            $account->user()->associate($user);
            $account->save();

            return $user;

        }

    }
}