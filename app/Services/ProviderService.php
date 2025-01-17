<?php

namespace App\Services;

use App\Enums\Provider\SignupStep;
use App\Models\Provider;
use App\Repositories\Interfaces\ProviderRepositoryInterface;
use Illuminate\Support\Facades\Hash;

class ProviderService
{
    public function __construct(public ProviderRepositoryInterface $repository)
    {
    }

    public function all()
    {
        return $this->repository->all();
    }

    public function store(mixed $validated)
    {
        return $this->repository->store($validated);
    }

    public function update(mixed $validated, Provider $provider)
    {
        return $this->repository->update($provider, $validated);
    }

    public function destroy(Provider $provider)
    {
        return $this->repository->destroy($provider->id);
    }

    public function storeBasicDetails(array $data)
    {
        $data['password'] = Hash::make($data['password']);
        $data['signup_step'] = SignupStep::BasicDetails->value;

        $provider = $this->repository->store($data);

        if (method_exists($provider, 'sendEmailVerificationNotification')) {
            $provider->sendEmailVerificationNotification();
        } else {
            throw new Exception('Email verification notification method not found.');
        }

        return $provider;
    }

    public function verifyEmail(Provider $provider)
    {
        if ($provider->signup_step !== SignupStep::BasicDetails->value) {
            throw new Exception('Invalid step for email verification.');
        }

        $provider->update(['signup_step' => SignupStep::VerifyEmail->value]);

        return $provider;
    }

    public function uploadDocuments(Provider $provider, array $files)
    {
        if ($provider->signup_step !== SignupStep::VerifyEmail->value) {
            throw new Exception('Invalid step for document upload.');
        }

        foreach ($files as $file) {
            $provider->media()->create([
                'path' => $file->store('documents', 'public'),
                'type' => 'document',
            ]);
        }

        $provider->update(['signup_step' => SignupStep::UploadDocuments->value]);

        return $provider;
    }

    public function addAddress(Provider $provider, array $data)
    {
        if ($provider->signup_step !== SignupStep::UploadDocuments->value) {
            throw new Exception('Invalid step for adding address.');
        }

        $provider->addresses()->create([
            'address' => $data['address'],
            'city_id' => $data['city_id'],
        ]);

        $provider->update(['signup_step' => SignupStep::AddAddress->value]);

        return $provider;
    }

    public function requestApproval(Provider $provider)
    {
        if ($provider->signup_step !== SignupStep::AddAddress->value) {
            throw new Exception('Invalid step for requesting approval.');
        }

        $provider->update([
            'signup_step' => SignupStep::Approval->value,
            'status' => 'pending',
        ]);

        return $provider;
    }
}
