<?php

namespace Filament\Schemas\Components;

use Closure;
use Filament\Support\Concerns\HasAlignment;
use Filament\Support\Concerns\HasTooltip;

class Video extends Component
{
    use HasAlignment;
    use HasTooltip;

    protected string $view = 'filament-schemas::components.video';

    protected array $sources = [];

    protected int | string | Closure | null $videoHeight = null;

    protected int | string | Closure | null $videoWidth = null;

    protected bool | Closure | null $autoplay = null;

    protected bool | Closure $controls = true;

    protected string | array | Closure | null $controlsList = null;

    protected string | Closure | null $crossOrigin = null;

    protected bool | Closure $pictureInPicture = true;

    protected bool | Closure $remotePlayback = true;

    protected bool | Closure | null $loop = null;

    protected bool | Closure | null $muted = null;

    protected bool | Closure | null $playsInline = null;

    protected string | Closure | null $poster = null;

    protected string | Closure | null $preload = null;

    public static function make(): static
    {
        $static = app(static::class);
        $static->configure();

        return $static;
    }

    public function source(string | Closure $url, string | Closure $type): static
    {
        $this->sources[] = [
            'url' => $url,
            'type' => $type,
        ];

        return $this;
    }

    public function videoHeight(int | string | Closure | null $height): static
    {
        $this->videoHeight = $height;

        return $this;
    }

    public function videoSize(int | string | Closure $size): static
    {
        $this->videoWidth($size);
        $this->videoHeight($size);

        return $this;
    }

    public function videoWidth(int | string | Closure | null $width): static
    {
        $this->videoWidth = $width;

        return $this;
    }

    public function autoplay(bool | Closure $autoplay = true): static
    {
        $this->autoplay = $autoplay;

        return $this;
    }

    public function controls(bool | Closure $controls = true): static
    {
        $this->controls = $controls;

        return $this;
    }

    public function controlsList(string | array | Closure $controlsList): static
    {
        $this->controlsList = $controlsList;

        return $this;
    }

    public function crossOrigin(string | Closure $crossOrigin): static
    {
        $this->crossOrigin = $crossOrigin;

        return $this;
    }

    public function pictureInPicture(bool | Closure $pictureInPicture = true): static
    {
        $this->pictureInPicture = $pictureInPicture;

        return $this;
    }

    public function remotePlayback(bool | Closure $pictureInPicture = true): static
    {
        $this->remotePlayback = $pictureInPicture;

        return $this;
    }

    public function loop(bool | Closure $loop = true): static
    {
        $this->loop = $loop;

        return $this;
    }

    public function muted(bool | Closure $muted = true): static
    {
        $this->muted = $muted;

        return $this;
    }

    public function playsInline(bool | Closure $playsInline = true): static
    {
        $this->playsInline = $playsInline;

        return $this;
    }

    public function poster(string | Closure $poster): static
    {
        $this->poster = $poster;

        return $this;
    }

    public function preload(bool | Closure $preload): static
    {
        $this->preload = $preload;

        return $this;
    }

    public function getSources(): array
    {
        $sources = [];

        foreach ($this->sources as $source) {
            $sources[$this->evaluate($source['type'])] = $this->evaluate($source['url']);
        }

        return $sources;
    }

    public function getVideoHeight(): ?string
    {
        $height = $this->evaluate($this->videoHeight);

        if ($height === null) {
            return null;
        }

        if (is_int($height)) {
            return "{$height}px";
        }

        return $height;
    }

    public function getVideoWidth(): ?string
    {
        $width = $this->evaluate($this->videoWidth);

        if ($width === null) {
            return null;
        }

        if (is_int($width)) {
            return "{$width}px";
        }

        return $width;
    }

    public function getAutoplay(): ?bool
    {
        return $this->evaluate($this->autoplay);
    }

    public function getControls(): bool
    {
        return $this->evaluate($this->controls);
    }

    public function getControlsList(): ?bool
    {
        return $this->evaluate($this->controlsList);
    }

    public function getCrossOrigin(): ?string
    {
        return $this->evaluate($this->crossOrigin);
    }

    public function getPictureInPicture(): string
    {
        return $this->evaluate($this->pictureInPicture);
    }

    public function getRemotePlayback(): string
    {
        return $this->evaluate($this->remotePlayback);
    }

    public function getLoop(): ?string
    {
        return $this->evaluate($this->loop);
    }

    public function getMuted(): ?string
    {
        return $this->evaluate($this->muted);
    }

    public function getPlaysInline(): ?string
    {
        return $this->evaluate($this->playsInline);
    }

    public function getPoster(): ?string
    {
        return $this->evaluate($this->poster);
    }

    public function getPreload(): ?string
    {
        return $this->evaluate($this->preload);
    }
}
