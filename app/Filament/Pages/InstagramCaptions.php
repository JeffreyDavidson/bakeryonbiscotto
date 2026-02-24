<?php

namespace App\Filament\Pages;

use App\Models\Product;
use App\Services\CaptionGenerator;
use BackedEnum;
use Filament\Pages\Page;
use Illuminate\Support\Collection;

class InstagramCaptions extends Page
{
    protected string $view = 'filament.pages.instagram-captions';

    protected static ?string $title = 'Instagram Captions';

    protected static ?string $navigationLabel = 'Instagram Captions';

    protected static ?int $navigationSort = 7;

    public static function getNavigationIcon(): string|BackedEnum|null
    {
        return 'heroicon-o-camera';
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Tools';
    }

    // Form state
    public ?int $product_id = null;
    public string $caption_style = 'casual';
    public string $tone = 'fun';
    public bool $include_hashtags = true;
    public string $custom_note = '';
    public string $call_to_action = 'order_now';

    // Results
    public array $captions = [];
    public bool $generated = false;

    public function getProductsProperty(): Collection
    {
        return Product::available()->orderBy('name')->get();
    }

    public function generate(): void
    {
        if (!$this->product_id) {
            return;
        }

        $product = Product::with('category')->find($this->product_id);

        if (!$product) {
            return;
        }

        $generator = new CaptionGenerator();

        $this->captions = $generator->generate(
            product: $product,
            style: $this->caption_style,
            tone: $this->tone,
            includeHashtags: $this->include_hashtags,
            customNote: $this->custom_note,
            callToAction: $this->call_to_action,
        );

        $this->generated = true;
    }

    public function regenerate(): void
    {
        $this->generate();
    }

    public function getBreadcrumbs(): array
    {
        return [
            '/admin' => 'Dashboard',
            '' => 'Instagram Captions',
        ];
    }
}
