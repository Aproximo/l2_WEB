var xhr = new XMLHttpRequest();
xhr.open("GET", "http://localhost/app_dev.php/api/users/", false);
xhr.send();

console.log(xhr.status);
console.log(xhr.response);