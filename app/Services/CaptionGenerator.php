<?php

namespace App\Services;

use App\Models\Product;

class CaptionGenerator
{
    public function generate(
        Product $product,
        string $style,
        string $tone,
        bool $includeHashtags,
        string $customNote,
        string $callToAction,
    ): array {
        $captions = [];

        $hooks = $this->getHooks($style, $tone);
        $bodies = $this->getBodies($style, $tone);
        $ctas = $this->getCtas($callToAction);
        $hashtags = $includeHashtags ? $this->getHashtags($product) : '';

        // Pick 3 unique combinations
        shuffle($hooks);
        shuffle($bodies);

        for ($i = 0; $i < 3; $i++) {
            $hook = $hooks[$i % count($hooks)];
            $body = $bodies[$i % count($bodies)];
            $cta = $ctas[array_rand($ctas)];

            $caption = $this->interpolate($hook, $product, $customNote)
                . "\n\n"
                . $this->interpolate($body, $product, $customNote);

            if ($customNote) {
                $noteLines = $this->getNoteInsertions($customNote);
                $caption .= "\n\n" . $noteLines[array_rand($noteLines)];
            }

            if ($cta) {
                $caption .= "\n\n" . $cta;
            }

            if ($hashtags) {
                $caption .= "\n\n" . $hashtags;
            }

            $captions[] = trim($caption);
        }

        return $captions;
    }

    private function interpolate(string $template, Product $product, string $customNote): string
    {
        $category = $product->category?->name ?? 'treat';
        $price = number_format((float) $product->price, 2);

        return str_replace(
            ['{name}', '{description}', '{price}', '{category}'],
            [$product->name, $product->description ?? 'something special', '$' . $price, strtolower($category)],
            $template,
        );
    }

    private function getHooks(string $style, string $tone): array
    {
        $hooks = [
            'casual' => [
                'fun' => [
                    'PSA: {name} exists and your taste buds need to know.',
                    'Just here to remind you that {name} is a thing you can order.',
                    'You + {name} = a really good decision.',
                    'Not to be dramatic, but {name} might change your whole week.',
                ],
                'professional' => [
                    'Introducing our {name} — crafted with care, baked to perfection.',
                    'Meet {name}. Thoughtfully made, absolutely worth it.',
                    'Our {name} speaks for itself — quality you can taste.',
                ],
                'warm' => [
                    'There is something so comforting about a fresh {name}.',
                    'Made with love, baked with care — our {name} is ready for you.',
                    'Nothing says home like a freshly baked {name}.',
                    'Warm from the oven, straight to your heart — {name}.',
                ],
                'exciting' => [
                    'JUST DROPPED: {name}! You are going to love this.',
                    '{name} is HERE and it is everything.',
                    'Stop scrolling — {name} just came out of the oven!',
                ],
            ],
            'promotional' => [
                'fun' => [
                    'Treat yourself! {name} is calling your name.',
                    'Your midweek pick-me-up? {name}. Obviously.',
                    'Life is short. Order the {name}.',
                ],
                'professional' => [
                    'Now available: {name} at just {price}.',
                    'Elevate your next gathering with our {name}.',
                    'Quality meets flavor — {name}, available for order.',
                ],
                'warm' => [
                    'We baked something special for you — {name}, just {price}.',
                    'Share the love with a {name} — perfect for any occasion.',
                    'Made for sharing, priced with care — {name} at {price}.',
                ],
                'exciting' => [
                    '{name} at {price}?! Yes, really. Go treat yourself!',
                    'Do not miss out! {name} is available NOW.',
                    'This is your sign to order {name} today!',
                ],
            ],
            'storytelling' => [
                'fun' => [
                    'The story of {name} starts with a craving and ends with crumbs.',
                    'Once upon a time, someone asked "what should I bake?" and {name} was born.',
                    'Every {name} has a story. This one starts in my kitchen at 5am.',
                ],
                'professional' => [
                    'Behind every {name} is a recipe perfected over time.',
                    'The art of baking {name} — from scratch, always.',
                    'Some recipes are worth perfecting. {name} is one of them.',
                ],
                'warm' => [
                    'Every batch of {name} starts with a little love and a lot of butter.',
                    'The best part of my morning? Watching {name} come to life in the oven.',
                    'I pour my heart into every {name} — and I think you can taste it.',
                ],
                'exciting' => [
                    'You would not believe how good this batch of {name} turned out!',
                    'I just pulled {name} from the oven and I am losing it — LOOK at these!',
                    'This might be the best {name} I have ever made. Seriously.',
                ],
            ],
            'seasonal' => [
                'fun' => [
                    'Tis the season for {name}! Get them while they last.',
                    'Seasonal vibes + {name} = perfection.',
                    '{name} season is officially open!',
                ],
                'professional' => [
                    'Our seasonal {name} is now available for a limited time.',
                    'Celebrate the season with our limited-edition {name}.',
                    'Seasonal flavors, timeless quality — {name} is here.',
                ],
                'warm' => [
                    'This time of year calls for something special — like our {name}.',
                    'Cozy season is better with {name}. Trust me on this one.',
                    'Nothing captures the season quite like a fresh {name}.',
                ],
                'exciting' => [
                    'SEASONAL DROP: {name} is back and better than ever!',
                    '{name} is BACK! Limited time only — do not sleep on this!',
                    'The wait is over — seasonal {name} is HERE!',
                ],
            ],
        ];

        return $hooks[$style][$tone] ?? $hooks['casual']['fun'];
    }

    private function getBodies(string $style, string $tone): array
    {
        $bodies = [
            'casual' => [
                'Made from scratch right here in ' . \App\Models\Setting::get('store_state_full', 'Florida') . '. {description}.',
                'Just your friendly cottage baker bringing you {category} goodness.',
                'Homemade {category} made with real ingredients and zero shortcuts.',
                'Small batch, big flavor. Every {name} is made with intention.',
            ],
            'promotional' => [
                'Order yours today for just {price}. Handmade, fresh, and ready for pickup.',
                '{name} — {description}. Available now at {price}.',
                'Fresh from my kitchen to your table. Grab yours for {price}.',
                'Handcrafted {category} at {price}. Because you deserve the good stuff.',
            ],
            'storytelling' => [
                '{description}. Every batch is a labor of love from my home kitchen.',
                'I started baking {category} because I believe homemade just hits different. {description}.',
                'What makes my {name} special? {description}. Plus a whole lot of heart.',
                'From my kitchen to yours — {description}.',
            ],
            'seasonal' => [
                'Available for a limited time only. {description}.',
                'Get them before the season ends! {description}.',
                'Seasonal ingredients, timeless recipes. {description}.',
                'A limited-time favorite — {description}. Order before they are gone!',
            ],
        ];

        return $bodies[$style] ?? $bodies['casual'];
    }

    private function getCtas(string $callToAction): array
    {
        return match ($callToAction) {
            'order_now' => [
                'Ready to order? Message me to place yours!',
                'Order yours today — spots fill up fast!',
                'Place your order now before they are gone!',
            ],
            'link_in_bio' => [
                'Order link in bio!',
                'Tap the link in bio to place your order.',
                'Head to the link in my bio to grab yours!',
            ],
            'dm_us' => [
                'Slide into my DMs to order!',
                'Send me a message to place your order.',
                'DM me to get yours!',
            ],
            'none' => [''],
            default => [''],
        };
    }

    private function getNoteInsertions(string $note): array
    {
        return [
            $note,
            "P.S. — {$note}",
            "Fun fact: {$note}",
        ];
    }

    private function getHashtags(Product $product): string
    {
        $base = [
            '#cottagefood', '#homebaked', '#floridabaker',
            '#bakeryonbiscotto', '#freshbaked', '#homemade',
            '#smallbatchbaking', '#madewithlove', '#cottagebakerlife',
            '#floridafoodie', '#supportsmallbusiness',
        ];

        $category = $product->category?->name;
        if ($category) {
            $tag = '#' . preg_replace('/[^a-z0-9]/', '', strtolower($category));
            $base[] = $tag;
        }

        $nameTag = '#' . preg_replace('/[^a-z0-9]/', '', strtolower($product->name));
        if (strlen($nameTag) > 2 && strlen($nameTag) < 30) {
            $base[] = $nameTag;
        }

        // Category-specific bonus tags
        $catLower = strtolower($category ?? '');
        if (str_contains($catLower, 'cookie')) {
            $base = array_merge($base, ['#cookiesofinstagram', '#homemadecookies', '#cookielove']);
        } elseif (str_contains($catLower, 'cake')) {
            $base = array_merge($base, ['#cakedecorating', '#homemadecake', '#cakelover']);
        } elseif (str_contains($catLower, 'bread')) {
            $base = array_merge($base, ['#artisanbread', '#homemadebread', '#breadbaking']);
        } elseif (str_contains($catLower, 'pie') || str_contains($catLower, 'pastry')) {
            $base = array_merge($base, ['#pastrylife', '#homemadepie', '#bakedgoods']);
        } elseif (str_contains($catLower, 'brownie') || str_contains($catLower, 'bar')) {
            $base = array_merge($base, ['#brownielove', '#homemadebrownies', '#treatyourself']);
        }

        $base = array_unique($base);
        shuffle($base);

        return implode(' ', array_slice($base, 0, 15));
    }
}
