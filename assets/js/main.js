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
    
    // const swup = new Swup();
    jQuery('.slick-slider').slick();

}


function toggleHamburger() {
    
    var hamburger = document.querySelector(".hamburger");
    
    hamburger.addEventListener("click", function() {
        hamburger.classList.toggle("is-active");
        body[0].classList.toggle('overlay');
        setTimeout(() => {
            inputSearch[0].focus();
        }, 500);
    });
}

function toggleSearchBar() {

    tl.staggerTo(selectReversed(".navbar-nav > .menu-item"), 0.4, { scale: 0 }, 0.1);

    btnSearch[0].addEventListener('click', function() {
        tl.reversed() ? tl.play() : tl.reverse();
        searchBar[0].classList.toggle('active');
        btnSearch[0].classList.toggle('hide');
        body[0].classList.toggle('overlay');
        setTimeout(() => {
            inputSearch[0].focus();
        }, 500);
    });

    closeButton[0].addEventListener('click', function() {
        closeSearchBar();
    });

    window.addEventListener('click', function(e) {
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