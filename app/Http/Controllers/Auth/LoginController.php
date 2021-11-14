<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;
use Hash;

use App\User;
use Socialite;
use Illuminate\Support\Facades\Config;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    public function redirectToProviderFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }



    public function handleProviderCallbackFacebook()
    {
            try {
    
                $user = Socialite::driver('facebook')->stateless()
                    ->setHttpClient(new \GuzzleHttp\Client(['verify' => false]))       
                    ->user();
             
                $finduser = User::where('facebook_id', $user->id)->first();
         
                if($finduser){
                    Auth::login($finduser);
                    return redirect('/home');
        
                }else{
                    $newUser = User::create([
                        'nom_prenom' => $user->name,
                        'email' => $user->email,
                        'facebook_id'=> $user->id,
                        'password' => Hash::make('12345678')
                    ]);

                    Auth::login($newUser);
                    return redirect('/home');
                }
        
            } catch (Exception $e) {
                dd($e->getMessage());
            }

    }        
    public function redirectToProvider()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleProviderCallback()
    {
            try {
    
                $user = Socialite::driver('google')->stateless()
                    ->setHttpClient(new \GuzzleHttp\Client(['verify' => false]))       
                    ->user();
             
                $finduser = User::where('google_id', $user->id)->first();
         
                if($finduser){
                    Auth::login($finduser);
                    return redirect('/dashboard');
        
                }else{
                    $newUser = User::create([
                        'nom_prenom' => $user->name,
                        'email' => $user->email,
                        'google_id'=> $user->id,
                        'password' => Hash::make('12345678')
                    ]);

                    Auth::login($newUser);
                    return redirect('/dashboard');
                }
        
            } catch (Exception $e) {
                dd($e->getMessage());
            }

    }    

    use AuthenticatesUsers;
    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('guest:admin')->except('logout');
        $this->middleware('guest:livreur')->except('logout');
        $this->middleware('guest:freelancer')->except('logout');
        $this->middleware('guest:boutique')->except('logout');
        $this->middleware('guest:fournisseur')->except('logout');
        $this->middleware('guest:operateur')->except('logout');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showAdminLoginForm()
    {
        return view('auth.login', [
            'url' => 'admin'
        ]);
    }



    public function showOperateurLoginForm()
    {
        return view('auth.login', [
            'url' => Config::get('constants.guards.operateur')
        ]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showLivreurLoginForm()
    {
        return view('auth.login', [
            'url' => Config::get('constants.guards.livreur')
        ]);
    }

    public function showFournisseurLoginForm()
    {
        return view('auth.login', [
            'url' => Config::get('constants.guards.fournisseur')
        ]);
    }


    public function showFreelancerLoginForm()
    {
        return view('auth.login', [
            'url' => Config::get('constants.guards.freelancer')
        ]);
    }

    public function showBoutiqueLoginForm()
    {
        return view('auth.login', [
            'url' => Config::get('constants.guards.boutique')
        ]);
    }

    /**
     * @param Request $request
     * @return array
     */
    protected function validator(Request $request)
    {
        return $this->validate($request, [
            'email'   => 'required',
            'password' => 'required'
        ]);
    }

    /**
     * @param Request $request
     * @param $guard
     * @return bool
     */
    protected function guardLogin(Request $request, $guard)
    {
        $this->validator($request);
        return Auth::guard($guard)->attempt(
            [
                'email' => $request->email,
                'password' => $request->password
            ],
            $request->get('remember')
        );
    }

    public function adminLogin(Request $request)
    {
        if ($this->guardLogin($request, 'admin')) {
            return redirect()->intended('/home');
        }
        return back()->withInput($request->only('email', 'remember'));
    }


    public function operateurLogin(Request $request)
    {
        if ($this->guardLogin($request, Config::get('constants.guards.operateur'))) {
            return redirect()->intended('/home');
        }
        return back()->withInput($request->only('email', 'remember'));
    }


    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function livreurLogin(Request $request)
    {
        if ($this->guardLogin($request,Config::get('constants.guards.livreur'))) {
            return redirect()->intended('/home');
        }

        return back()->withInput($request->only('email', 'remember'));
    }

    public function fournisseurLogin(Request $request)
    {
        if ($this->guardLogin($request,Config::get('constants.guards.fournisseur'))) {
            return redirect()->intended('/home');
        }
        return back()->withInput($request->only('email', 'remember'));
    }


    public function freelancerLogin(Request $request)
    {
        if ($this->guardLogin($request,Config::get('constants.guards.freelancer'))) {
            return redirect()->intended('/home');
        }

        return back()->withInput($request->only('email', 'remember'));
    }


    public function boutiqueLogin(Request $request)
    {
        if ($this->guardLogin($request,Config::get('constants.guards.boutique'))) {
            return redirect()->intended('/home');
        }

        return back()->withInput($request->only('email', 'remember'));
    }
}
