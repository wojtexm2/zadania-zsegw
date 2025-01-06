var currentPhoto = 1;

function replacePhoto() {
	let photo = document.getElementById("aktywnezdjecie");
	photo.src = currentPhoto+".jpg";
}

function goRight() {
	currentPhoto += 1;
	if(currentPhoto > 7) { currentPhoto = 1; }
	replacePhoto();
}

function goLeft() {
	currentPhoto -= 1;
	if(currentPhoto < 1) { currentPhoto = 7; }
	replacePhoto();
}