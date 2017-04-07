var mainMenu = false;
    var userMenu = false;
    
    $("#handle img").click(function(){
        toggleMainMenu();
        if (userMenu)
            toggleUserMenu();
    });
    
    
    $("#user-icon").click(function(){
        toggleUserMenu();
        if (mainMenu)
            toggleMainMenu();
    });
    
    function toggleMainMenu(){
        if (!mainMenu){
            $("#menuwrapper").animate({
                height: "6em",
                opacity: "100"
            }, 300);
            mainMenu = true;
        }else{
            $("#menuwrapper").animate({
                height: "0",
                opacity: "0"
            }, 300);
            mainMenu = false;
        }
    }
    
    function toggleUserMenu(){
        if (!userMenu){
            $("#user-menu").animate({
                height: "6em",
                opacity: "100"
            }, 300);
            userMenu = true;
        }else{
            $("#user-menu").animate({
                height: "0",
                opacity: "0"
            }, 300);
            userMenu= false;
        }
    }