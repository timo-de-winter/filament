@php
    use Filament\Support\Enums\Alignment;

    $alignment = $getAlignment();
    $height = $getVideoHeight() ?? '8rem';
    $width = $getVideoWidth();
    $tooltip = $getTooltip();
    $sources = $getSources();
    $autoplay = $getAutoplay();
    $controls = $getControls();
    $controlsList = $getControlsList();
    $crossOrigin = $getCrossOrigin();
    $pictureInPicture = $getPictureInPicture();
    $remotePlayback = $getRemotePlayback();
    $loop = $getLoop();
    $muted = $getMuted();
    $playsInline = $getPlaysInline();
    $poster = $getPoster();
    $preload = $getPreload();

    if (filled($controlsList) && is_array($controlsList)) {
        $controlsList = implode(' ', $controlsList);
    }

    if (! $alignment instanceof Alignment) {
        $alignment = filled($alignment) ? (Alignment::tryFrom($alignment) ?? $alignment) : null;
    }
@endphp

<video
    @if (filled($tooltip))
        x-tooltip="{ content: @js($tooltip), theme: $store.theme }"
    @endif
    @if($autoplay)
        autoplay
    @endif
    @if($controls)
        controls

        @if(filled($controlsList))
            controlslist="{{ $controlsList }}"
        @endif
    @endif
    @if(filled($crossOrigin))
        crossorigin="{{ $crossOrigin }}"
    @endif
    @if(!$pictureInPicture)
        disablepictureinpicture
    @endif
    @if(!$remotePlayback)
        disableremoteplayback
    @endif
    @if($loop)
        loop
    @endif
    @if($muted)
        muted
    @endif
    @if($playsInline)
        playsinline
    @endif
    {{
        $getExtraAttributeBag()
            ->merge([
                'poster' => $poster ?? false,
                'preload' => $preload ?? false,
            ])
            ->class([
                'fi-sc-video',
                ($alignment instanceof Alignment) ? "fi-align-{$alignment->value}" : $alignment,
            ])
            ->style([
                "height: {$height}" => $height,
                "width: {$width}" => $width,
            ])
    }}
>
    @foreach($sources as $type => $url)
        <source src="{{ $url }}" type="{{ $type }}" />
    @endforeach
</video>
