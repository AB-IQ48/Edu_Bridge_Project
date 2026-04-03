@php
    $label = $backLabel ?? 'Back';
    $variant = $variant ?? 'default';
    $titleAttr = $title ?? null;

    if (isset($href) && $href !== '') {
        $target = $href;
    } else {
        $prev = url()->previous();
        $curr = url()->current();
        $prevPath = $prev ? (parse_url($prev, PHP_URL_PATH) ?? '') : '';
        $skipPrev = $prevPath !== '' && (
            str_contains($prevPath, 'login')
            || str_contains($prevPath, 'register')
            || str_contains($prevPath, 'forgot-password')
            || str_contains($prevPath, 'reset-password')
        );
        if (isset($backUrl) && $backUrl !== '') {
            $target = $backUrl;
        } elseif ($prev && $prev !== $curr && ! $skipPrev) {
            $target = $prev;
        } else {
            if (auth()->check()) {
                $u = auth()->user();
                $roleHome = $u->isAdministrator()
                    ? route('admin.index')
                    : ($u->isCounsellor()
                        ? route('counsellor.index')
                        : ($u->isStudent()
                            ? route('student.index')
                            : route('dashboard')));
            } else {
                $roleHome = url('/');
            }
            $target = $fallbackUrl ?? $roleHome;
        }
    }

    $classes = ['eb-back'];
    if ($variant === 'dark') {
        $classes[] = 'eb-back--dark';
    }
    if (! empty($inline)) {
        $classes[] = 'eb-back--inline';
    }
@endphp
<a href="{{ $target }}" class="{{ implode(' ', $classes) }}" @if($titleAttr) title="{{ $titleAttr }}" @endif>
    <span class="eb-back__icon" aria-hidden="true">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M15 18l-6-6 6-6" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/></svg>
    </span>
    <span class="eb-back__label">{{ $label }}</span>
</a>
