<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class ListPayPalTemplates extends Command
{
    protected $signature = 'paypal:templates';
    protected $description = 'List all PayPal invoice templates';

    public function handle()
    {
        $baseUrl = config('services.paypal.base_url');
        $clientId = config('services.paypal.client_id');
        $clientSecret = config('services.paypal.client_secret');

        $this->info("Mode: " . config('services.paypal.mode'));
        $this->info("Base URL: {$baseUrl}");

        // Get access token
        $tokenResponse = Http::asForm()
            ->withBasicAuth($clientId, $clientSecret)
            ->post("{$baseUrl}/v1/oauth2/token", [
                'grant_type' => 'client_credentials',
            ]);

        if (!$tokenResponse->successful()) {
            $this->error('Failed to get access token: ' . $tokenResponse->body());
            return 1;
        }

        $token = $tokenResponse->json('access_token');
        $this->info("✅ Authenticated");

        // List templates
        $response = Http::withToken($token)
            ->get("{$baseUrl}/v2/invoicing/templates");

        if (!$response->successful()) {
            $this->error('Failed to list templates: ' . $response->body());
            return 1;
        }

        $data = $response->json();
        $templates = $data['templates'] ?? [];

        if (empty($templates)) {
            $this->warn('No custom templates found.');
            return 0;
        }

        $this->info("\nFound " . count($templates) . " template(s):\n");

        foreach ($templates as $t) {
            $this->line("ID: " . ($t['id'] ?? 'N/A'));
            $this->line("Name: " . ($t['name'] ?? 'Unnamed'));
            $this->line("Default: " . (($t['standard_template'] ?? false) ? 'Yes' : 'No'));
            if (!empty($t['detail']['note'])) {
                $this->line("Note: " . $t['detail']['note']);
            }
            if (!empty($t['detail']['terms_and_conditions'])) {
                $this->line("Terms: " . $t['detail']['terms_and_conditions']);
            }
            $this->line(str_repeat('-', 50));
        }

        return 0;
    }
}
