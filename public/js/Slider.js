let currentPosition = 0;
const slidesTrack = document.querySelector('.slides-track');
const cards = document.querySelectorAll('.product-card');
const cardsPerView = 3;
const totalSlides = cards.length;

function slideProduct(direction) {
    const slideWidth = cards[0].offsetWidth + 20;
    const maxPosition = -(totalSlides - cardsPerView) * slideWidth;
    
    if (direction === 'next' && currentPosition > maxPosition) {
        currentPosition -= slideWidth;
    } else if (direction === 'prev' && currentPosition < 0) {
        currentPosition += slideWidth;
    }
    slidesTrack.style.transform = `translateX(${currentPosition}px)`;
}