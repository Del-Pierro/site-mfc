var nav1 = document.querySelector(".header-top-second .nav1")
var nav2 = document.querySelector(".header-top-second .nav2")

var listes1 = document.querySelectorAll(".header-top-second .nav1 li")
var listes2 = document.querySelectorAll(".header-top-second .nav2 li")
var content1 = document.querySelector(".header-top-second .content1 a")
var content2 = document.querySelector(".header-top-second .content2 a")

var prev = document.querySelector("#prev")
var next = document.querySelector("#next")

var headerIcon = document.querySelector(".header-icon")
var headerLeft = document.querySelector(".header-left")

var listenerFunction = {
    openNav1 : () =>{
            nav1.style.display = "block"
    },
    openNav2 : () =>{
        nav2.style.display = "block"
    },
    closeNav1 : () =>{
        if(nav1.style.display && nav1.style.display==="block")
        nav1.style.display = "none"
    },
    closeNav2 : () =>{
        if(nav2.style.display && nav2.style.display==="block")
        nav2.style.display = "none"
    },
    
    nextSlide: () =>{
        let index = slideIndex + 1
        showSlide(index)
    },
    prevSlide: () =>{
        let index = slideIndex - 1
        showSlide(index)
    },
    openNavLeft: () =>{
        if(headerLeft.style.display && headerLeft.style.display==="block"){
            headerLeft.style.display = "none";
        }else{
            headerLeft.style.display = "block";
        }
    },
    closeNavLeft: () =>{
        if(headerLeft.style.display && headerLeft.style.display==="block"){
            headerLeft.style.display = "none";
        }
    }

}

var setupListener = () => {
    content1.onmouseover = listenerFunction.openNav1
    content2.onmouseover = listenerFunction.openNav2

    nav1.addEventListener("mouseleave", listenerFunction.closeNav1)
    nav2.addEventListener("mouseleave", listenerFunction.closeNav2)
    
    for (let index = 0; index < listes1.length; index++) {
        const li1 = listes1[index];
        li1.onclick = listenerFunction.closeNav1
        
    }
    for (let element = 0; element < listes2.length; element++) {
        const li2 = listes2[element];
        li2.onclick = listenerFunction.closeNav2
        
    }
    
    prev.onclick = listenerFunction.prevSlide
    next.onclick = listenerFunction.nextSlide

    headerIcon.onclick = listenerFunction.openNavLeft
    headerLeft.onmouseleave = listenerFunction.closeNavLeft
}