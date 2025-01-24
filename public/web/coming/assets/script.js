$(window).on('load', () => {
    $('#preloader').fadeOut('slow', () => {
        $('#loaded').fadeIn('slow');
    });
});

const typedSpan = document.getElementById('typed');
const totype = ['Coming Soon'];

const delayTypingChar = 200;
const delayErasingText = 150;
const delayTypingText = 3000;

let totypeIndex = 0;
let charIndex = 0;

const typeText = () => {
    if (charIndex < totype[totypeIndex].length) {
        typedSpan.textContent += totype[totypeIndex].charAt(charIndex);
        charIndex++;
        setTimeout(typeText, delayTypingChar);
    } else {
        setTimeout(eraseText, delayTypingText);
    }
};

const eraseText = () => {
    if (charIndex > 0) {
        typedSpan.textContent = totype[totypeIndex].substring(0, charIndex - 1);
        charIndex--;
        setTimeout(eraseText, delayErasingText);
    } else {
        totypeIndex = (totypeIndex + 1) % totype.length;
        setTimeout(typeText, delayTypingText);
    }
};

window.onload = () => {
    setTimeout(typeText, delayTypingText);
};
