const slider = document.querySelector('.slider');
const sliderContainer = slider.querySelector('.slider-container');
const slides = sliderContainer.querySelectorAll('img');
const prevBtn = slider.querySelector('.slider-btn-prev');
const nextBtn = slider.querySelector('.slider-btn-next');
let slideWidth = slides[0].clientWidth;
let currentIndex = 0;

function goToSlide(index) {
    if (index < 0 || index >= slides.length) {
        return;
    }

    // Überprüfen, ob der Index des aktuellen Bildes größer als die Länge des Sliders ist
    if (index > slides.length - 1) {
        currentIndex = 0;
        index = 0;
    }

    sliderContainer.style.transform = `translateX(-${index * slideWidth}px)`;
    currentIndex = index;
}

function nextSlide() {
    currentIndex++;
    if (currentIndex > slides.length - 1) {
        currentIndex = 0;
    }
    goToSlide(currentIndex);
}

function prevSlide() {
    currentIndex--;
    if (currentIndex < 0) {
        currentIndex = slides.length - 1;
    }
    goToSlide(currentIndex);
}

let intervalId = setInterval(nextSlide, 5000);

prevBtn.addEventListener('click', () => {
    clearInterval(intervalId);
    prevSlide();
    intervalId = setInterval(nextSlide, 5000);
});

nextBtn.addEventListener('click', () => {
    clearInterval(intervalId);
    nextSlide();
    intervalId = setInterval(nextSlide, 5000);
});

// Responsive
function handleResize() {
    slideWidth = slides[0].clientWidth;
    goToSlide(currentIndex);
}

window.addEventListener('resize', handleResize);
