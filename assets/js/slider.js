var slideIndex = 0;
var slides = document.querySelectorAll(".slide");
const TIME = 4000


var hideSlide = () => {
    displayDot()
    
    for (let index = 1; index < slides.length; index++) {
        const slide = slides[index];
        slide.style.display = "none"
        
    }
}


var initSlider = () => {
    hideSlide()
}
var displayDot = () =>{
    var dots = document.querySelector("#dots")
    for (let index = 0; index < slides.length; index++) {
        const slide = slides[index]
        const span = document.createElement("span")
        span.onclick = () => showSlide(index)
        span.className = "dot"
        if(index === 0){
            span.classList.add("active")
        }
        dots.appendChild(span)
    }
}


var showSlide = (index) => {
    if(typeof(index) !== "number"){
        return
    }
    let lastSlideIndex = slideIndex
    index %= slides.length 
    index < 0 ? index += slides.length:null
    slideIndex = index
    
    slides[lastSlideIndex].style.display = "none"

    slides[slideIndex].style.display = "block"

    setActiveSalide(lastSlideIndex,slideIndex)
}

var changeSlide = () => {
    var index = slideIndex + 1
    showSlide(index)
}

var setActiveSalide = (lastIndex, currentIndex) => {
    var spans = document.querySelectorAll(".dots span")
    spans[lastIndex]?spans[lastIndex].classList.remove("active"):null
    spans[currentIndex]?spans[currentIndex].classList.add("active"):null
}
var intervalID = setInterval(changeSlide,TIME)

