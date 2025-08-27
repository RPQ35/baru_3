"use strict";
const createPreload = (hrefs, as = 'image') => {
    let crossOrigin = null;
    if (as === 'font') {
        crossOrigin = 'font';
    }
    if (as === 'script') {
        crossOrigin = 'script';
    }
    if (as === 'fetch') {
        crossOrigin = 'fetch';
    }
    hrefs.forEach((href) => {
        var link = document.createElement('link');
        link.rel = 'preload';
        link.as = as;
        link.href = href;
        link.crossOrigin = crossOrigin;
        // @ts-ignore Note: only works experimental in chromne
        link.fetchpriority = 'high';
        document.head.appendChild(link);
    });
};
const homePageFonts = [
    '/assets/fonts/metropolis/Metropolis-SemiBold.otf',
    '/assets/fonts/metropolis/Metropolis-Medium.otf',
    '/assets/fonts/metropolis/Metropolis-Regular.otf',
    '/assets/fonts/metropolis/Metropolis-Bold.otf',
    '/assets/fonts/metropolis/Metropolis-RegularItalic.otf',
];
const homePageImages = [
    '/assets/img/freepik/wall-post-pana.svg',
    '/assets/img/sb-logo.svg',
    '/assets/img/freepik/content-pana.svg',
    'https://assets.startbootstrap.com/img/screenshots/premium/sb-admin-pro.jpg',
    'https://assets.startbootstrap.com/img/screenshots/themes/sb-admin-2.jpg',
    'https://assets.startbootstrap.com/img/screenshots/premium/material-admin-pro.jpg',
];
const dynamicModulesForHomePage = [
    '/src_modules_site_site-routing_module_ts.a66f888fa0637596.js'
];
const dynamicStylesForHomePage = [
    '/styles.19e555e2fc527962.css'
];
// const vehicleSVGs = [
//     '/assets/img/vehicle-types/motorcycle-utv.svg',
//     '/assets/img/vehicle-types/motorcycle-utv-shaded.svg',
//     '/assets/img/vehicle-types/car-wagon.svg',
//     '/assets/img/vehicle-types/car-wagon-shaded.svg',
//     '/assets/img/vehicle-types/jeep-suv.svg',
//     '/assets/img/vehicle-types/jeep-suv-shaded.svg',
//     '/assets/img/vehicle-types/minivan.svg',
//     '/assets/img/vehicle-types/minivan-shaded.svg',
//     '/assets/img/vehicle-types/truck.svg',
//     '/assets/img/vehicle-types/truck-shaded.svg',
//     '/assets/img/vehicle-types/cargo-van-rv.svg',
//     '/assets/img/vehicle-types/cargo-van-rv-shaded.svg',
//     '/assets/img/vehicle-types/trailer-camper.svg',
//     '/assets/img/vehicle-types/trailer-camper-shaded.svg',
//     '/assets/img/vehicle-types/unimog-military-bus.svg',
//     '/assets/img/vehicle-types/unimog-military-bus-shaded.svg',
// ];
// INFO: Load on all pages
// createPreload(dynamicStylesForHomePage, 'style');
createPreload(dynamicModulesForHomePage, 'script');
createPreload([...homePageFonts], 'font');
// INFO: Doesn't seem to help
// createPreload(['/manifest.webmanifest'], 'fetch');
if (document.location.pathname === '/') {
    createPreload(homePageImages);
}
