{{-- EduBridge standard back control (include once per layout <head>) --}}
<style>
    a.eb-back {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        padding: 10px 18px 10px 14px;
        border-radius: 999px;
        font-size: 0.875rem;
        font-weight: 700;
        letter-spacing: 0.02em;
        text-decoration: none;
        color: var(--ink, #0d1117);
        background: linear-gradient(145deg, #ffffff 0%, #f3f6f4 55%, #eef4f1 100%);
        border: 1px solid rgba(74, 124, 107, 0.28);
        box-shadow:
            0 4px 16px rgba(13, 17, 23, 0.07),
            0 1px 0 rgba(255, 255, 255, 0.9) inset;
        transition: transform 0.2s ease, box-shadow 0.2s ease, border-color 0.2s ease, color 0.2s ease, background 0.2s ease;
    }
    a.eb-back:hover {
        transform: translateX(-4px);
        border-color: rgba(74, 124, 107, 0.5);
        box-shadow:
            0 10px 28px rgba(74, 124, 107, 0.14),
            0 1px 0 rgba(255, 255, 255, 0.95) inset;
        color: var(--sage, #4a7c6b);
        text-decoration: none;
    }
    a.eb-back:focus-visible {
        outline: none;
        box-shadow: 0 0 0 3px rgba(74, 124, 107, 0.35);
    }
    .eb-back__icon {
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        color: var(--sage, #4a7c6b);
    }
    a.eb-back:hover .eb-back__icon {
        color: inherit;
    }
    /* On dark backgrounds (e.g. counsellor profile hero) */
    a.eb-back--dark {
        color: #fff;
        background: rgba(255, 255, 255, 0.12);
        border-color: rgba(255, 255, 255, 0.35);
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
    }
    a.eb-back--dark .eb-back__icon {
        color: rgba(255, 255, 255, 0.95);
    }
    a.eb-back--dark:hover {
        background: rgba(255, 255, 255, 0.2);
        border-color: rgba(255, 255, 255, 0.5);
        color: #fff;
        box-shadow: 0 8px 28px rgba(0, 0, 0, 0.25);
    }
    /* Spacing when used inside auth card */
    .eb-back-wrap--auth {
        margin: -2px 0 18px;
    }
    /* Sits inline next to buttons (forms, footers) */
    a.eb-back--inline {
        width: auto;
        padding: 8px 16px 8px 12px;
        font-size: 0.84rem;
    }
</style>
