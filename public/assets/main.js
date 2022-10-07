function type() {
    var options = {
    
        strings: ["", "AVEC 3CABLES, LE COUP DE FOUDRE EST ASSURE!"],
        startDelay: 200,
        typeSpeed: 20,
        preStringTyped: function(self) { 
            
            document.getElementById('title').getElementsByTagName("span")[0].innerHTML = ""; 
        }
      };
    var typed = new Typed('.title', options);
    
}


const prestations = document.getElementById('prestations');

if(prestations){
    prestations.addEventListener('click', (e) => {
        if(e.target.className === 'btn btn-danger delete-prestation'){
            if(confirm('Voulez vous supprimer cette prestation?')){
                const id = e.target.getAttribute('data-id');
    
                fetch(`/menu/prestation/delete/${id}`, {
                    method: 'DELETE'
                }).then(res => window.location.reload());
            }
        }
    });
}
const avis = document.getElementById('avis');
console.log(avis);

if(avis){
    avis.addEventListener('click', (e) => {
        if(e.target.className === 'btn btn-danger delete_avis'){
            if(confirm('Voulez vous supprimer cet avis?')){
                const id = e.target.getAttribute('data-id');
    
                fetch(`/avis/delete/${id}`, {
                    method: 'DELETE'
                }).then(res => window.location.reload());
            }
        }
    });
}
