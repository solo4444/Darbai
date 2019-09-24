window.onscroll = function() {sticky_bar();};

var navbar = document.querySelector(".nav");
var sticky = navbar.offsetTop;
var clone = document.querySelector('nav').cloneNode(true);

function sticky_bar() {

    if(window.pageYOffset >= sticky){

        navbar.classList.add("sticky");
    }else{
        navbar.classList.remove("sticky");
    }
}


    var isOpen = false;
        $(".container").click(function() {
            if(isOpen){
            $( ".shopping-cart-menu" ).toggle( "slide" );
            isOpen = false;
        }
        });
        $(".shopping-cart-icon").click(function() {
            $( ".shopping-cart-menu" ).toggle( "slide" );
            isOpen = true;
        });
