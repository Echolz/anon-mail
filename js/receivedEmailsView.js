let rows = document.getElementsByClassName("emails-row");
for (let row of rows) {
    row.onclick = function() {
        let id = row.getElementsByClassName("id")[0].textContent;
        window.location.href = window.location.href.replace("receivedEmailsView.php", "emailView.php?id=" + id);
    }
}