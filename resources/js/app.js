import './bootstrap';
import InApp from 'detect-inapp';
import Alpine from 'alpinejs';


window.Alpine = Alpine;

Alpine.start();

const inapp = new InApp(navigator.userAgent || navigator.vendor || window.opera);

if(inapp.isInApp){
    // alert('web view detect');
    if(window.location.href!=='https://consultationprogram.supertriodog.com/view'){
        window.location.replace('https://consultationprogram.supertriodog.com/view');
    }
}else{
    // alert(inapp.browser);
    console.log(inapp.browser);
}