function showTime(){
  var date = new Date();
  var h = date.getHours(); //from 0 - 23 hours
  var m = date.getMinutes(); //from 0 - 59 minutes
  var s = date.getSeconds(); //from 0 - 59 seconds
  var session = "AM";

  if (h == 0){ h = 12; }
  if (h > 12){ h = h - 12; session = "PM"; }

  h = (h < 10) ? "0" + h : h;
  m = (m < 10) ? "0" + m : m;
  s = (s < 10) ? "0" + s : s;

  var time = h + ":" + m + ":" + s + " " + session;
  //for different browser of users
  document.getElementById("MyClockDisplay").innerText = time;
  document.getElementById("MyClockDisplay").textContent = time;

  //1000 milliseconds
  setTimeout(showTime, 1000); 
}

showTime();