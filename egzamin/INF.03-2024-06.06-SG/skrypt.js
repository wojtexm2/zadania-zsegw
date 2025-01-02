var blok1 = document.getElementById("blok1")
var blok2 = document.getElementById("blok2")
var blok3 = document.getElementById("blok3")

var password1 = document.getElementById("haslo")
var password2 = document.getElementById("haslo_powtorzone")
var imie = document.getElementById("imie")
var nazwisko = document.getElementById("nazwisko")
var email = document.getElementById("email")

function przycisk1() {
	if(!imie.value || !nazwisko.value) { return }
	blok1.style.visibility = "hidden"
	blok2.style.visibility = "visible"
}

function przycisk2() {
	if (!email.value.includes("@")) { return }
	blok2.style.visibility = "hidden"
	blok3.style.visibility = "visible"
}

function przycisk3() {
	if (password1.value != password2.value) { window.alert("Podane hasła różnią się") }
	else { console.log("Witaj "+imie.value+" "+nazwisko.value) }
}