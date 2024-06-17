const closeBtn = document.getElementById('closeBtn')
const notificationsBtn = document.querySelector('.notifications')
const notificationsPage = document.querySelector('.notificationsContainer')

notificationsBtn.addEventListener('click', function(){
    notificationsPage.classList.add('toggleNotificationPage')
})


closeBtn.addEventListener('click', function(){
    notificationsPage.classList.remove('toggleNotificationPage')
})

// toggle active class on navItems =========================>
const navItems = document.querySelectorAll('.listItem')
navItems.forEach(navItem =>{
    navItem.addEventListener('click', function(){
        for(let i=0; i<navItems.length; i++){
            navItems[i].classList.remove('active')
        }
        this.classList.add('active')
    })
})
