
let chatListElements = document.querySelectorAll('chatListElement');
let listOfChats = document.querySelectorAll('chatInstance');

chatListElements.forEach((c)=>{
  c.addEventListener('click',()=>{
    alert("df");
    listOfChats.forEach((y)=>y.innerHTML='')
  })
})

// chatListElements.addEventListener('click',()=>{
//   for (let i = 0; i < chatListElements.length; i++) {
//     for(let i = 0; i <listOfChats.length; i++) {
//       listOfChats[i].innerHTML = '';
//     }
//   }
// })



// let myFunction = function() {
  
 

  

// };

// for (let i = 0; i < elements.length; i++) {
//   let children = elements[i].children;
  
//   for (let j = 0; j < children.length; j++) {
//     let childClassName = children[j].className;
    
//     children[j].addEventListener('click', (function(c) {
//       return function() {
//         myFunction(c);
//       };
//     })(childClassName));
//   }
// }


// let elements = document.getElementsByClassName('chatList');
// let listOfChats = document.getElementsByClassName('chatInstance');
// let myFunction = function(className) {
  
//   alert(className);
//   for(let i = 0; i <listOfChats.length; i++) {
//     listOfChats[i].innerHTML = '';
//   }

//   // Add AJAX functionality here
//   var xhr = new XMLHttpRequest();
//   xhr.onreadystatechange = function() {
//     if (this.readyState == 4 && this.status == 200) {
//       // Update the chat instance with the response from the server
//       for(let i = 0; i <listOfChats.length; i++) {
//         listOfChats[i].innerHTML = this.responseText;
//       }
//     }
//   };
//   xhr.open("POST", "BuyerChat.php", true);
//   xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
//   xhr.send("className=" + className);
// };

// for (let i = 0; i < elements.length; i++) {
//   let children = elements[i].children;
  
//   for (let j = 0; j < children.length; j++) {
//     let childClassName = children[j].className;
    
//     children[j].addEventListener('click', (function(c) {
//       return function() {
//         myFunction(c);
//       };
//     })(childClassName));
//   }
// }
