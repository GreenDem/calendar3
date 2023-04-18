// ANIMATION ON MOUSEOVER
const showEvent = document.getElementById('showEvent')
console.log(showEvent)
let calendars = document.querySelectorAll('.cal')
// calendars.forEach(calendar => {


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
        eventDisplay()
    }
    )

    function eventDisplay() {
        calendars.forEach(calendar => {
            let results = calendarEvent.filter(obj => {
                return obj.date === calendar.dataset.divdate
            })
            //if tableau vide ne rien faire
            //   calendar.innerHTML= result.title
            results.forEach(result => {
                calendar.setAttribute("data-title", `"${result.title}"`)
                calendar.setAttribute("data-description", `"${result.description}"`)
                calendar.style.color= "aqua"

                calendar.addEventListener('mouseover', (e) => {
                    calendar.style.scale = '1.2';
                    calendar.style.zIndex = '4';
                    console.log(calendar)
                    showEvent.classList.remove('displayNone')
                    showEvent.innerHTML = `<div><h3>${result.title}</h3><p>${result.description}</p></div`
                    console.log(showEvent)

                });
                calendar.addEventListener('mouseout', () => {
                    calendar.style.scale = '1';
                    calendar.style.zIndex = '0';
                    showEvent.classList.add('displayNone')
                    showEvent.innerHTML = ``

                });
            });




            // innerHTML+= `<h2>${result.title}</h2>  <P>${result.description}</p>`
        })
    };



eventForm.addEventListener("submit", (e) => {
    formValidation();
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
