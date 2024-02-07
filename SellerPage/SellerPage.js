const tableRows = document.querySelectorAll("tbody tr");
let popup = document.getElementById("popup");
let closeSpan=document.getElementById("close-modal");
let inputs=document.querySelectorAll(".popup .inputs ");
let id,name,date,categroy,quantity,price;
let idInput,nameInput,dateInput,categoryInput,quantityInput,priceInput;
let deleBtn=document.getElementById("delete-btn");
let updateBtn=document.getElementById("update-btn");
let overlay=document.getElementById("overlay");
let search = document.getElementById("search");
let table = document.querySelector('table');
let nameTr = table.querySelectorAll('tbody td[data-title="Name"]');
let nameProducts=[];
nameProducts=Array.from(tableRows).map ((names) => {
  return {name:names.textContent, element:names} 
})

search.addEventListener("input", (e) => {
    const value=e.target.value.toLowerCase();
    nameProducts.forEach((names) => {
      console.log(typeof names.name);
      console.log(names.name);
      let isVisible=names.name.toLowerCase().includes(value);
      names.element.classList.toggle("hide",!isVisible);
    })

})

closeSpan.addEventListener("click", () => {
    popup.classList.remove("open-popup");
    overlay.classList.remove("removes");

});

let priceTr = table.querySelectorAll('tbody td[data-title="Price"]');
let ageDataArray = [];

priceTr.forEach(function(data) {
    ageDataArray.push(data.textContent || data.innerText);
});

let convertedArray=ageDataArray.map(data => parseInt(data,10)) 
// The number 10 symbolizes the base-10 conversion(decimal)
let total=0;
convertedArray.forEach((price) => {
  total+=price;
})
console.log(total);

tableRows.forEach((tableRow) => {
  tableRow.addEventListener("click", () => {
    popup.classList.add("open-popup");
    overlay.classList.add("removes");
     id = tableRow.firstElementChild;
     name = id.nextElementSibling;
     date = name.nextElementSibling;
     categroy = date.nextElementSibling;
     quantity = categroy.nextElementSibling;
     price = tableRow.lastElementChild;
     inputs.forEach((input) => {
        idInput=input.firstElementChild;
        nameInput=idInput.nextElementSibling;
        dateInput=nameInput.nextElementSibling;
        categoryInput=dateInput.nextElementSibling;
        quantityInput=categoryInput.nextElementSibling;
        priceInput=quantityInput.nextElementSibling;
        
        idInput.value=id.textContent;
        nameInput.value=name.textContent;
        dateInput.value=date.textContent;
        categoryInput.value=categroy.textContent;
        quantityInput.value=quantity.textContent;
        priceInput.value=price.textContent;
        updateBtn.addEventListener("click", (e) => {
          e.preventDefault();
            id.textContent=idInput.value;
            name.textContent=nameInput.value;
            date.textContent=dateInput.value;
            categroy.textContent=categoryInput.value;
            quantity.textContent=quantityInput.value;
            price.textContent=priceInput.value;
        })
     })
     deleBtn.addEventListener('click', (e) => {
      e.preventDefault();
        tableRow.innerHTML="";
        
    })
  });
});