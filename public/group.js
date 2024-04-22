document.querySelectorAll('.dropdown-toggle').forEach(button => {
   button.addEventListener('click', function () {
      // Get the group ID from the clicked button's data attribute
      const groupId = this.dataset.groupid;
      //   console.log(groupId)

      // Get the dropdown menu element associated with the clicked button
      const dropdownMenu = this.nextElementSibling;

      const dropdownMenus = document.querySelectorAll('.dropdown-menu');

      dropdownMenus.forEach(menu => {
         if (menu != dropdownMenu) {
            menu.classList.remove('show');
         }
      });

      // Toggle the visibility of the dropdown menu
      dropdownMenu.classList.toggle('show');

      // Prevent event bubbling to prevent unintended clicks on document
      event.stopPropagation();

      // Get the hidden input field for group ID in the delete modal
      const deleteGroupIdInput = document.getElementById('deleteGroupId');

      // Set the hidden input field's value to the retrieved group ID
      deleteGroupIdInput.value = groupId;
   });
});

function showSign() {
   // window.alert('show');
   document.getElementById('deleteGroupModal').classList.remove('hidden');

   const dropdownMenus = document.querySelectorAll('.dropdown-menu');
   dropdownMenus.forEach(menu => {
      menu.classList.remove('show');
   });


   // document.getElementById('deleteGroupModal').classList.add('show');
}

function hide() {
   document.getElementById('deleteGroupModal').classList.add('hidden');
}

document.addEventListener('click', function (event) {
   const dropdownMenus = document.querySelectorAll('.dropdown-menu');
   dropdownMenus.forEach(menu => {
      if (!menu.contains(event.target)) {
         menu.classList.remove('show');
      }
   });
});

function list() {
   let btt = document.getElementById('select');
   let valeur = window.getComputedStyle(btt).getPropertyValue('opacity');
   if (valeur == '0') {
      btt.style.opacity = '1';
      btt.style.display = 'grid'
      btt.style.visibility = 'visible'
      btt.classList.remove('unclickable');
      btt.classList.add('clickable');


      //  
   }
   else {
      btt.style.opacity = '0';
      btt.style.display = 'none';
      btt.style.visibility = 'hidden'
      btt.classList.remove('clickable');
      btt.classList.add('unclickable');

   }
}
function create() {
   let creat = document.getElementById('create');
   let join = document.getElementById('join');
   let main = document.querySelectorAll('.group_p');
   let value = window.getComputedStyle(join).getPropertyValue('opacity');
   let valeur = window.getComputedStyle(creat).getPropertyValue('opacity');
   let btt = document.getElementById('select');
   if (value == '1') {
      join.style.zIndex = '0';
      join.style.opacity = '0';
      btt.style.opacity = '0';
      btt.style.display = 'none';
   }

   if (valeur == '0') {
      creat.style.zIndex = '200';
      creat.style.opacity = '1';
      btt.style.opacity = '0';
      btt.style.display = 'none';
   }
   main.forEach(function (element) {
      element.style.opacity = '0.4';
      element.style.filter = 'blur(5px)';
   });

}
function join() {
   let join = document.getElementById('join');
   let creat = document.getElementById('create');
   let main = document.querySelectorAll('.group_p');
   let valeur = window.getComputedStyle(join).getPropertyValue('opacity');
   let value = window.getComputedStyle(creat).getPropertyValue('opacity');

   let btt = document.getElementById('select');
   if (value == '1') {
      creat.style.zIndex = '0';
      creat.style.opacity = '0';
      btt.style.opacity = '0';
      btt.style.display = 'none';
   }

   if (valeur == '0') {
      join.style.zIndex = '200';
      join.style.opacity = '1';
      btt.style.opacity = '0';
      btt.style.display = 'none';
      // main.style.opacity='0.4';
   }
   main.forEach(function (element) {
      element.style.opacity = '0.4';
      element.style.filter = 'blur(5px)';
   });
}
function annuler() {
   let creat = document.getElementById('create');
   let join = document.getElementById('join');
   let main = document.querySelectorAll('.group_p');
   creat.style.zIndex = '0';
   join.style.zIndex = '0';
   creat.style.opacity = '0';
   join.style.opacity = '0';

   main.forEach(function (element) {
      element.style.opacity = '1';
      element.style.filter = 'blur(0px)';
   });
   vider();
}
function vider() {

   // var inputs = document.querySelectorAll('input');
   // inputs.forEach(function (input) {
   //   if (input.name !== '_token' && input.name !== 'type') {  // Check if it's not the CSRF token, it was a fucking!!! 4 day of debbuging because of this fucking function
   //      input.value = '';
   //   }
   // });
   var form = document.getElementById('creatForm');
   form.reset();
}

annuler();
let btt = document.getElementById('select');
let valeur = window.getComputedStyle(btt).getPropertyValue('opacity');
btt.style.opacity = '0';
btt.style.display = 'none';
btt.style.visibility = 'hidden';

document.addEventListener("click", handleClickOutside);
function handleClickOutside(event) {
   const myDiv = document.getElementById("plus");
   if (!myDiv.contains(event.target)) {
      // list();
      let btt = document.getElementById('select');
      let valeur = window.getComputedStyle(btt).getPropertyValue('opacity');
      btt.style.opacity = '0';
      btt.style.display = 'none';
      btt.style.visibility = 'hidden'
      btt.classList.remove('clickable');
      btt.classList.add('unclickable');
   }
}
document.addEventListener("click", () => {
   if (!document.getElementById('join').contains(event.target) && !document.getElementById('create').contains(event.target) && !document.getElementById('creat_button').contains(event.target) && !document.getElementById('join_button').contains(event.target)) {

      annuler();
   }
})