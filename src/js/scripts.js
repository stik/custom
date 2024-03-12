document.addEventListener('DOMContentLoaded', function() {

    let menu = document.querySelectorAll('.menu-item-has-children > a');
    if(menu){
        menu.forEach((el) => {
            el.innerHTML += '<i class="chevron-down"></i>';
        });
    }

    let mobile_menu = document.querySelector('.mobile-menu .menu-item-has-children');
    if(mobile_menu){
        mobile_menu.addEventListener('click', function(){
            this.classList.toggle("active");
        });
    }

    let toggler = document.querySelector('.navbar-toggler');
    if(toggler){
        toggler.addEventListener('click', function(){

            let current_menu = this.dataset.menu;

            if(this.classList.contains("active")){
                this.classList.remove("active");
                document.body.classList.remove("active-mobile_menu")
                if(current_menu) document.querySelector('#'+current_menu).classList.remove("active");
            }else{
                this.classList.add("active");
                document.body.classList.add("active-mobile_menu")
                if(current_menu) document.querySelector('#'+current_menu).classList.add("active");
            }
        });
    }

});
