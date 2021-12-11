
require('./bootstrap');
import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();
window.Echo.private(`Notifications.${userId}`)
.notification(function(data){
    console.log(data);
    alert(`${data.title}`)
    $('#notification1').prepend(`
         <a href="#" class="dropdown-item">
             <b style="color: #f00">*</b>
             ${data.title}
            <span class="float-right text-muted text-sm time">${data.created_at.diffForHumans()}</span>

         </a>
    `)
    console.log(`<a href="#" class="dropdown-item">
    <b style="color: #f00">*</b>
    ${data.title}
   <span class="float-right text-muted text-sm time">${data.created_at.diffForHumans()}</span>

</a>`);
  })