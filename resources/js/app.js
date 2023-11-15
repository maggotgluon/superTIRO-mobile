import './bootstrap';
import InApp from 'detect-inapp';
import Alpine from 'alpinejs';


window.Alpine = Alpine;

Alpine.start();

const inapp = new InApp(navigator.userAgent || navigator.vendor || window.opera);

console.log('browser : '+inapp.browser)
console.log('isDesktop : '+inapp.isDesktop)
console.log('isInApp : '+inapp.isInApp)
console.log('device : '+inapp.device)
console.log('isApplePay : '+inapp.isApplePay)

window.addEventListener('resize', () => {
    // We execute the same script as before
    let vh = window.innerHeight * 0.01;
    document.documentElement.style.setProperty('--vh', `${vh}px`);
    console.log(vh)
});

console.log('isMobile : '+inapp.isMobile)
if(inapp.isInApp){
    // alert('web view detect');
    // if(window.location.href!=='https://consultationprogram.supertriodog.com/view'){
    //     window.location.replace('https://consultationprogram.supertriodog.com/view');
    // }
}else{
    // alert(inapp.browser);
    console.log(inapp.browser);
}