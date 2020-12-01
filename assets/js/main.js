var masthead = document.getElementsByClassName('masthead');
var btnSearch = document.getElementsByClassName('button--search');
var searchBox = document.getElementsByClassName('searchbox');
var searchBar = document.getElementsByClassName('navbar--search');
var closeButton = document.getElementsByClassName('button--close');
var inputSearch = document.getElementsByClassName('form-control--search');
var isFixedNav = document.getElementsByClassName('fixed-top');
var navHeight = (isFixedNav.length > 0) ? isFixedNav[0].offsetHeight : 0;
var siteContent = document.getElementsByClassName('site-content');

var body = document.getElementsByTagName('body');
var tl = new TimelineMax({
    paused: true,
    reversed: true,
});

init();

function init() {

    toggleHamburger();
    toggleSearchBar();
    initNavBar();
    initHeroesPseudoClasses();
    setUniqueModuleId();
    setUniqueCarouselId();
    // todo questa deve funzionare solo con le slide
    // equalHeights('box');
    
    
    jQuery('.slick-slider').slick();

    setTimeout(() => {
        // truncateBoxInner();
    }, 100);
}

function truncateBoxInner(){
    var boxinner = document.getElementsByClassName('box-inner');
    for (let index = 0; index < boxinner.length; index++) {
        const element = boxinner[index];
        element.children[0].children[0].innerText = truncateString(element.children[0].children[1].innerText, 20);
        element.children[0].children[1].innerText = truncateString(element.children[0].children[1].innerText, 120);
    }
}

function toggleHamburger() {

    var hamburger = document.querySelector(".hamburger");

    hamburger.addEventListener("click", function () {
        hamburger.classList.toggle("is-active");
        body[0].classList.toggle('overlay');
        setTimeout(() => {
            inputSearch[0].focus();
        }, 500);
    });
}

function toggleSearchBar() {

    tl.staggerTo(selectReversed(".navbar-nav > .menu-item"), 0.4, { scale: 0 }, 0.1);

    btnSearch[0].addEventListener('click', function () {
        tl.reversed() ? tl.play() : tl.reverse();
        searchBar[0].classList.toggle('active');
        btnSearch[0].classList.toggle('hide');
        body[0].classList.toggle('overlay');
        setTimeout(() => {
            inputSearch[0].focus();
        }, 500);
    });

    closeButton[0].addEventListener('click', function () {
        closeSearchBar();
    });

    window.addEventListener('click', function (e) {
        if (!searchBox[0].contains(e.target) && !tl.reversed()) {
            closeSearchBar();
        }
    });

}

function closeSearchBar() {

    tl.reverse();

    searchBar[0].classList.toggle('active');
    btnSearch[0].classList.toggle('hide');
    body[0].classList.toggle('overlay');
    inputSearch[0].value = '';

}

function setUniqueModuleId(){
    var modulo = document.getElementsByClassName('modulo');
    if(modulo.length > 0){
        for (let index = 0; index < modulo.length; index++) {
            const element = modulo[index];
            element.id = 'moduloID-' + index;
        }
    }
}
function setUniqueCarouselId(){
    var carousel = document.getElementsByClassName('carousel');
    if(carousel.length > 0){
        for (let index = 0; index < carousel.length; index++) {
            const element = carousel[index];
            parentID = element.parentElement.getAttribute('id').toString().replace('moduloID-','');
            element.id = 'carouselID-' + parentID;
            element.querySelectorAll('[role="button"]')[0].href = '#'+element.id;
            element.querySelectorAll('[role="button"]')[1].href = '#'+element.id;
        }
    }
}
function initHeroesPseudoClasses(){
    var addRule = (function (style) {
        var sheet = document.head.appendChild(style).sheet;
        return function (selector, css) {
            var propText = typeof css === "string" ? css : Object.keys(css).map(function (p) {
                return p + ":" + (p === "content" ? "'" + css[p] + "'" : css[p]);
            }).join(";");
            sheet.insertRule(selector + "{" + propText + "}", sheet.cssRules.length);
        };
    })(document.createElement("style"));
    var heroes = document.getElementsByClassName('heroes');
    if(heroes.length > 0){
        for (let index = 0; index < heroes.length; index++) {
            const element = heroes[index];
            element.id = 'heroes' + index;
            var string = '#heroes' + index +' .heroes-container--single:before';
            addRule(string, {
                'background-image': "url("+element.getAttribute('data-src')+")", 
            });   
        }
    }
}




function truncateString(str, num) {
    // If the length of str is less than or equal to num
    // just return str--don't truncate it.
    if (str.length <= num) {
        return str
    }
    // Return str truncated with '...' concatenated to the end of str.
    return str.slice(0, num) + '...'
}

function equalHeights(className) {
    var findClass = document.getElementsByClassName(className);
    var tallest = 0;
    if (findClass.length > 0) {
        // Loop over matching divs
        for (i = 0; i < findClass.length; i++) {
            var ele = findClass[i];
            var eleHeight = ele.offsetHeight;
            tallest = (eleHeight > tallest ? eleHeight : tallest); /* look up ternary operator if you dont know what this is */
        }
        for (i = 0; i < findClass.length; i++) {
            findClass[i].style.height = tallest + "px";
        }
    }

}

function initNavBar() {
    if (isFixedNav.length > 0) {
        siteContent[0].style.paddingTop = (navHeight + 50) + 'px';
    }
}

function onScroll() {
    if (document.documentElement.scrollTop > navHeight) {
        masthead[0].classList.add('scrolling');
    } else {
        masthead[0].classList.remove('scrolling');
    }
}

function selectReversed(query) {
    var nodes = document.querySelectorAll(query);
    nodes = Array.prototype.slice.call(nodes, 0);
    return nodes.reverse();
}