<?php

namespace App\Console\Commands;

use App\Models\SecretKey;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Inertia\Testing\Concerns\Has;

class AddSecretKey extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:add-secret-key {email} {secretKey}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add secret key for user';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $email = $this->argument('email');
        $secretKey = $this->argument('secretKey');
        $user = User::query()->where(['email' => $email])->first();

        if (null === $user) {
            $this->error('User not found!');
            return 1;
        }

        if (null !== SecretKey::query()->where(['user_id' => $user->getAttributeValue('id')])->first()) {
            $this->error('Secret key for this user already exists!');
            return 1;
        }

        $hashSecretKey = Hash::make($secretKey);

        SecretKey::create([
            'user_id' => $user->getAttributeValue('id'),
            'secret_key' => $hashSecretKey,
        ]);

        $this->info('Secret key is created!');
        return 0;
    }
}
