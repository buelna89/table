
const toggleNavBtn = document.querySelector('.toggleNav')
const navBar = document.querySelector('.navBar')

toggleNavBtn.addEventListener('click', ()=>{
  navBar.classList.toggle('show')
  if( navBar.classList.contains('show')){
      toggleNavBtn.innerHTML = `<i class='bx bx-x-circle icon'></i>`
  }
  else{
    toggleNavBtn.innerHTML = ` <i class='bx bx-menu icon ' ></i>`
  }

})


// FILTERING THROUGH FOOD AND DRINK ============================>
const categories = document.querySelectorAll('.option')
const itemWrapper = document.querySelectorAll('.categoryWrapper')
for(let i=0; i<categories.length; i++){
    categories[i].addEventListener('click', function(){
        for(let a=0; a<categories.length; a++){
            categories[a].classList.remove('categoryActive')
        }
        this.classList.add('categoryActive')

        let itemFilter = this.getAttribute('data-filter')
        for(let f=0; f<itemWrapper.length; f++){
         itemWrapper[f].classList.add('hide')
         itemWrapper[f].classList.remove('live')
         if(itemWrapper[f].getAttribute('data-target') == itemFilter || itemFilter == "all"){
             itemWrapper[f].classList.remove('hide')
             itemWrapper[f].classList.add('live')
         }
        }
    })
}


