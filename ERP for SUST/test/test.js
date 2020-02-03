let cardElement;
cardElement = document.querySelector(".card");

cardElement.addEventListener("click", flip);

function flip() {
    cardElement.classList.toggle("flipped");
}

// function startTime() {
//     var weekday = new Array();
//     weekday[0] = "Sunday";
//     weekday[1] = "Monday";
//     weekday[2] = "Tuesday";
//     weekday[3] = "Wednesday";
//     weekday[4] = "Thursday";
//     weekday[5] = "Friday";
//     weekday[6] = "Saturday";
//     var month = new Array();
//     month[0] = "January";
//     month[1] = "February";
//     month[2] = "March";
//     month[3] = "April";
//     month[4] = "May";
//     month[5] = "June";
//     month[6] = "July";
//     month[7] = "August";
//     month[8] = "September";
//     month[9] = "October";
//     month[10] = "November";
//     month[11] = "December";
//     var today = new Date();
//     var h = today.getHours();
//     var m = today.getMinutes();
//     var s = today.getSeconds();
//     var d = today.getDate();
//     var y = today.getFullYear();
//     var wd = weekday[today.getDay()];
//     var mt = month[today.getMonth()];

//     m = checkTime(m);
//     s = checkTime(s);
//     document.getElementById("date").innerHTML = d;
//     document.getElementById("day").innerHTML = wd;
//     document.getElementById("month").innerHTML = mt + "" + y;
//     document.getElementById("date").innerHTML = d;

//     var t = setTimeout(startTime, 500);
// }
// function checkTime(i) {
//     if (i < 10) {
//         i = "0" + i;
//     }
//     return i;
// }
