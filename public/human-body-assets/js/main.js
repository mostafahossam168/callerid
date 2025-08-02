if (document.querySelector(".box-elements")) {
 let boxElements = document.querySelector(".box-elements");
 let numClass = 1;
 let arrClass = [];
 function create(event) {
     //Create the element
     let element = document.createElement('input');

     // Create Class
     let classElement = "cr-element" + numClass;

     // Add Class In Arr
     arrClass.unshift(classElement)

     // Set Class And Attributes
     element.classList.add(classElement)
     element.classList.add("cr-element")
     element.setAttribute("type","text")
     element.setAttribute("readonly","")
     element.setAttribute("value",[`${(event.clientX-6-this.offsetLeft) / this.offsetWidth * 100}%`,`${(event.clientY-6-this.offsetTop) / this.offsetHeight  * 100}%`])

     // Edit Num Class
     numClass += 1;

     //Set CSS styles so it appears where you clicked (Top left corner)
    //  element.style.left = `${event.clientX}px`;
    //  element.style.top = `${event.clientY}px`;
     element.style.left = `${(event.clientX-6-this.offsetLeft) / this.offsetWidth * 100}%`;
     element.style.top = `${(event.clientY-6+window.scrollY-this.offsetTop) / this.offsetHeight  * 100}%`;
     console.log(window.scrollY)
     //Add it to the body of the document
     boxElements.appendChild(element);
 }
 //Main event listener for clicks
 boxElements.addEventListener('click', create);

 // Remove Element
 let btnRemove = document.querySelector(".btn-remove");
 btnRemove.addEventListener("click",() => {
  if (arrClass.length >= 1) {
   let lastElement = document.querySelector(`.${arrClass[0]}`);
   lastElement.remove();
   arrClass.shift();
  }
 })
}
