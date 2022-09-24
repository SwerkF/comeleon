var options = {
    
    strings: ["", "AVEC 3CABLES, LE COUP DE FOUDRE EST ASSURE!"],
    startDelay: 200,
    typeSpeed: 20,
    preStringTyped: function(self) { 
        
        document.getElementById('title').getElementsByTagName("span")[0].innerHTML = ""; 
    }
  };
  
  var typed = new Typed('.title', options);