<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use App\Models\Admin;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Laravel\Fortify\Contracts\LoginResponse;
// use Laravel\Fortify\Contracts\LogoutResponse;

use Laravel\Fortify\Fortify;

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        if (request()->is('admin/', 'admin/*')) {
            // dd('ssaasas','admin');
            Config::set([
                'fortify.guard' => 'admin',
                'fortify.prefix' => 'admin',
                'fortify.passwords' => 'admins',
                'fortify.username' => 'username',
            ]);
            // dd(config('fortify.username'));
        }

        $this->app->instance(LoginResponse::class, new class implements LoginResponse
        {
            public function toResponse($request)
            {
                $user = Auth::guard('admin')->user();
                if ($user instanceof Admin) {
                    // RouteServiceProvider::HOME = ''
                    return redirect()->intended(route('hall.index'));
                }
                return redirect()->intended(route('rooms'));
            }
        });

        //     if(request()->is('admin','admin/*') ){
        //         Config::set([
        //             'fortify.guard' => 'admin',
        //             'fortify.prefix' => 'admin',
        //             // 'fortify.passwords' => 'admins',
        //             'fortify.username' => 'username',
        //         ]);
        //     }

        //     $this->app->singleton(LoginResponse::class,function(){
        //         dd('ssdd');
        //         return new class implements LoginResponse{
        //             public function toResponse($request){
        //                 $user = $request::guard('admin')->user();
        //                 dd($user);
        //                 if($user instanceof Admin){
        //                     return redirect(route('hall.index'));
        //                 }
        //                 return redirect()->intended(route('rooms'));

        //             }
        //         };
        //     });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);

        Fortify::viewPrefix('auth.');
        RateLimiter::for('login', function (Request $request) {
            $throttleKey = Str::transliterate(Str::lower($request->input(Fortify::username())) . '|' . $request->ip());

            return Limit::perMinute(5)->by($throttleKey);
        });

        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });
    }
}
