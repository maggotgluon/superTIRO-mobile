import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

// const otpcontainer = document.getElementsByClassName("single-input-container")[0];
// console.log(otpcontainer)
// otpcontainer.onkeyup = function(e) {
//     console.log('key up')
//     var target = e.srcElement || e.target;

//     // console.log(target)
//     var maxLength = parseInt(target.attributes["maxlength"].value, 10);
//     var myLength = target.value.length;
//     console.log(maxLength)
//     console.log(myLength)
//     if (myLength >= maxLength) {
//         var next = target;
//         // console.log(next.tagName.toLowerCase())
//         while (next = next.nextElementSibling) {
//             if (next == null)
//                 break;
//             if (next.tagName.toLowerCase() === "input") {
//                 next.focus();
//                 break;
//             }
//         }
//     }
//     // Move to previous field if empty (user pressed backspace)
//     else if (myLength === 0) {
//         var previous = target;
//         while (previous = previous.previousElementSibling) {
//             if (previous == null)
//                 break;
//             if (previous.tagName.toLowerCase() === "input") {
//                 previous.focus();
//                 break;
//             }
//         }
//     }
// }
