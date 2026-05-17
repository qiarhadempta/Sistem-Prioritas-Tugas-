/**
 * school-deco.js
 * Injects animated school-themed SVG decorations into the page background
 */
(function () {
    const items = [
        // Pencil 1 — top left
        { cls: 'pencil-1', size: 68, svg: `
            <g transform="rotate(-30 34 34)">
                <rect x="22" y="6" width="24" height="42" rx="4" fill="#4f46e5" opacity="0.16"/>
                <polygon points="22,48 46,48 34,62" fill="#f59e0b" opacity="0.32"/>
                <rect x="22" y="6" width="24" height="10" rx="4" fill="#e2e8f0" opacity="0.5"/>
                <rect x="26" y="9" width="16" height="2.5" rx="1" fill="#4f46e5" opacity="0.25"/>
                <line x1="34" y1="16" x2="34" y2="48" stroke="#fff" stroke-width="2.5" opacity="0.15" stroke-linecap="round"/>
            </g>
        ` },
        // Book open 1 — top right
        { cls: 'book-1', size: [92, 78], svg: `
            <rect x="4" y="8" width="38" height="54" rx="4" fill="#4f46e5" opacity="0.14"/>
            <rect x="50" y="8" width="38" height="54" rx="4" fill="#6366f1" opacity="0.14"/>
            <path d="M42 8 Q46 10 46 32 Q46 54 42 62" fill="none" stroke="#4f46e5" stroke-width="2" opacity="0.2"/>
            <line x1="12" y1="24" x2="36" y2="24" stroke="#4f46e5" stroke-width="2" opacity="0.22" stroke-linecap="round"/>
            <line x1="12" y1="32" x2="36" y2="32" stroke="#4f46e5" stroke-width="2" opacity="0.22" stroke-linecap="round"/>
            <line x1="12" y1="40" x2="28" y2="40" stroke="#4f46e5" stroke-width="2" opacity="0.22" stroke-linecap="round"/>
            <line x1="56" y1="24" x2="80" y2="24" stroke="#6366f1" stroke-width="2" opacity="0.22" stroke-linecap="round"/>
            <line x1="56" y1="32" x2="80" y2="32" stroke="#6366f1" stroke-width="2" opacity="0.22" stroke-linecap="round"/>
            <line x1="56" y1="40" x2="72" y2="40" stroke="#6366f1" stroke-width="2" opacity="0.22" stroke-linecap="round"/>
        ` },
        // Ruler — bottom left
        { cls: 'ruler-1', size: [130, 40], svg: `
            <rect x="2" y="8" width="126" height="24" rx="5" fill="#f59e0b" opacity="0.18"/>
            <rect x="2" y="8" width="126" height="4" rx="2" fill="#fbbf24" opacity="0.2"/>
            ${[15,27,39,51,63,75,87,99,111].map((x,i) =>
                `<line x1="${x}" y1="8" x2="${x}" y2="${i % 2 === 0 ? 20 : 15}" stroke="#d97706" stroke-width="${i % 2 === 0 ? 1.5 : 1}" opacity="${i % 2 === 0 ? 0.45 : 0.3}"/>`
            ).join('')}
            <text x="16" y="29" font-size="7" fill="#d97706" opacity="0.4" font-family="monospace">1  2  3  4  5  6  7  8  9</text>
        ` },
        // Globe — right center
        { cls: 'globe-1', size: [76, 88], svg: `
            <circle cx="38" cy="36" r="28" fill="none" stroke="#4f46e5" stroke-width="2" opacity="0.18"/>
            <circle cx="38" cy="36" r="28" fill="#e0e7ff" opacity="0.07"/>
            <ellipse cx="38" cy="36" rx="13" ry="28" fill="none" stroke="#4f46e5" stroke-width="1.5" opacity="0.14"/>
            <line x1="10" y1="36" x2="66" y2="36" stroke="#4f46e5" stroke-width="1.5" opacity="0.14"/>
            <path d="M12 22 Q38 18 64 22" fill="none" stroke="#4f46e5" stroke-width="1" opacity="0.12"/>
            <path d="M12 50 Q38 54 64 50" fill="none" stroke="#4f46e5" stroke-width="1" opacity="0.12"/>
            <rect x="34" y="64" width="8" height="14" rx="2" fill="#64748b" opacity="0.2"/>
            <ellipse cx="38" cy="78" rx="16" ry="4" fill="#64748b" opacity="0.14"/>
        ` },
        // Calculator — bottom right
        { cls: 'calc-1', size: [58, 78], svg: `
            <rect x="4" y="4" width="50" height="70" rx="7" fill="#4f46e5" opacity="0.13"/>
            <rect x="10" y="12" width="38" height="16" rx="3" fill="#e0e7ff" opacity="0.38"/>
            <text x="14" y="24" font-size="9" fill="#4f46e5" opacity="0.35" font-family="monospace">3.14</text>
            ${[[16,42],[29,42],[42,42],[16,54],[29,54],[42,54],[16,66],[29,66],[42,66]].map(([cx,cy],i) =>
                `<rect x="${cx-6}" y="${cy-6}" width="12" height="12" rx="3" fill="${i===5 ? '#dc2626' : '#4f46e5'}" opacity="${i===5 ? 0.28 : 0.2}"/>`
            ).join('')}
        ` },
        // Graduation cap — top center
        { cls: 'cap-1', size: [90, 68], svg: `
            <polygon points="45,10 86,30 45,50 4,30" fill="#4f46e5" opacity="0.16"/>
            <ellipse cx="45" cy="50" rx="24" ry="11" fill="#4f46e5" opacity="0.1"/>
            <line x1="78" y1="30" x2="78" y2="52" stroke="#4f46e5" stroke-width="3" opacity="0.2" stroke-linecap="round"/>
            <circle cx="78" cy="54" r="5" fill="#f59e0b" opacity="0.38"/>
        ` },
        // Compass — left center
        { cls: 'compass-1', size: [60, 76], svg: `
            <circle cx="30" cy="14" r="9" fill="none" stroke="#4f46e5" stroke-width="2.5" opacity="0.2"/>
            <circle cx="30" cy="14" r="3" fill="#4f46e5" opacity="0.25"/>
            <line x1="30" y1="23" x2="20" y2="62" stroke="#4f46e5" stroke-width="2" opacity="0.18" stroke-linecap="round"/>
            <line x1="30" y1="23" x2="40" y2="62" stroke="#4f46e5" stroke-width="2" opacity="0.18" stroke-linecap="round"/>
            <circle cx="20" cy="63" r="3.5" fill="#4f46e5" opacity="0.2"/>
            <circle cx="40" cy="63" r="3.5" fill="#4f46e5" opacity="0.2"/>
            <line x1="14" y1="44" x2="46" y2="44" stroke="#4f46e5" stroke-width="1" opacity="0.14" stroke-linecap="round"/>
        ` },
        // Backpack — bottom center
        { cls: 'bag-1', size: [72, 80], svg: `
            <rect x="12" y="18" width="48" height="54" rx="10" fill="#4f46e5" opacity="0.13"/>
            <rect x="20" y="34" width="32" height="22" rx="5" fill="#6366f1" opacity="0.13"/>
            <path d="M24 18 Q36 7 48 18" fill="none" stroke="#4f46e5" stroke-width="3.5" opacity="0.18" stroke-linecap="round"/>
            <line x1="36" y1="42" x2="36" y2="52" stroke="#4f46e5" stroke-width="2.5" opacity="0.22" stroke-linecap="round"/>
            <line x1="28" y1="47" x2="44" y2="47" stroke="#4f46e5" stroke-width="2.5" opacity="0.22" stroke-linecap="round"/>
        ` },
        // Small pencil — right mid
        { cls: 'pencil-2', size: 48, svg: `
            <g transform="rotate(20 24 24)">
                <rect x="16" y="4" width="16" height="30" rx="3" fill="#6366f1" opacity="0.18"/>
                <polygon points="16,34 32,34 24,44" fill="#f59e0b" opacity="0.3"/>
                <rect x="16" y="4" width="16" height="7" rx="3" fill="#e2e8f0" opacity="0.45"/>
            </g>
        ` },
        // Small book — bottom left
        { cls: 'book-2', size: [60, 52], svg: `
            <rect x="4" y="4" width="52" height="44" rx="4" fill="#4f46e5" opacity="0.12"/>
            <rect x="4" y="4" width="52" height="8" rx="4" fill="#6366f1" opacity="0.2"/>
            <line x1="12" y1="20" x2="46" y2="20" stroke="#4f46e5" stroke-width="1.5" opacity="0.2" stroke-linecap="round"/>
            <line x1="12" y1="28" x2="46" y2="28" stroke="#4f46e5" stroke-width="1.5" opacity="0.2" stroke-linecap="round"/>
            <line x1="12" y1="36" x2="36" y2="36" stroke="#4f46e5" stroke-width="1.5" opacity="0.2" stroke-linecap="round"/>
        ` },
        // Star sparkle 1 — floating
        { cls: 'star-1', size: 32, svg: `
            <path d="M16 4 L18 13 L27 13 L20 18 L22 27 L16 22 L10 27 L12 18 L5 13 L14 13 Z"
                  fill="#f59e0b" opacity="0.22"/>
        ` },
        // Star sparkle 2 — floating
        { cls: 'star-2', size: 24, svg: `
            <path d="M12 3 L13.5 9.5 L20 9.5 L14.5 13.5 L16.5 20 L12 16 L7.5 20 L9.5 13.5 L4 9.5 L10.5 9.5 Z"
                  fill="#4f46e5" opacity="0.2"/>
        ` },
    ];

    items.forEach(item => {
        const el = document.createElement('span');
        el.className = 'school-deco ' + item.cls;

        const w = Array.isArray(item.size) ? item.size[0] : item.size;
        const h = Array.isArray(item.size) ? item.size[1] : item.size;

        el.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" width="${w}" height="${h}" viewBox="0 0 ${w} ${h}">${item.svg}</svg>`;
        document.body.appendChild(el);
    });
})();
