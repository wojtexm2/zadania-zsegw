var responses = [
"Świetnie!",
"Kto gra główną rolę?",
"Lubisz filmy Tego reżysera?",
"Będę 10 minut wcześniej",
"Może kupimy sobie popcorn?",
"Ja wolę Colę",
"Zaproszę jeszcze Grześka",
"Tydzień temu też byłem w kinie na Diunie",
"Ja funduję bilety"
]

function addMessage(text, person) {
	if (person == "jonata") {
		var img = "Jolka.jpg"
		var message_id = "jonata"
	} else {
		var img = "Krzysiek.jpg"
		var message_id = "krzysiek"
	}

	let chat = document.getElementById("chat")
	
	let newMessage = document.createElement("div")
	
	let photo = document.createElement("img")
	photo.src = img
	photo.alt = message_id

	newMessage.appendChild(photo)

	let textInsideMessage = document.createElement("p")
	textInsideMessage.innerHTML = text

	newMessage.id = message_id
	newMessage.appendChild(textInsideMessage)


	chat.appendChild(newMessage)
	newMessage.scrollIntoView()
}

function respond() {
	let messageInput = document.getElementById("messageinput")
	let zawartosc = messageInput.value
	if (zawartosc.length <= 0) { return }

	messageInput.value = ""
	addMessage(zawartosc, "jonata")
}

function randomResponse() {
	let randomIndex = Math.floor(Math.random() * 9);
	addMessage(responses[randomIndex], "krzysiek")
}