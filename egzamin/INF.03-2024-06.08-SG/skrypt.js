var progress = 4;

function barProgress() {
	let progressBar = document.getElementById("progressbarinside");

	progress += 12;
	if(progress > 100) { progress = 100; return; }

	progressBar.style.width = progress+"%";
}

var form1 = document.getElementById("form1");
var form2 = document.getElementById("form2");
var form3 = document.getElementById("form3");

function firstTab() {
	form2.style.display = "none";
	form3.style.display = "none";
	form1.style.display = "inline-block";
}

function secondTab() {
	form1.style.display = "none";
	form3.style.display = "none";
	form2.style.display = "inline-block";
}

function thirdTab() {
	form2.style.display = "none";
	form1.style.display = "none";
	form3.style.display = "inline-block";
}

function formPost() {
	let name = document.getElementById("imie");
	let surname = document.getElementById("nazwisko");
	let birthday = document.getElementById("urodzenie");
	let street = document.getElementById("ulica");
	let number = document.getElementById("numer");
	let city = document.getElementById("miasto");
	let phone = document.getElementById("telefon");
	let rodo = document.getElementById("rodo");

	console.log(name.value+", "+surname.value+", "+birthday.value+", "+street.value+", "+number.value+", "+city.value+", "+phone.value+", "+rodo.value);
}