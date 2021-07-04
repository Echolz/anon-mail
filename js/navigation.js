let rows = document.getElementsByClassName("emails-row");
for (let row of rows) {
    row.onclick = function() {
        let orderId = row.getElementsByClassName("id")[0].textContent;
        window.location.href = window.location.href.replace("sendEmailsView.php", "emailView.php");
    }
}