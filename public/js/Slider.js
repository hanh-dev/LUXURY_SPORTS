let currentSlide = 0;

const slides = document.querySelectorAll('.product-slide');

function slideProducts(direction) {
    // Remove active class from current slide
    slides[currentSlide].classList.remove('active');
    
    // Calculate next slide index
    if (direction === 'next') {
        currentSlide = (currentSlide + 1) % slides.length;
    } else {
        currentSlide = currentSlide === 0 ? slides.length - 1 : currentSlide - 1;
    }
    
    // Add active class to new slide
    slides[currentSlide].classList.add('active');
}