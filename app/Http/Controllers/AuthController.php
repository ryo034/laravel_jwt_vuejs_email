<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
// use Auth;
use Illuminate\Support\Facades\Auth;
use Validator;
use JWTAuth;
use App\User;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\EmailVerification;

class AuthController extends Controller
{
    public function checkRegisterEmail($email_token)
    {
      // 使用可能なトークンか
      if ( !User::where('email_verify_token',$email_token)->exists() ){
          redirect('/register/email/invalid');
      } else {
          $user = User::where('email_verify_token', $email_token)->first();
          // 本登録済みユーザーか
          if ($user->email_verified == 1){
              // logger("status". $user->email_verified );
              return redirect('/register/email/exist');
          }
          // ユーザーステータス更新
          $user->email_verified = 1;
          $user->email_verified_at = Carbon::now();
          if($user->save()) {
              return redirect('/register/email/success');
          } else{
              return redirect('/register/email/fail');
          }
      }
    }
    /**
     * Register a new user
     */
    public function register(Request $request)
    {
        $v = Validator::make($request->all(), [
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users',
            'password'  => 'required|min:3|confirmed',
        ]);
        if ($v->fails())
        {
            return response()->json([
                'status' => 'error',
                'errors' => $v->errors()
            ], 422);
        }
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->email_verify_token = base64_encode($request->email);
        $user->save();
        Mail::to($request->email)->send(new EmailVerification($user));
        return response()->json(['status' => 'success'], 200);
    }
    /**
     * Login user and return a token
     */
    public function login(Request $request)
    {
      if ($request->email) {
        $user = User::where('email', $request->email)->first();
        if (!empty($user['email_verified_at'])) {
          $credentials = $request->only('email', 'password');
          if ($token = $this->guard()->attempt($credentials)) {
              return response()->json(['status' => 'success'], 200)->header('Authorization', $token);
          }
          return response()->json(['error' => 'The information entered is incorrect.'], 401);
        }else{
          return response()->json(['error' => 'This registration has not been completed. Please click the link of the sent email.'], 401);
        }
      }
    }
    /**
     * Logout User
     */
    public function logout()
    {
        $this->guard()->logout();
        return response()->json([
            'status' => 'success',
            'msg' => 'Logged out Successfully.'
        ], 200);
    }
    /**
     * Get authenticated user
     */
    public function user(Request $request)
    {
        $user = JWTAuth::parseToken()->authenticate();
        return response()->json([
            'status' => 'success',
            'data' => $user
        ]);
    }
    /**
     * Refresh JWT token
     */
    public function refresh()
    {
        if ($token = JWTAuth::getToken()) {
        // if ($token = $this->guard()->refresh()) {
            return response()
                ->json(['status' => 'successs'], 200)
                ->header('Authorization', $token);
        }
        return response()->json(['error' => 'refresh_token_error'], 401);
    }
    /**
     * Return auth guard
     */
    private function guard()
    {
        return Auth::guard();
    }
}
