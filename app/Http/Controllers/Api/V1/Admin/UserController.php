<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\LoginRequest;
use App\Http\Requests\Api\V1\Admin\CreateUserRequest;
use App\Http\Requests\Api\V1\Admin\UpdateUserRequest;
use App\Http\Resources\Api\Admin\UserResource;
use App\Models\User;
use App\Services\Sms\Sms;
use App\Services\UserService;
use App\Traits\StatusTrait;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Random\RandomException;

class UserController extends Controller
{
    use StatusTrait;
    public function __construct(public UserService $service)
    {
    }

    public function index()
    {
        $users = $this->service->all();
        return $this->successResponse($users, 'Users retrieved successfully');
    }

    public function store(CreateUserRequest $request)
    {
        $user = $this->service->store($request->validated());
        return $this->successResponse($user, 'User created successfully', 201);
    }

    public function show(User $user)
    {
        return $this->successResponse($user, 'User retrieved successfully');
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $user= $this->service->update($request->validated(), $user);
        return $this->successResponse($user, 'User updated successfully');
    }

    public function destroy(User $user)
    {
        $this->service->destroy($user);
        return $this->successResponse([], 'User deleted successfully');
    }
    /**
     * @throws RandomException
     * @throws RandomException
     */
    public function login(LoginRequest $request)
    {
        $mobile = $request->mobile;
        $user = User::where('mobile', $mobile)->first();
        if (!$user) {
            $user = User::create([
                'name' => $mobile,
                'mobile' => $mobile
            ]);
        }

        $loginToken =/* random_int(100000, 999999)*/123456;
       /* $sms = (new Sms());*/
        /*$smsResponse = $sms->sendToken([
            'mobile' => $mobile,
            'token' => $loginToken,
            'driver'=>'MaxSms',

        ]);*/

        $user->update(['token' => $loginToken]);
        $now = now()->addMinutes(2);
        return response()->json([
            'success' => true,
            'data' => [
                'otp_expire' => [
                    'date' => Carbon::make($now)->format('Y-m-d'),
                    'fa_date' => verta($now)->format('Y/m/d'),
                    'time' => verta($now)->format('H:i:s'),
                    'stamp' => Carbon::make($now)->timestamp,
                    'duration' => Carbon::now()->diffInMilliseconds($now),
                ],
            ],
            'message' => 'درخواست با موفقیت انجام شد'
        ]);
    }


    public function verify(Request $request)
    {
        $request->validate([
            'mobile' => 'required|numeric|exists:users,mobile',
            'token' => 'required|string|max:6',
        ]);

        $user = User::where('mobile', $request->mobile)->first();

        if (!$user || $user->token !== $request->token) {
            return response()->json(
                [
                    'message' => 'کد وارد شده صحیح نمی باشد',
                    'success' => false,
                    'data' => null
                ]
            );
        }

        $user->update(['token' => null]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'success' => true,
            'data' => UserResource::make($user)->additional(['token' => $token]),
            'message' => 'درخواست با موفقیت انجام شد'
        ]);
    }

    public function getUser(Request $request)
    {
        $user = auth()->user();
        return response()->json([
            'success' => true,
            'message' => 'درخواست با موفقیت انجام شد',
            'data' => UserResource::make($user)->additional(['token' => $request->bearerToken()]),
        ]);
    }
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json([
            'success' => true,
            'message' => 'درخواست با موفقیت انجام شد',
            'data' => null
        ]);
    }
}
