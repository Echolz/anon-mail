
function reply() {
	let subject = document.getElementById('subject').value;
	let from = document.getElementById('from').value;
	let to = document.getElementById('to').value;
	
	window.location.href = window.location.href.replace("emailView.php", "newEmail.php?subject=" + subject + "&from=" + from + "&to=" + to + "&");
}
