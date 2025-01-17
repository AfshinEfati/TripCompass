<?php

namespace App\Http\Controllers\Api\V1\Frontend\Provider;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Panel\Provider\RegisterRequest;
use App\Http\Resources\Api\Panel\ProviderResource;
use App\Services\ProviderService;
use App\Traits\StatusTrait;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SignupController extends Controller
{
    use StatusTrait;

    public function __construct(protected ProviderService $service)
    {

    }

    public function register(RegisterRequest $request): JsonResponse
    {
        $provider = $this->service->storeBasicDetails($request->validated());
        return $this->successResponse(ProviderResource::make($provider), 'request succeed');
    }

    public function verifyEmail(Request $request): JsonResponse
    {
        $provider = $request->user();

        if (!$provider) {
            return response()->json(['message' => 'Provider not authenticated.'], 401);
        }

        $provider = $this->service->verifyEmail($provider);

        return response()->json(['message' => 'Email verified successfully.', 'provider' => $provider], 200);
    }

    public function verifyEmailHash(EmailVerificationRequest $request): JsonResponse
    {
        $request->fulfill();

        return response()->json(['message' => 'Email verified successfully.'], 200);
    }

    public function resendEmail(Request $request)
    {
        $request->user()->sendEmailVerificationNotification();

        return response()->json(['message' => 'Verification email sent successfully.'], 200);
    }

    public function uploadDocuments(Request $request)
    {
        $provider = $request->user();

        if (!$provider) {
            return response()->json(['message' => 'Provider not authenticated.'], 401);
        }

        $validated = $request->validate([
            'documents.*' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        $provider = $this->service->uploadDocuments($provider, $validated['documents']);

        return response()->json(['message' => 'Documents uploaded successfully.', 'provider' => $provider], 200);
    }

    public function addAddress(Request $request)
    {
        $provider = $request->user();

        if (!$provider) {
            return response()->json(['message' => 'Provider not authenticated.'], 401);
        }

        $validated = $request->validate([
            'address' => 'required|string|max:255',
            'city_id' => 'required|integer|exists:cities,id',
        ]);

        $provider = $this->service->addAddress($provider, $validated);

        return response()->json(['message' => 'Address added successfully.', 'provider' => $provider], 200);
    }

    public function requestApproval(Request $request)
    {
        $provider = $request->user();

        if (!$provider) {
            return response()->json(['message' => 'Provider not authenticated.'], 401);
        }

        $provider = $this->service->requestApproval($provider);

        return response()->json(['message' => 'Approval request sent successfully.', 'provider' => $provider], 200);
    }

}
