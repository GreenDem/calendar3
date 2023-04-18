// ANIMATION ON MOUSEOVER

let calendars = document.querySelectorAll('.cal')
calendars.forEach(calendar => {
    calendar.addEventListener('mouseover', () => {
        calendar.style.scale = '1.2';
        calendar.style.zIndex = '4';
        calendar.style.height= '150px'
    });
    calendar.addEventListener('mouseout', () => {
        calendar.style.scale = '1';
        calendar.style.zIndex = '0';
        calendar.style.height= '13%'
    });
});


// LOCAL STORAGE

let eventTitle = document.getElementById('eventTitle');
let eventDate = document.getElementById('eventDate');
let eventDescription = document.getElementById('eventDescription');
let eventForm = document.getElementById('eventForm');
let containers = document.querySelectorAll('container');
let calendarEvent;
let calendarcompare = []


if (localStorage.getItem('calendarEvent')) {
    calendarEvent = JSON.parse(localStorage.getItem("calendarEvent"))
} else {
    calendarEvent = []
}

window.addEventListener('load', () => {
    eventDisplay() }
)

function eventDisplay (){
calendars.forEach(calendar => {
    let results = calendarEvent.filter(obj => {
        return obj.date === calendar.dataset.divdate
      })
      //if tableau vide ne rien faire
    //   calendar.innerHTML= result.title
    console.log(results)
    results.forEach(result => {
        calendar.innerHTML+= `<h2>${result.title}</h2>  <P>${result.description}</p>`

    })
});
}


console.log(calendarcompare)

console.log(calendarEvent)




eventForm.addEventListener("submit", (e) => {
                             // event sur le bouton du formulaire 
    formValidation();
                           // appel de la fonction formValidation
});


// CREATION D EVENT


//PUSH DANS LE LOCAL STORAGE

let acceptData = () => {  // on pousse ce qu'on a récupéré de l'objet dans le local storage
    calendarEvent.push({
        title: eventTitle.value,  // key = text         value = textinput.value
        date: eventDate.value,
        description: eventDescription.value,
    });
    localStorage.setItem("calendarEvent", JSON.stringify(calendarEvent));         // on stringify le tableau pour que le local storage l'accepte
    console.log(calendarEvent);
};

let resetForm = () => {                 // on reset le formulaire après validation
    eventTitle.value = "";
    eventDate.value = "";
    eventDescription.value = "";
};

let formValidation = () => {
    if (eventDate.value === "") {               // on vérifie que les champs ne soient pas vides avant de les accepter
        console.log("failure");
    } else {
        console.log("success");
        acceptData();
        resetForm();
    }
}
